<?php
/**
 * Created by PhpStorm.
 * User: megadozz
 * Date: 01.07.2014
 * Time: 10:54
 */

ini_set("display_errors",1);
error_reporting(E_ALL ^E_NOTICE);

//echo "$_SERVER[DOCUMENT_ROOT]";
require_once("$_SERVER[DOCUMENT_ROOT]/lib/dblayer.php");
require_once("$_SERVER[DOCUMENT_ROOT]/conf.inc.php");
require_once("$_SERVER[DOCUMENT_ROOT]/subs.php");
$db = new DBLayer($CNF["db_host"],$CNF["db_user"],$CNF["db_pass"],$CNF["db_name"]);
$db -> query("SET NAMES utf8");

function translit($str) {
    $tr = array(
        "А"=>"A","Б"=>"B","В"=>"V","Г"=>"G","Д"=>"D","Е"=>"E","Ё"=>"E","Ж"=>"ZH","З"=>"Z","И"=>"I",
        "Й"=>"Y","К"=>"K","Л"=>"L","М"=>"M","Н"=>"N","О"=>"O","П"=>"P","Р"=>"R","С"=>"S","Т"=>"T",
        "У"=>"U","Ф"=>"F","Х"=>"H","Ц"=>"TS","Ч"=>"CH","Ш"=>"SH","Щ"=>"SCH","Ъ"=>"","Ы"=>"YI","Ь"=>"",
        "Э"=>"E","Ю"=>"YU","Я"=>"YA","а"=>"a","б"=>"b","в"=>"v","г"=>"g","д"=>"d","е"=>"e","ё"=>"e",
        "ж"=>"zh","з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l","м"=>"m","н"=>"n","о"=>"o","п"=>"p",
        "р"=>"r","с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h","ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch",
        "ъ"=>"y","ы"=>"yi","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya"
    );
    return strtr($str,$tr);
};

function generate_password($length) {
    $pass = "";
    $arr = array('a','b','c','d','e','f','g','h','i','j','k','l',
        'm','n','o','p','r','s','t','u','v','x','y','z',
        'A','B','C','D','E','F','G','H','I','J','K','L',
        'M','N','P','R','S','T','U','V','X','Y','Z',
        '1','2','3','4','5','6','7','8','9');

    for($i = 0; $i < $length; $i++) {
        $index = rand(0, count($arr) - 1); // Случайный индекс массива
        $pass .= $arr[$index];
    };
    return $pass;
};

$users = getUsers(true);

foreach ($users as $id=>$user) {
    $users[$id]["permissions"] = 33;
    $users[$id]["login"] = mb_strtolower(translit(mb_substr($user["firstname"],0,1,"UTF-8").$user["lastname"]));
    $users[$id]["login_ae"] = mb_strtoupper(mb_substr($user["firstname"],0,1,"UTF-8").mb_substr($user["middlename"],0,1,"UTF-8").$user["lastname"], "UTF-8");
    $users[$id]["email"] = $users[$id]["login"]."@megacorp.com";
    $users[$id]["password"] = generate_password(8);

    $query = "UPDATE users SET
        `login`='".$users[$id]["login"]."',
        `login_ae`='".$users[$id]["login_ae"]."',
        `pass`='".$users[$id]["password"]."',
        `email`='".$users[$id]["email"]."'
            WHERE `uid`=$id";
//    echo "\n\n";
    $query_upd = $db -> query($query);
    if ($query_upd) echo 1;
};

//print_r($users);
print_r($db -> error());