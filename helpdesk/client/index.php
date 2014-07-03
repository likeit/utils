<?php

require_once("$_SERVER[DOCUMENT_ROOT]/conf.inc.php");
ini_set("display_errors",1);
error_reporting(E_ALL ^E_NOTICE);
require_once("$_SERVER[DOCUMENT_ROOT]/vendor/autoload.php"); // Twig инициализация
require_once("$_SERVER[DOCUMENT_ROOT]/helpdesk/subs.php");
require_once("$_SERVER[DOCUMENT_ROOT]/helpdesk/conf.php");
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem("../../templates"); // Twig папка с шаблонами
$twig   = new Twig_Environment($loader, array("cache" => "",)); // Twig no cache
session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['username'] = $_REQUEST['u'];
    $_SESSION['userpass'] = $_REQUEST['p'];
    $_SESSION['usercomp'] = $_REQUEST['c'];
    $_SESSION['useros']   = $_REQUEST['os'];
};

if (isset($_REQUEST['u'])) {
    unset($_REQUEST['u']);
    unset($_REQUEST['p']);
    unset($_REQUEST['c']);
    unset($_REQUEST['os']);

    $url = "http://utils.z-area.ru/helpdesk/client/";
    $rating = checkRequest('r', false);
    $rating = $rating ? "&r=$rating" : "";
    if     (checkRequest('ticket')) header("Location: $url?ticket=$_REQUEST[ticket]");
    elseif (checkRequest('list'))   header("Location: $url?list");
    else header("Location: $url");
}


if ($c = isKnownUser($_SESSION['username'],$_SESSION['userpass'])) {
    $uid            = $c["uid"];
    $users          = getUsers();
    $c['MONTHS_G']   = $MONTHS_G;
    $c['usercomp']  = $_SESSION['usercomp'];
    $c['useros']    = $_SESSION['useros'];
    $c['dir']       = 'helpdesk';
    $c['admins']    = getAdmins();
    $c['users']     = $users;
    $c['statuses']  = getTicketsStatuses();
    $c['msg']       = $_SESSION['msg'];      unset($_SESSION['msg']);
    $c['msg_type']  = $_SESSION['msg_type']; unset($_SESSION['msg_type']);
    $c["is_boss"]   = (in_array($users[$uid]['post_id'],[1,5,9,37,68,21,60,25,51,29,35,57,59,40,46]));

    if (isset($_REQUEST['list']) or isset($_REQUEST['dept_list'])) {
        $c['section'] = checkRequest('list') !== false ? 'list' : (checkRequest('dept_list') !== false ? 'dept_list' : "");
        $section = 'list';
        $c["pagename"] = "Мои заявки :: Задачник IT";
        $c['access_level'] = $ACCESS_LEVEL;
        $creator = $c["uid"];
        if ($c["is_boss"]) {
            $dept_users = getUsersListByDept($users[$uid]['dept_id']);
            if ($c['section'] == 'dept_list')
                $creator = implode(",", $dept_users);
        }

        $c['filter']     = "{\"creator\":\"$creator\"}";
        $c['search']     = checkRequest('search');
        $default_order   = '`status`,`created` DESC';

        if (!isset($page_title)) $page_title = $TITLE[$c['dir']];

        $c['r']  = $CNF["rows_in_page"];        //Rows (per page)
        $c['page'] = checkRequest('page', 0);   // № текущей страницы
        $c['ob']   = checkRequest('ob');        // order_by
        $c['od']   = checkRequest('od', false); // order_desc

        // Сортировка по умолчанию
        if ($c['ob'] == "") {
            $c['ob'] = $default_order;
            $c['od'] = false;
        }
        $c['row_count']  = getListRowCount($c['filter'],'filter');
        $c['pages']      = ceil($c['row_count']/$c['r']);
        $c['tickets']    = getTicketList($c['filter'],$c['ob'],$c['od'],$c['page'],$c['r'],'filter');
        if ($c['ob'] == $default_order) $c['ob'] = '';
    } elseif (isset($_REQUEST['ticket'])) {
                $section       = 'ticket_view';
                $id            = checkRequest('ticket');
                $rating        = checkRequest('r');
                if ($rating > 0) {
                    $message = rateTicket($uid, $id, $rating);
                    $c['msg_type'] = $message['success'] ? 'success' : 'error';
                    $c['msg']      = $message['msg'];
                }
                $c['ticket']   = getTicket($id);
                $c['pagename'] = '#' . $c['ticket']['id'] . '. ' . $c['ticket']['title'] . ' :: Задачник';
                $c['ticket']['performers'] = explode(',',$c['ticket']['performers']);
    } elseif (isset($_REQUEST['save'])) {
        $title       = checkRequest('title');
        $description = checkRequest('description');

        if (isset($uid) and isset($title) and isset($description)) {
            $description .= "\n\n-----\nКомпьютер:\t$c[usercomp]\nОС:\t\t\t$c[useros]\nБраузер:\t$_SERVER[HTTP_USER_AGENT]";
            $query_add = $db -> query("INSERT INTO helpdesk ( `created`, `creator`, `title`,  `description` )
                                                     VALUES (  NOW(),   '$uid',    '$title', '$description')");
            $id = $db->insert_id();

            $change_status_query = "INSERT INTO helpdesk_history (`changed`,`changer`,`ticket`,`status`)
                                                           VALUES (NOW(),  '$uid',   '$id',    '1')";
            $db -> query($change_status_query);

        $url = "/helpdesk/client?ticket=$id";

        $c["title"]   = $title;
        $c["action"]  = "your_ticket_created";
        $c["creator"] = $c["lastname"]." ".$c["firstname"];
        $c["id"]      = $id;
        $c["email"]   = $c["users"][$uid]["email"];
        $c["description"] = $description;
        $itdept_mail  = "it-dept@autoexpres.ru";
        $user_email_body   = $twig->render("helpdesk/user_email.twig",  $c);
        $itdept_email_body = $twig->render("helpdesk/itdept_email.twig", $c);

        if (email([$c["email"]],"Заявка \"$title\" создана",$user_email_body) and
            email([$itdept_mail],"Новая заявка: \"$title\"", $itdept_email_body))
            $_SESSION["msg"] = "Заявка \"$title\" успешно создана!";
            $_SESSION["msg_type"] = "success";
            header("Location: http://$_SERVER[HTTP_HOST]$url");
        } else {
            $_SESSION["msg"] = "Не удалось создать заявку =(";
            $_SESSION["msg_type"] = "error";
        }
    } else {
        $section = 'new';
        $c["pagename"] = "Новая заявка :: Задачник IT";
    }

    if (isset($section)) {
        $template = "helpdesk/client/$section.twig";
        echo $twig->render($template, $c);
    }
} else {
    echo "Access denied";
}