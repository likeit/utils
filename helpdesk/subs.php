<?php
require_once("$_SERVER[DOCUMENT_ROOT]/conf.inc.php");

ini_set("display_errors",1);
error_reporting(E_ALL ^E_NOTICE);
require_once("$_SERVER[DOCUMENT_ROOT]//subs.php");
require_once("$_SERVER[DOCUMENT_ROOT]//lib/dblayer.php");

/*
 * Попытка привнести немного универсальности в работу с фильтрацией данных.
 * образуем GET-параметры в формате JSON в SQL запрос
 */
function queryBuilder($table, $columns = "*", $filter = null, $order_by = null, $order_desc = null, $limit = null,$type = 'filter') {
    global $admin_login, $permissions;
    $params = null;
    $and = null;
    $order_desc = ($order_desc==1) ? " DESC " : null;
//echo $filter;
    if (isset($limit)) $limit_sql = " LIMIT $limit ";
    if (isset($order_by) and ($order_by!='')) {
        if ($order_by == "deadline")
            $order_by = "(CASE WHEN (`$order_by`=0 or `$order_by` IS NULL)THEN 1 ELSE 0 END) $order_desc, $order_by";
        $order_by_sql = " ORDER BY $order_by $order_desc";
    };

    if (isset($filter)and $filter!='') {
        $filter_arr = json_decode($filter, true);

//        print_r($filter_arr);
        foreach ($filter_arr as $key=>$val) {

            $equal_char = '=';

            if (($key=='contractor') and ($val==0)) { // Заменяем "0" на "себя" при фильтре ответственных
                $val = $admin_login['uid'];
            } elseif ($key=='performers') { // Заменяем "0" на "себя" при фильтре исполнителей
                $val = str_replace("@0@","%".$admin_login['uid']."%",$val);
                $val = str_replace("@","%",$val);
            }

            switch ($type) {

                case 'filter':
                    $vals = explode(",",$val);

                    if ($key=='dates') {
                        $date_from = $vals[0];
                        $date_to   = $vals[1];
                        if (in_array($filter_arr['status'],[6,8]))
                            $param = "(`created` >= '$date_from' AND `created` <= '$date_to' AND `changed` >= '$date_from' AND `changed` <= '$date_to')";
                        else
                            $param = "(`created` >= '$date_from' AND `created` <= '$date_to')";
                    } else{
                        $param = "(";

                        // Если ищем "одного из"
                        $or = null;
                        if ($equal_char == "=" and count($vals) > 1)
                            $param .= "$key IN ($val)";
                        else
                            foreach ($vals as $ival) {
                                if (substr_count($ival,'%')>0) {
                                        $ival = str_replace('@','%',$ival);
                                        $equal_char = ' LIKE ';
                                };

                                $param .= "$or`$key`$equal_char'$ival'";
                                if ($ival == 0) $param .= " OR `$key` is null";
                                if (!isset($or)) $or = " OR ";
                            }

                        // ВСЕГДА показываем заявки без исполнителей
                        if ($key=='performers')
                            $param .= " OR (`performers` = '' and `status` != '8') ";

                        $param .= ")";
                    }
                    $params .= "$and$param";
                    if (!isset($and)) $and = " AND ";

                break;

                case 'search':
                    $param = "($key LIKE '%$val%')";
                    $params .= "$or$param";
                    if (!isset($or)) $or = " OR ";
                break;
            }
        }
        if (strlen($params)==0) $params = 1;
        $filter_sql = "WHERE ($params AND `deleted` is null)";
    };

    $permissions_sql = ($permissions["area"]) ? " AND `area`='".$permissions["area"]."' " : "";
    $query = "SELECT $columns FROM $table $filter_sql$permissions_sql$order_by_sql$limit_sql";
//    echo "<!-- $query; -->\n";

    return $query;
};



/* Возвращает количество строк в выборке с учётом фильтра
 */
function getListRowCount($filter) {
    global $db;
    $query_pages_count = $db -> query(queryBuilder('helpdesk',"COUNT(*) AS `cnt`",$filter));
    $pages_count = $db -> result($query_pages_count) + 0;
    return $pages_count;
}


function getSearchListRowCount($needle) {
    global $db;

    $searchFields = "title,description,(SELECT `lastname` FROM `users` WHERE `uid`=helpdesk.`creator`)";
    $searchFieldsArr = explode(',',$searchFields);
    foreach ($searchFieldsArr as $field) {
        $filter[$field] = $needle;
    }
    $filter = json_encode($filter);

    $query_pages_count = $db -> query(queryBuilder('helpdesk',"COUNT(*) AS `cnt`",$filter,null,null,null,'search'));
    $pages_count = $db -> result($query_pages_count) + 0;
    return $pages_count;
}



/* Формирует данные для последующей передачи в Twig и генерации списка заявок
 * с учётом фильтров и сортировки.
 * На выходе - двумерный массив. На первом уровне - id заявки, на втором - все остальные данные по ней.
 */

function getSearchList($needle, $order_by, $order_desc, $page, $rows_per_page) {
    $searchFields = "title,description,(SELECT `lastname` FROM `users` WHERE `uid`=helpdesk.`creator`)";
    $searchFieldsArr = explode(',',$searchFields);
    foreach ($searchFieldsArr as $field) {
        $filter[$field] = $needle;
    }
    $filter = json_encode($filter);

    return getTicketList($filter, $order_by, $order_desc, $page, $rows_per_page, 'search');
}

function getTicketList($filter, $order_by, $order_desc=null, $page=null, $rows_per_page=10000,$query_type='filter') {
    global $db, $c;

    $limit = $page*$rows_per_page.",".$rows_per_page; // Лимиты

    $query_tickets = queryBuilder('helpdesk', '
                                       `id`,
                                       `status`,
                                       (SELECT `order` FROM helpdesk_statuses WHERE helpdesk.`status`=`id`) as `status_order`,
                                       `tags`,
                                       `title`,
                                       `area`,
                                       `performers`,
                                       `creator`,
                                       `changer`,
                                       `created`,
                                       `changed`,
                                       `deadline`,
                                       `rate`'
                                            ,$filter,
                                                $order_by,
                                                    $order_desc,
                                                        $limit,
                                                            $query_type);

    if ($query_tickets_res = $db -> query($query_tickets)) {
        while($tickets_res = $db -> fetch_assoc($query_tickets_res)) {
            $id = $tickets_res['id'];
            foreach ($tickets_res as $key=>$value)
                if ($value != '') $result[$id][$key]   = $value;
            $performers = explode(',',$result[$id]['performers']);
            $result[$id]['performers'] = array();
            foreach ($performers as $performer_id)
                $result[$id]['performers'][$performer_id] = $c['users'][$performer_id];
        }
    }
    return $result;
};

function getTicket($id){
    global $db;

    $query_ticket = "SELECT
                        `access`,
                        `area`,
                        `changed`,
                        `changer`,
                        `created`,
                        `creator`,
                        `comments` AS `comments_id`,
                        `contractor`,
                        `deadline`,
                        `description`,
                        `id`,
                        `parent`,
                        `performers`,
                        `status`,
                        `tags`,
                        `title`,
                        `rate`
                            FROM helpdesk WHERE `id`=$id";
    if ($query_ticket_res = $db -> query($query_ticket)) {
        $result = $db -> fetch_assoc($query_ticket_res);
        $result['tags'] = ($result['tags'] > 0) ? explode(",",$result['tags']) : 0;
    }

    $result['comments'] = getTicketComments($id,$result['comments_id']);
    return $result;
}

function saveTicket() {

}

function getTicketComments($ticket_id, $comments_ids = null) {
    global $db;

    if ($comments_ids == null) {
        $query_ticket = "SELECT `comments` FROM helpdesk WHERE `id`='$ticket_id'";
        if ($query_ticket_res = $db -> query($query_ticket))
            $comments_ids = $db -> fetch_row($query_ticket_res)[0];
    }

    $i=0;
    $query_comments = "SELECT * FROM helpdesk_comments WHERE `id` IN ($comments_ids)";
    if ($query_comments_res = $db -> query($query_comments)) {
        while ($row = $db -> fetch_assoc($query_comments_res)) {
            $result[$i] = $row;
            $i++;
        }
    }
    return $result;
}

function getUserFilters($admin_id) {
    global $db;

    $query_filters = $db -> query("SELECT `id`,`user`,`name`,`filter` FROM helpdesk_filter WHERE (`user`=0) OR (`user`='$admin_id') ORDER BY `name`");
    while($filters_res = $db -> fetch_assoc($query_filters))
        $result[$filters_res['id']] = $filters_res;
    return $result;
}

function getFilter($id) {
    global $db;

    $query = $db -> query("SELECT `filter` FROM helpdesk_filter WHERE (`id`=$id)");
    $result = ($result = $db -> result($query)) ? $result: "{}";

    return $result;
}

//function getTicketsTypes() {
//    global $db;
//
//    $query = $db -> query("SELECT * FROM helpdesk_types");
//    while($res = $db -> fetch_assoc($query))
//        $result[$res['id']] = $res;
//    return (isset($result)) ? $result : false;
//}

function getTicketsStatuses() {
    global $db;

    $query = $db -> query("SELECT * FROM helpdesk_statuses");
    while($res = $db -> fetch_assoc($query))
        $result[$res['id']] = $res;
    return (isset($result)) ? $result : false;
}

function getTicketsTags() {
    global $db;

    $query = $db -> query("SELECT * FROM helpdesk_tags ORDER BY `name`");
    while($res = $db -> fetch_assoc($query))
        $result[$res['id']] = $res;
    return (isset($result)) ? $result : false;
}

function email($recipients, $subject, $message_body, $attach_files = null) {
    global $CNF;

    require_once(WWW_ROOT."/lib/libmail.php");

    $mail = new Mail("utf-8");
    $mail -> From("Задачник ИТ;".$CNF["smtp_from"]);

    foreach($recipients as $recipient)
        $mail -> To($recipient);

    $mail -> Subject($subject);
    $mail -> Body($message_body, "html");
    $mail -> smtp_on($CNF["smtp_srv"],$CNF["smtp_login"],$CNF["smtp_pass"]);
    if (isset($attach_files))
        foreach ($attach_files as $attach_file)
            $mail -> Attach($_SERVER["DOCUMENT_ROOT"].$attach_file);

    return $mail -> Send();
}

function rateTicket($user, $ticket, $rating) {
    global $db;
    $old_ticket = getTicket($ticket);

    if ($old_ticket['rate'] != $rating) {

        $autocomment = "Оценил заявку на $rating баллов";
        $query_autocomment = "INSERT INTO helpdesk_comments (`creator`, `date`, `text`,`autocomment`) VALUES ('$user', NOW(), '$autocomment',true)";

        if ($db -> query($query_autocomment)) $autocomment_id = $db->insert_id();

        $comments_str = $old_ticket['comments_id'];
        if (strlen($comments_str) > 0) $comments_arr = explode(",", $comments_str);
        $comments_arr[] = $autocomment_id;
        $comments_str = implode(",", $comments_arr);
        $query_upd = $db -> query("UPDATE helpdesk SET `rate`='$rating', `status`='6', `comments`='$comments_str' WHERE `id`='$ticket'");
    }

    if ($old_ticket['rate'] == $rating or $query_upd) {
        $result['success'] = true;
        $result['msg'] = 'Спасибо за оценку!';
    } else {
        $result['success'] = false;
    }


    return $result;
}

function changeTicketStatus($user, $ticket, $status) {
    global $db;

    $statuses = getTicketsStatuses();
    $old_ticket = getTicket($ticket);
    $comments = $old_ticket['comments_id'];
    $autocomment = "Изменил статус на \"".$statuses[$status]["name"]."\".";
    $query_autocomment = $db -> query("INSERT INTO helpdesk_comments (`creator`, `date`, `text`,`autocomment`)
                                                              VALUES ('$user', NOW(), '$autocomment',true)");

    if ($query_autocomment) {
        $autocomment_id = $db -> insert_id();
        $comments = $comments.((strlen($comments) > 0) ? "," : "" ).$autocomment_id;
    }

    if ($status != $old_ticket["status"]) {
        $change_status_query = "INSERT INTO helpdesk_history (`changed`, `changer`, `ticket`,  `status`)
                                                      VALUES ( NOW(),   '$user',   '$ticket', '$status')";
        $db -> query($change_status_query);
    };

    $changed = "";
    if (in_array($status,[1,2,3,5,7,8])) $changed = ", `changed`=NOW(), `changer`='$user'";

    $query_upd = $db -> query("UPDATE helpdesk SET `status`='$status', `comments`='$comments' ".$changed." WHERE `id`='$ticket'");

    if ($query_upd) {
        $result['success'] = true;
        $result['msg'] = "Статус изменен на \"".$statuses[$status]["name"]."\"!";
    } else {
        $result['success'] = false;
    }

    return $result;
}

function getAverageRating($filter) {

    $rate_count = array(1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0);
    $tickets = getTicketList( $filter, "rate");

//    echo $filter.count($tickets)."\n";
    if (count($tickets)>0) {
        foreach ($tickets as $ticket) {
            if (isset($ticket["rate"]))
                $rating[$ticket["id"]] = $ticket["rate"];
                $rate_count[$ticket["rate"]] += 1;
        }
        $count = count($rating);
        if ($count > 0) {
            $result = array("count"  => count($rating),
                            "rating" => round(array_sum($rating)/$count*20));
        } else {
            $result = array("count" => 0, "rating" => 0);
        }
    } else {
        $result = array("count" => 0, "rating" => 0);
    }


    return $result;
}
