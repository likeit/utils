<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/lib/dblayer.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/subs.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/conf.inc.php");

$db = new DBLayer($CNF["db_host"],$CNF["db_user"],$CNF["db_pass"],$CNF["db_name"]);
$db -> query("SET NAMES utf8");

$action   = checkRequest("action");
$domain   = checkRequest("domain");
$username = checkRequest("username");
$user_id  = getUserByUsername($username)['uid'];
if ($user_id < 1) $user_id = createUser($username);
$workstation = mb_strtolower(checkRequest("workstation"), "UTF-8");
$ip          = trim(checkRequest("ip"));
$workstation_id = (strlen($workstation) > 0) ? checkWorkstation($workstation, $ip) : null;
switch ($action) {
    case "start":
        logonWorkstation($workstation_id, $ip);
    break;

    case "shutdown":
        echo "ws: $workstation_id, IP: $ip";
        logoffWorkstation($workstation_id);
    break;

    case "logon":
        echo $workstation_id;
        logonWorkstation($workstation_id, $ip);
        logonUser($user_id, $domain, $workstation_id);
    break;

    case "logoff":
        logoffUser($user_id);
    break;
}