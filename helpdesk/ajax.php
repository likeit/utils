<?php

ini_set("display_errors",1);
error_reporting(E_ALL ^E_NOTICE);
session_start();
require_once("./subs.php");
require_once("./conf.php");
require_once("../subs.php");
require_once("../conf.inc.php");
require_once("../lib/dblayer.php");

$result['msg'] = "Unknown error";
$result['success'] = false;


if (($admin_login = isKnownUser($_SESSION['username'])) or ($admin_login = isAuthorized())){

        /*  Получаем параметры в виде JSON-объекта и преобразуем в асс.массив
         *  Обязательный параметр - 'action'
         * */

        $action = $_REQUEST['action'];
        $c['admin_id']   = $admin_login["uid"];
        $users = getUsers();

        switch ($action) {

            // Сохраняем пользовательский фильтр
            case 'saveNewFilter' :
                $global  = check_string($_REQUEST['global'], 'digits');
                $user_id = ($global!=1) ? $admin_login['uid']: '0';
                $name    = check_string($_REQUEST['name'],   'text');
                $filter  = check_string($_REQUEST['filter'], 'json');
                if ($filter != '' and $user_id != '' and $name != '' and $global != '' ){
                    $query_save = $db -> query("INSERT INTO helpdesk_filter (`name`, `user`, `filter`)
                                                                     VALUES ('$name', '$user_id', '$filter')");

                    if ($query_save) {
                        $result['success'] = true;
                        $result['msg'] = "Фильтр $name успешно сохранён";
                    }
                } else
                    $result['msg'] = "Не могу сохранить фильтр :(";

                break;

            case 'deleteFilter':
                $filter_id = check_string($_REQUEST['filter_id'], 'digits');
                $query_delete_filter = $db -> query("DELETE FROM `helpdesk_filter` WHERE `id`='$filter_id'");
                if ($query_delete_filter) {
                    $result['success'] = true;
                    $result['msg'] = "Фильтр успешно удалён";
                } else {
                    $result['msg'] = "Не получилось удалить $filter_id фильтру :(";
                }
                break;

            case 'setDefaultFilter':
                $filter_id = checkRequest("filter_id");
                $user_id = $admin_login["uid"];
                $query_setting = $db -> query("SELECT `settings` FROM `users` WHERE `uid`='$user_id'");
                if ($query_setting) {
                    $settings = $db -> result($query_setting);
                    if ($settings != "") $settings_arr = json_decode($settings,true);

                    $settings_arr["helpdesk_def_filter"] = $filter_id;
                    $settings_sql = json_encode($settings_arr);

                    $query_upd_settings = $db -> query("UPDATE `users` SET `settings`='$settings_sql' WHERE `uid`='$user_id'");

                    if ($query_upd_settings) {
                        $result['success'] = true;
                        $result['msg'] = "Фильтр по умолчанию изменён";
                    }
                } else {
                    $result['msg'] = "Не удалось определить пользователя, попробуйте позже :(";
                }
                break;

            case 'updateFilters':
                $c["admins"] = getAdmins();
                require_once("../vendor/autoload.php"); // Twig инициализация
                Twig_Autoloader::register();
                $loader = new Twig_Loader_Filesystem("../templates/helpdesk"); // Twig папка с шаблонами
                $twig   = new Twig_Environment($loader, array("cache" => "",)); // Twig no cache

                $query_filters = $db -> query("SELECT `id`,`user`,`name`,`filter` FROM helpdesk_filter WHERE (`user`=0) OR (`user`=".$admin_login['uid'].") ORDER BY `name`");
                while($filters_res = $db -> fetch_assoc($query_filters))
                    $c['filters'][$filters_res['id']] = $filters_res;

                foreach ($c['filters'] as $id => $filter)
                    $c['filters'][$id]['count'] = getListRowCount($filter['filter']);

                $result['filters_block'] = $twig->render('filters_block.twig', $c);
                $result['success'] = true;
                unset($result['msg']);
                break;

            case 'getTicketInfo' :
                require_once("../vendor/autoload.php"); // Twig инициализация
                Twig_Autoloader::register();
                $loader = new Twig_Loader_Filesystem("../templates/helpdesk"); // Twig папка с шаблонами
                $twig   = new Twig_Environment($loader, array("cache" => "",)); // Twig no cache
                $id = $_POST['ticket_id'];


                $AREAS = getAreas();
                $ADMINS = getAdmins();

                $query_info = "SELECT
                                    `id`,
                                    `title`,
                                    `creator`,
                                    `contractor`,
                                    `performers`,
                                    `area`,
                                    `description`,
                                    DATE_FORMAT(`created`, '%d.%m.%Y') as `created`,
                                    DATE_FORMAT(`changed`, '%d.%m.%Y') as `changed`,
                                    DATE_FORMAT(`deadline`,'%d.%m.%Y') as `deadline`,
                                    `type`,
                                    `status`,
                                    `parent`,
                                    `tags`,
                                    `comments`,
                                    `category`,
                                    `access`
                                        FROM helpdesk WHERE `id`=$id";
                if ($query_info_res = $db -> query($query_info)) {
                    $info_data = $db -> fetch_assoc($query_info_res);
                    $info_data['statuses']   = getTicketsStatuses();
                    $info_data['types']      = getTicketsTypes();
                    $info_data['categories'] = getTicketsCategories();
                    $info_data['admins']     = $ADMINS;
                    $info_data['comments']   = getTicketComments($id);
                    $info_data['areas']      = $AREAS;

                    $result['ticket_info'] = $twig->render('ticket_info.twig', $info_data);
                    unset($result['msg']);
                }
                break;

            case "saveNewComment":
                $ticket_id           = check_string($_REQUEST['ticket_id'], 'digits');
                $result['ticket_id'] = $ticket_id;
                $text                = check_string($_REQUEST['text'],      'text');
                $result['text']      = $text;
                $admin_id            = $admin_login['uid'];
                $result['admin_id']  = $admin_id;

//                $query_comments = $db -> query("SELECT `comments` FROM helpdesk WHERE `id`='$ticket_id'");
                $comments = getTicket($ticket_id)["comments_id"];
                $query_add_comment = $db -> query("INSERT INTO helpdesk_comments (`creator`, `date`, `text`) VALUES ('$admin_id', NOW(), '$text')");
                $new_comment = $db->insert_id();
                if (strlen($comments) > 0) $new_comment = "$comments,$new_comment";
                $query_upd = $db -> query("UPDATE helpdesk SET `comments`='$new_comment' WHERE `id`='$ticket_id'");
                if ($query_upd) {
                    $result['success'] = true;
                    $result['msg'] = 'Комментарий сохранён';
                };

                // Если комментарий клиентский, уведомить исполнителей
                if (!isAdmin($users,$admin_id)) {
                    require_once("../vendor/autoload.php"); // Twig инициализация
                    Twig_Autoloader::register();
                    $loader = new Twig_Loader_Filesystem("../templates"); // Twig папка с шаблонами
                    $twig   = new Twig_Environment($loader, array("cache" => "",)); // Twig no cache

                    $c = getTicket($ticket_id);
                    $c["action"] = "user_add_comment";
                    $c["changer"] = getFullname($users, $admin_id);
                    $performers = explode(",",$c["performers"]);
                    foreach ($performers as $performer)
                        $mailto[$performer] = $users[$performer]["email"];
                    $c['comment'] = $text;
                    $user_email_body   = $twig->render("helpdesk/user_email.twig",  $c);
                    email($mailto,"Заявка #$ticket_id. \"".$c["title"]."\": новый комментарий",$user_email_body);
                }

                break;

            case "rateTicket":
                $ticket = check_string($_REQUEST['ticket'], 'digits');
                $rating = check_string($_REQUEST['rating'], 'digits');
                $result = rateTicket($admin_login["uid"], $ticket, $rating);
            break;

            case "changeTicketStatus":
                $ticket = check_string($_REQUEST['ticket'], 'digits');
                $status = check_string($_REQUEST['status'], 'digits');
                $result = changeTicketStatus($admin_login["uid"], $ticket, $status);
            break;

            case 'reloadComments':
                require_once("../vendor/autoload.php");
                Twig_Autoloader::register();
                $loader = new Twig_Loader_Filesystem("../templates/helpdesk");
                $twig   = new Twig_Environment($loader, array("cache" => "",));

                $c['users'] = getUsers();
                $c['uid']   = $admin_id;

                $ticket_id = check_string($_REQUEST['ticket_id'], 'digits');
                $hide_autocomments = check_string($_REQUEST['hide_autocomments'], 'text');
                $c['ticket']['comments'] = getTicketComments($ticket_id);

                $template = $hide_autocomments==0 ? 'ticket_edit_comments.twig' : 'client/ticket_view_comments.twig';
                $result['comments_block'] = $twig->render($template, $c);
                $result['success'] = true;
                unset($result['msg']);

                break;
        }

};

/*  Возвращаем результат также в виде JSON-объекта.
 *  В случае безошибочного получения результата,
 *  Делаем $result['success'] = true;
 *  Остальные параметры - опциональные
 *  */
print_r(json_encode($result));
