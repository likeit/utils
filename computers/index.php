<?php

ini_set("display_errors",1);
error_reporting(E_ALL ^E_NOTICE);

require_once("../subs.php");
require_once("../conf.inc.php");
require_once("../lib/dblayer.php");
require_once "../vendor/autoload.php"; // Twig инициализация
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem("../templates"); // Twig папка с шаблонами
$twig   = new Twig_Environment($loader, array("cache" => "",)); // Twig no cache

if ($admin_login = isAuthorized()) {
    $c['nojs'] = true;
    $c['admin_fio'] = $admin_login["lastname"]." ".$admin_login["firstname"];
    $c['admin_id']  = $admin_login["uid"];
    $c['dir']       = basename(__DIR__);
    $c['notify']    = getBurnedCounts($admin_login["uid"]);

//    print_r($_SERVER['HTTP_USER_AGENT']);

    $users            = getUsers();
    $permissions      = getPermissions($admin_login["uid"], $users);
    if ($permissions["bills"] == 'deny') unset($TITLE["bills"]);
    if ($permissions["users"] == 'deny') unset($TITLE["users"]);
    if (isset($permissions["area"])) $area_sql = " AND `area_id`='".$permissions["area"]."'";
    $c['permissions'] = $permissions;
    $c['sections']  = $TITLE;

    $area_filter = checkRequest("area", 2);
    if ($area_filter >= 0) {
        $c["area_filter"] = $area_filter;
        $area_ip = $IP[$area_filter];
        $areas = getAreas();
        $areas[2] = "Все" ;
        $c["areas"] = $areas;
    }

    $c['r']  = checkRequest("r", 20) ; //Rows (per page)
    $c['page'] = checkRequest("page", 0);                // № текущей страницы
    $c['ob']   = checkRequest("ob", "name");             // order_by
    $c['od']   = checkRequest("od");                     // order_desc

    $c['computers'] = getComputers($area_filter, $c['r'], $c['page'], $c['ob'], $c['od']);
    $c['computers_online'] = getOnlineComputers();
    $c['users'] = $users;
    $c['users_online'] = getOnlineUsersByComputers();
    $c['count'] = getComputersCount($area_filter);
    $c['pages'] = ceil($c['count']/$c['r']);

    // Сортировка по умолчанию
    if (strlen($c['ob'])<1) {
        $c['ob'] = $default_order;
        $c['od'] = 0;
    }

    echo $twig->render('computers.twig', $c);


} else authorize();

//print_r($db -> error());