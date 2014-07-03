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
        $content['admin_fio'] = $admin_login["lastname"]." ".$admin_login["firstname"];
        $content['admin_id']  = $admin_login["uid"];
        $content['dir']       = basename(__DIR__);
        $content['notify']    = getBurnedCounts($admin_login["uid"]);

        $users            = getUsers();
        $permissions      = getPermissions($admin_login["uid"], $users);
        if ($permissions["bills"] == 'deny') unset($TITLE["bills"]);
        if ($permissions["users"] == 'deny') unset($TITLE["users"]);
        if (isset($permissions["area"])) $area_sql = " AND `area_id`='".$permissions["area"]."'";
        $content['permissions'] = $permissions;
        $content['sections']  = $TITLE;
        $content['areas'] = getAreas();
        unset($content['areas'][2]);


        if (!isset($page_title)) $page_title = $TITLE[$content['dir']];

        $query_statuses = $db -> query("SELECT `id`,`name` FROM users_statuses WHERE `deleted` is null ORDER BY `order`");
        while($statuses_res = $db -> fetch_row($query_statuses)) $content['user_statuses'][$statuses_res[0]] = $statuses_res[1];

        foreach ($content['user_statuses'] as $k=>$v) {
            $query_cnt = $db -> query("SELECT SQL_NO_CACHE COUNT(*) AS `cnt` FROM users WHERE `status_id`='$k'".$area_sql);
            $content['users_cnt'][$k] = $db -> result($query_cnt);
        }

        $query_index = "SELECT
                            `id`,
                            `model`,
                            (SELECT `name` FROM `supply_models` WHERE supply_models.`id`=`model`) AS `model_name`,
                            (SELECT `cartridge4u_id` FROM `supply_models` WHERE supply_models.`id`=`model`) AS `buy_id`,
                            `area`,
                            `use`,
                            `full` FROM supply WHERE `deleted`!=1";
        if ($query_index_res = $db -> query($query_index))
        {
                while($index_res = $db -> fetch_assoc($query_index_res)) {
                    $id         = $index_res['id'];
                    $use        = $index_res['use'];
                    $full       = $index_res['full'];

                    $status = ($use>0) ? $full / $use: 10;
                    if ($status>1.3)
                        $status = 2;
                    else if ($status>0.65)
                            $status = 3;
                        else $status = 1;

                    foreach ($index_res as $k=>$v)
                        $content['warning_supplies'][$id][$k]   = $v;
                    $content['warning_supplies'][$id]['status']     = $status;
                }
        }

        echo $twig->render('dashboard.twig', $content);


} else authorize();

if ($db_err["error_no"] != null) { print_r($db_err); }; // DB-errors