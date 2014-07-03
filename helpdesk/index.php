<?php

ini_set("display_errors",1);
error_reporting(E_ALL ^E_NOTICE);
require_once("../subs.php");
require_once("../conf.inc.php");
require_once("../lib/dblayer.php");
require_once("../vendor/autoload.php"); // Twig инициализация
require_once("./subs.php");
require_once("./conf.php");
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem("../templates"); // Twig папка с шаблонами
$twig   = new Twig_Environment($loader, array("cache" => "../cache", "auto_reload" => 1)); // Twig no cache
$template = 'helpdesk.twig';
$stage = checkRequest("stage"); // Стадия

if ($admin_login = isAuthorized()) {
    $comments = [];

    $TITLE['helpdesk/reports'] = "Отчёты";
    $STATUSES        = getTicketsStatuses();
    $c['MONTHS_G']   = $MONTHS_G;
    $c['admin_fio']  = $admin_login["lastname"]." ".$admin_login["firstname"];
    $c['admin_id']   = $admin_login["uid"];
    $c['statuses']   = $STATUSES;
    $c['access_level'] = $ACCESS_LEVEL;
    $c['dir']        = basename(__DIR__);
    $c['notify']     = getBurnedCounts($admin_login["uid"]);

    $c['filter']     = checkRequest("filter");

    $c['search']     = checkRequest("search");
    $c['stage']      = checkRequest("stage");
    $c['pagename']   = "helpdesk";
    $c["msg"]      = $_SESSION["msg"];
    $c["msg_type"] = $_SESSION["msg_type"];
    $default_order   = '`status_order`,(CASE WHEN `deadline`=0 THEN 1 ELSE 0 END), deadline';

    if (!isset($page_title)) $page_title = $TITLE[$c['dir']];

    $c['users']      = getUsers();
    $permissions     = getPermissions($admin_login["uid"], $c['users']);
    if ($permissions["bills"] == 'deny') unset($TITLE["bills"]);
    if ($permissions["users"] == 'deny') unset($TITLE["users"]);
    $c['permissions'] = $permissions;
    $c['sections']   = $TITLE;
    $c['admins']     = getAdmins();
    $c['areas']      = getAreas();
    $c['posts']      = getPosts();
    $c['tags']       = getTicketsTags();
    $c['filters']    = getUserFilters($admin_login["uid"]);

    foreach ($c['filters'] as $id => $filter)
        $c['filters'][$id]['count'] = getListRowCount($filter['filter']);

    if (!isset($stage) or in_array($stage, ['','search'])) {
        $c['r']  = (isset($_REQUEST['r']))? checkRequest("r"): $CNF["rows_in_page"]; //Rows (per page)
        $c['page'] = checkRequest("page");     // № текущей страницы
        $c['ob']   = checkRequest("ob");       // order_by
        $c['od']   = checkRequest("od");     // order_desc

        // Сортировка по умолчанию
        if (strlen($c['ob'])<1) {
            $c['ob'] = $default_order;
            $c['od'] = 0;
        }
    }

    switch ($stage) {

        // Поисковая выдача
        case "search":

            // Автопереход заявку #id
            if ($c['search'] == checkString($c['search']))
                if (getListRowCount('{"id":"'.$c['search'].'"}')==1) {
                    $template = 'helpdesk/ticket_edit.twig';
                    $c['id'] = $c['search'];
                    header("Location: ./?stage=edit&id=".$c['id']);
                }

            $c['pagename']   = 'Поиск "'.$c['search'].'" :: Задачник';
//            $c['r']   = $CNF["rows_in_page"];
            $row_count       = getSearchListRowCount($c['search']);
            $row_count2      = getSearchListRowCount(switchLayout($c['search']));
            if ($row_count2 > $row_count)
                $c['changedSearchText'] = switchLayout($c['search']);    //
            $c['row_count']  = getSearchListRowCount($c['search']);
            $c['pages']      = ceil($c['row_count']/$c['r']);
            $c['tickets']    = getSearchList($c['search'],$c['ob'],$c['od'],$c['page'],$c['r']);
            if ($c['ob'] == $default_order) $c['ob'] = '';
        break;

        // Новая задача
        case "new":
                $c['pagename']   = 'Новая заявка :: Задачник';
                $c['ticket'] = $DEFAULT_TICKET;
                if (!array_key_exists(2,$c['areas'])) $c['ticket']['area'] = key($c['areas']);
                $c['ticket']['contractor'] = $c['admin_id'];
                $c['ticket']['performers'] = $c['admin_id'];
                $c['ticket'][''] = $c['admin_id'];
                $template = 'helpdesk/ticket_edit.twig';
            break;

        // Редактирование задачи
        case "edit":
                $template    = 'helpdesk/ticket_edit.twig';
                $id          = checkRequest("id");
                $c['ticket'] = getTicket($id);
                $c['pagename'] = '#' . $c['ticket']['id'] . '. ' . $c['ticket']['title'] . ' :: Задачник';
                $c['ticket']['performers'] = explode(',',$c['ticket']['performers']);
                unset($_SESSION["msg"]);
                unset($_SESSION["msg_type"]);
            break;

        case "accept":
                $id     = checkRequest("id");
                $ticket = getTicket($id);
                $uid = $admin_login["uid"];
                $contractor = $ticket["contractor"];
                if (strlen($contractor) > 0 ) {
                    $contractor_name = $c['users'][$contractor]["lastname"]." ".$c['users'][$contractor]["firstname"];
                    if ($contractor==$uid)
                        $_SESSION["msg"] = "Вы уже приняли эту заявку.\nЗаймитесь её выполнением!";
                    else
                        $_SESSION["msg"] = "$contractor_name уже принял эту заявку.";
                    $_SESSION["msg_type"] = "error";
                    header("Location: http://".$_SERVER["HTTP_HOST"]."/helpdesk/?stage=edit&id=$id");
                } else {
                    $_SESSION["msg"] = "Заявка принята!\nВы назначены ответственным и исполнителем.";
                    $_SESSION["msg_type"] = "success";
//                    echo ("Location: http://".$_SERVER["HTTP_HOST"]."/helpdesk/?stage=save&id=$id&performers=$uid&contractor=$uid");
                    header("Location: http://".$_SERVER["HTTP_HOST"]."/helpdesk/?stage=save&id=$id&performers=$uid&contractor=$uid&status=2");
                }

            break;
        // Сохранение задачи
        case "save":
                $id          = checkRequest("id");
                $back        = checkRequest("back");
                $admin_id    = $admin_login['uid'];
                $admin_fio   = $admin_login['lastname']." ".$admin_login['firstname'];

                if ($id != '') {
                    // Апдейт заявки
                    foreach ($c['admins']    as $admin)    $admins[$admin['uid']]       = $admin['lastname']." ".$admin['firstname'];
//                    foreach ($c['tags']      as $tags)     $tags[$tag['id']]          = $tag['name'];
//                    foreach ($c['categories'] as $category) $categories[$category['id']] = $category['name'];
                    foreach ($c['statuses']  as $status)   $statuses[$status['id']]     = $status['name'];
                    $comment = checkRequest("comment");

                    $old_values  = $c['ticket'] = getTicket($id);
                    $value_names = array(   'access'        => $ACCESS_LEVEL,
                                            'area'          => $c['areas'],
                                            'tags'          => null,
                                            'contractor'    => $admins,
                                            'deadline'      => null,
                                            'description'   => null,
                                            'performers'    => $admins,
                                            'status'        => $statuses,
                                            'title'         => null,
                                            'type'          => $tag
                    );

                    foreach ($value_names as $name=>$value) {
                        $new_value = checkRequest($name);
                        $old_value = $old_values[$name];
                        if (($new_value and $new_value != $old_value) or ($name == 'deadline')) {
                            $new_values[$name] = $new_value;

                            if (count($new_values) > 1) $and = ', ';

                            if ($name == 'deadline')
                                if (strlen($new_value) == 0 or $new_value == 'не указан') $sql_columns .= "$and`$name`=null";
                                else $sql_columns .= "$and`$name`='".date("Y-m-d", strtotime($new_value))."'";
                            else $sql_columns .= "$and`$name`='$new_value'";

                            if ($value_names[$name] != null) {
                                $old_value_text = $value_names[$name][$old_value];
                                $new_value_text = $value_names[$name][$new_value];
                                $ext = " ($old_value_text > $new_value_text)";
                            } else $ext = "";
                            if ($name=='deadline') {
                                if ($new_value=='')
                                $ext = (strlen($old_value)>0) ?" ($old_value > $new_value)": " ($new_value)";
                            }
                            $changed_fields .= $and.$CHANGES_FIELDS_NAME[$name].$ext;
                        }
                    }

                    // Сохраняем историю изменения статусов
                    if ($new_values["status"] != $old_values["status"]) {
                        $new_status = $new_values["status"];
                        $change_status_query = "INSERT INTO helpdesk_history (`changed`,`changer`,`ticket`,`status`)
                          VALUES (NOW(), '$admin_id','$id', '$new_status')";
                        $db -> query($change_status_query);
                    };

                    //Уведомление постановщику при смене статуса другим пользователем
                    if (($old_values["creator"] != $admin_id) and
//                    if (
                        ($new_values["status"] != $old_values["status"]) and
                        (in_array($new_values["status"],[4,6,8]))) {
                            $c["title"] = isset($new_values["title"]) ? $new_values["title"] : $old_values["title"];
                            $creator_gid = $c["users"][$old_values["creator"]]["gid"];
                            $c["creator_login"] = $c["users"][$old_values["creator"]]["login"];

                            $c["STATUSES_ACTIONS"] = $STATUSES_ACTIONS;

                            if (strlen($comment) > 0) $c['comment'] = $comment;

                            if ($creator_gid==1) $c["action"] = "somebody_change_admin_ticket_status";
                            else                 $c["action"] = "somebody_change_user_ticket_status";

                            $c["changer"] = $c['admin_fio'];
                            $c["id"] = $id;
                            $c["status"] = $new_values["status"];
                            $c["rating_name"] = $RATING_NAME;
                            $user_email = $c["users"][$old_values["creator"]]["email"];
                            $user_email_body   = $twig->render("helpdesk/user_email.twig",  $c);
                            email([$user_email], "Заявка #$id. \"".$c["title"]."\" изменена", $user_email_body, ["/stat/img/helpdesk/rate_3_min.png"]);
                    }

                    //Уведомление новым исполнителям (кроме самого себя)
                    if (strlen($new_values["performers"]) > 0 and ($new_values["performers"] != $old_values["performers"])) {
                        $c["title"] = isset($new_values["title"]) ? $new_values["title"] : $old_values["title"];
                        $c["action"] = "you_are_performer";
                        $c["changer"] = $c['admin_fio'];
                        $c["id"] = $id;
                        $old_performers = explode(",",$old_values["performers"]);
                        $new_performers = explode(",",$new_values["performers"]);
                        $performers = array_diff($new_performers,$old_performers);
                        foreach ($performers as $performer)
                            if ($performer != $c['admin_id']) $recipient[$performer] = $c["users"][$performer]["email"];
                        $user_email_body   = $twig->render("helpdesk/user_email.twig",  $c);
                        if (isset($recipient))
                            email($recipient,"Заявка #$id. \"".$c["title"]."\" Вас назначили исполнителем",$user_email_body);
                    }

                    if (strlen($old_values['comments_id']) > 0)
                        $comments = explode(",",$old_values['comments_id']);

                    //Строим автокоммент
                    if ($changed_fields != "") {
                        $sql_columns .= ", ";
                        $autocomment = "Изменил $changed_fields.";

                        // Сохраняем автокоммент
                        $query_autocomment = $db -> query(
                            "INSERT INTO helpdesk_comments (`creator`, `date`, `text`,`autocomment`)
                                                    VALUES ('$admin_id', NOW(), '$autocomment',true)");
                        $autocomment_id = $db->insert_id();
                        $comments[] = $autocomment_id;
                    };

                    if (strlen($comment) > 0) {
                        $query_comment = $db -> query("INSERT INTO helpdesk_comments (`creator`, `date`, `text`,`autocomment`)
                                                        VALUES ('$admin_id', NOW(), '$comment',false)");
                        $comment_id = $db->insert_id();
                        $comments[] = $comment_id;
                    }
                    $comments = join(",",$comments);
                    if (strpos(",",$comments)===0) substr($comments, 1);

//                    echo "UPDATE helpdesk SET `changed`=NOW(),`changer`='$admin_id', ".$sql_columns."`comments`='$comments' WHERE `id`=$id";
                    $changed = ($old_values["status"] != checkRequest("status")) ? "`changed`=NOW(), " : "";
                    $query_upd = $db -> query("UPDATE helpdesk SET $changed `changer`='$admin_id', ".$sql_columns."`comments`='$comments' WHERE `id`=$id");

                } else {
                    // Сохранение новой заявки
                    $fields = array( 'access',   'area',        'contractor', 'created', 'creator',
                                     'deadline', 'description', 'performers', 'status',  'tags',   'title');

                    foreach ($fields as $field) {
                        $new_value = checkRequest($field);

                        if ($field == 'title') $new_value = ucfirst($new_value);

                        if ($new_value != '') {
                            if ($field=='deadline' and $new_value != 'не указан') $new_value = date("Y-m-d", strtotime($new_value));
                            $new[$field] = $new_value; // А надо ли?

                            if (count($new) > 1) $and = ',';
                            $sql_fields .= "$and`$field`";
                            $sql_values .= "$and'$new_value'";
                        }
                    }

//                    echo "INSERT INTO helpdesk ( $sql_fields, `created`,`creator` ) VALUES ( $sql_values, NOW(), '$admin_id')";
                    $query_add = $db -> query("INSERT INTO helpdesk ( $sql_fields, `created`,`creator` ) VALUES ( $sql_values, NOW(), '$admin_id')");
                    $id = $db -> insert_id();

                    //Уведомление новым исполнителям (кроме самого себя)
                    if (strlen(checkRequest("performers") > 0)) {
                        $c["title"] = check_string($_REQUEST["title"],"text");
                        $c["action"] = "you_are_performer";
                        $c["changer"] = $c['admin_fio'];
                        $c["id"] = $id;
                        $performers = explode(",",checkRequest("performers"));
                        foreach ($performers as $performer)
                            if ($performer != $c['admin_id']) $recipient[$performer] = $c["users"][$performer]["email"];
                        $user_email_body   = $twig->render("helpdesk/user_email.twig",  $c);
                        if (isset($recipient))
                            email($recipient,"Вас назначили исполнителем заявки #$id. \"$c[title]\"",$user_email_body);
                    }

                    // Сохраняем историю изменения статусов
                    $change_status_query = "INSERT INTO helpdesk_history (`changed`,`changer`,`ticket`,`status`)
                      VALUES (NOW(), '$admin_id','$id', '1')";
                    $db -> query($change_status_query);

                }

                // Куда перенаправляем?
                $url = ($back==1)? "/helpdesk" : "/helpdesk?stage=edit&id=$id";

                header("Location: http://".$_SERVER["HTTP_HOST"].$url);
            break;

        // Список всех заявок с фильтром/без
        default:
                if (!$c['filter']) {
                    $settings = json_decode($admin_login['settings'],true);
                    $def_filter = $settings['helpdesk_def_filter'];
                    if ($def_filter) {
                        $filter = getFilter($def_filter);
                        header("Location: ./?filter=$filter");
                    }
                }
            $c['row_count']  = getListRowCount($c['filter']);
            $c['pages']      = ceil($c['row_count']/$c['r']);
            $c['tickets']    = getTicketList($c['filter'],$c['ob'],$c['od'],$c['page'],$c['r'],'filter');
            if ($c['ob'] == $default_order) $c['ob'] = '';
        break;
    }

//    $c['test'] = microtime() - $c['test'];
    echo $twig->render($template, $c);

} else {
    $_SESSION["ref"] = "helpdesk";
    authorize();
}

//echo $c['test'] = microtime()*1000 - $c['test']*1000;
if ($db_err["error_no"] != null) print_r($db_err); // DB-errors

//print_r($c["msg"]);