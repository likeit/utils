<?php
	$db = @mysql_connect('localhost','megadozz_supply','passw0rd');
	if (!$db) {
		$msg = "Не удалось установить подключение к базе данных";
		$msg_type = "error";
	}
	else mysql_select_db('megadozz_supply',$db);
	
	mysql_query("set names utf8");
?>