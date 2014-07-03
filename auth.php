<?php
/*
 * auth.php
 * TEST authentication page
 */

ini_set("display_errors",1);
error_reporting(E_ALL ^E_NOTICE);
session_start();
require("subs.php");
require("conf.inc.php");
require("lib/dblayer.php");
$stage = isset($_REQUEST["stage"]) ? check_string($_REQUEST["stage"],"string") : null; // Стадия
// Авторизация
global $CNF;

//echo $stage;

if ($stage == "auth") // Нажата кнопка "auth"
{
    $db = new DBLayer($CNF["db_host"],$CNF["db_user"],$CNF["db_pass"],$CNF["db_name"]);
    $db -> query("SET NAMES utf8");

    $login     = check_string($_REQUEST["login"],"string");
    $pass_hash = md5($_REQUEST["pass"]);
//    echo    "SELECT `uid` FROM users WHERE `login`='$login' AND `pass_hash`='$pass_hash'";
    $query_auth = $db -> query("SELECT `uid` FROM users WHERE `login`='$login' AND `pass_hash`='$pass_hash'");
    $db -> num_rows($query_auth);
    if ($query_auth and ($db -> num_rows($query_auth) == 1)) {
        $admin_login = $db -> fetch_assoc($query_auth);
//        $hash = md5(microtime()); // Случайная строка-хеш (32-символа)
//        $db -> query("UPDATE admins SET `hash`='".$hash."' WHERE `uid`='".$admin_login['uid']."'"); // Запись хеша в БД

        # Печеньки:
        $cookie_lifetime = (isset($_REQUEST["remember"]) == "on") ? strtotime("+1 year") : 0; // Время жизни: 1 год или 0 - до закрытия броузера
        setcookie("user_id", $admin_login['uid'], $cookie_lifetime);
        setcookie("hash", $pass_hash, $cookie_lifetime);

        unset($stage,$_POST["name"],$_POST["pass"],$_REQUEST["stage"]);
        header("Location: http://".$_SERVER["HTTP_HOST"]."/".check_string($_SESSION["ref"],"string"));
    } else {
        $msg = "<div class='msg error'>Неверный логин или пароль</div>";
        include("stat/forms/login.form");
           };
    $db_err = $db -> error();
    $db -> close();
} elseif ($stage == "exit") // logout
    {
        setcookie("user_id",0,time()-1);
        setcookie("hash",0,time()-1);
        session_destroy();
        header("Location: http://".$_SERVER["HTTP_HOST"]."/auth.php");
    } else {
        include("stat/forms/login.form");
    }

if ($db_err["error_no"] != null) { print_r($db_err); }; // DB-errors
