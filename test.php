<?php

require("subs.php");
require_once("conf.inc.php");
require_once("lib/dblayer.php");

$btn_home           = "<a class='button' href='./'><<</a>";

$db = new DBLayer($CNF["db_host"],$CNF["db_user"],$CNF["db_pass"],$CNF["db_name"]);
$db -> query("SET NAMES utf8");

$q =  "SELECT
                u.`uid`,
                u.`modiff`,
                DATE_FORMAT(u.`modiff`,'%d.%m.%Y %H:%i:%s') AS `modiff_fmt`,
                (SELECT CONCAT(`lastname`,' ',`firstname`) FROM users WHERE `uid`=u.`modiff_uid`) AS `modiff_uid`,
                u.`status_id`,
                u.`lastname`,
                u.`firstname`,
                u.`middlename`,
                u.`login`,
                u.`pass`
                         FROM users AS u ORDER BY `uid` DESC LIMIT 5";

if ($qry = $db -> query($q))
{
    eval(tmplt_gen("stat/forms/begin.form"));
    eval(tmplt_gen("users/forms/filter.form"));
    while($res = $db -> fetch_assoc($qry)) $page .= table_users($res);
    $page .= "</table>";
    $page .= "<div class='table-footer'><span class='statusbar'>&nbsp;</span>";

} else echo 'error';

//print_r($res);
echo $page;

$db_err = $db -> error();
$db -> close();
if ($db_err["error_no"] != null) { print_r($db_err); }; // DB-errors
?>