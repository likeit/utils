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

if ($c = isAuthorized()) {

    $TITLE['helpdesk/reports'] = "Отчёты";
    $users       = getUsers();
    $permissions = getPermissions($c["uid"], $users);
    if ($permissions["bills"] == 'deny') unset($TITLE["bills"]);
    if ($permissions["users"] == 'deny') unset($TITLE["users"]);

    $c['sections'] = $TITLE;
    $c['dir']      = "helpdesk/reports";
    $c['admin_fio']  = $c["lastname"]." ".$c["firstname"];
    $c['notify']     = getBurnedCounts($c["uid"]);
    $admins   = getAdmins(true);
    $performer = (isset($_REQUEST["performer"])) ? check_string($_REQUEST["performer"],"digits") : null;
    $p = (isset($performer)) ? array($admins[$performer]['uid'] => $admins[$performer]) : $admins;
//    print_r($p);
    $month = (int) ((isset($_REQUEST["m"])) ? check_string($_REQUEST["m"],"digits") : date("m"));
    $year  = (isset($_REQUEST["y"])) ? check_string($_REQUEST["y"],"digits") : date("Y");
    $days = date("t", strtotime("$year-$month-1"));
    if ($month > 0)
        $dates = "$year-$month-1,$year-$month-$days 23:59:59";
    else
        $dates = "$year-1-1,$year-12-31 23:59:59";
    $c["performer"] = $performer;
    $c["MONTHS"] = $MONTHS;
    $c["MONTHS"][0] = "весь год";
    $c["month"]  = $month;
    $c["year"]   = $year;
    $c["dates"]  = $dates;
    foreach ($p as $admin) {
        $uid = $admin['uid'];
        $p[$uid]['filter_opened']       = '{"performers":"@'.$uid.'@","dates":"'.$dates.'"}';
        $p[$uid]['filter_done']         = '{"performers":"@'.$uid.'@","status": "4","dates":"'.$dates.'"}';
        $p[$uid]['filter_waited']       = '{"performers":"@'.$uid.'@","status": "5","dates":"'.$dates.'"}';
        $p[$uid]['filter_paused']       = '{"performers":"@'.$uid.'@","status": "7","dates":"'.$dates.'"}';
        $p[$uid]['filter_closed']       = '{"performers":"@'.$uid.'@","status": "6","dates":"'.$dates.'"}';
        $p[$uid]['filter_cancelled']    = '{"performers":"@'.$uid.'@","status": "8","dates":"'.$dates.'"}';
        $p[$uid]['opened']              = getListRowCount($p[$uid]['filter_opened']);
        $p[$uid]['done']                = getListRowCount($p[$uid]['filter_done']);
        $p[$uid]['waited']              = getListRowCount($p[$uid]['filter_waited']);
        $p[$uid]['paused']              = getListRowCount($p[$uid]['filter_paused']);
        $p[$uid]['closed']              = getListRowCount($p[$uid]['filter_closed']);
        $p[$uid]['cancelled']           = getListRowCount($p[$uid]['filter_cancelled']);
        $p[$uid]['result']              = (($p[$uid]['opened'] - $p[$uid]['waited'] - $p[$uid]['paused'] - $p[$uid]['cancelled']) > 0 ) ? ($p[$uid]['done'] + $p[$uid]['closed']) / ($p[$uid]['opened'] - $p[$uid]['waited'] - $p[$uid]['paused'] - $p[$uid]['cancelled']) : 0;
        $p[$uid]['percentage_r1']       = round($p[$uid]['result'], 2) * 100;
        $p[$uid]['percentage_r2']       = round($p[$uid]['result'], 2) * 100;
        $p[$uid]['rating']              = getAverageRating($p[$uid]['filter_opened']);
//        print_r($p[$uid]['rating']);
        $p[$uid]['rating']['rating_r']  = round($p[$uid]['rating']['rating']/100,2) * 100;
        if ($p[$uid]['opened'] == 0) unset($p[$uid]);
    }

    $p['all']['firstname']          = 'Всего';
    $p['all']['filter_opened']      = '{"dates": "'.$dates.'"}';
    $p['all']['filter_done']        = '{"status": "4",  "dates": "'.$dates.'"}';
    $p['all']['filter_waited']      = '{"status": "5", "dates":"'.$dates.'"}';
    $p['all']['filter_paused']      = '{"status": "7", "dates":"'.$dates.'"}';
    $p['all']['filter_closed']      = '{"status": "6", "dates": "'.$dates.'"}';
    $p['all']['filter_cancelled']   = '{"status": "8", "dates": "'.$dates.'"}';
    $p['all']['opened']             = getListRowCount($p['all']['filter_opened']);
    $p['all']['done']               = getListRowCount($p['all']['filter_done']);
    $p['all']['waited']             = getListRowCount($p['all']['filter_waited']);
    $p['all']['paused']             = getListRowCount($p['all']['filter_paused']);
    $p['all']['closed']             = getListRowCount($p['all']['filter_closed']);
    $p['all']['cancelled']          = getListRowCount($p['all']['filter_cancelled']);
    $p['all']['result']             = (($p['all']['opened'] - $p['all']['waited'] - $p['all']['paused'] - $p['all']['cancelled']) > 0 ) ? ($p['all']['done'] + $p['all']['closed']) / ($p['all']['opened'] - $p['all']['waited'] - $p['all']['paused'] - $p['all']['cancelled']) : 0;
    $p['all']['percentage_r1']      = round($p['all']['result'], 2) * 100;
    $p['all']['percentage_r2']      = round($p['all']['result'], 2) * 100;
    $p['all']['rating']             = getAverageRating($p['all']['filter_closed']);
    $p['all']['rating']['rating_r'] = round($p['all']['rating']['rating']);

    $c['admins'] = $admins;
    $c['performers'] = $p;

        echo $twig->render("helpdesk/reports.twig", $c);
} else {
    echo "Access denied";
}