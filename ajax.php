<?php

ini_set("display_errors",1);
error_reporting(E_ALL ^E_NOTICE);
session_start();
require_once($_SERVER["DOCUMENT_ROOT"]."/subs.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/conf.inc.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/lib/dblayer.php");

$result['msg'] = "Unknown error";
$result['success'] = false;

if ($admin_login = isAuthorized()) {
    $action = checkRequest("action");

    switch ($action) {
        case "getBurningCounts":
            $result = getBurnedCounts($admin_login['uid']);
        break;
    }
}

print_r(json_encode($result));