<?php
include('subs.php');
session_start();

if ( !isset($_POST['stage']) ) { include('./forms/login_form.html'); /*Форма для ввода имени и пароля*/ }
  elseif ($_POST['stage'] == 'Go')
	{
		$link = db_connect();
		mysql_query("SET NAMES cp1251");
		$result = mysql_query("SELECT id FROM admins WHERE login='".$_POST['name']."' and pass='".md5($_POST['pass'])."'", $link);
		db_disconnect($link);
		if (mysql_num_rows($result) != 1) 
			{ 
				header("Location: login.php"); 
			} else {
				$_SESSION['valid'] = true;
				$_SESSION['name'] = $_POST['name'];
				unset($_POST['name'],$_POST['pass']);
				header("Location: index.php");
					};
	};

?>