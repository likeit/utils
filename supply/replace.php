<?php

//ini_set("display_errors",1);
//error_reporting(E_ALL ^E_NOTICE);
session_start();
require_once("../subs.php");
require_once("../conf.inc.php");
require_once("../lib/dblayer.php");

if (isAuthorized()) {
        $id = $_POST["id"];
        $msg_class = 'error';
        $msg = 'other error';

        $query_models = "SELECT `name` FROM supply_models WHERE supply_models.id=$id";
        $query_mod = $db -> query("SELECT ($query_models) AS `model`,`full` FROM supply WHERE `id`=$id");

        if ($query_mod and $mod_data = $db -> fetch_assoc($query_mod)) {
            $model = $mod_data['model'];
            $full  = $mod_data['full'];

            if ($full>0) {
                $query_upd = $db -> query("UPDATE supply SET `full`='$full'-1 WHERE `id`=$id");
                if ($query_upd) {
                    $msg_class  = "success";
                    $msg        = "Картридж $model успешно заменен!";
                } else $msg = "Не удалось заменить картридж $model :(";
            } else $msg = "Не осталось картриджей $model :(";
        } else $msg = "Не удалось определить текущее кол-во полных картриджей :(";

        echo $msg_class.",".$msg;

} else authorize();