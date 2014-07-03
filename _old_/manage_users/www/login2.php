<?php
require('conf.php');
require('subs.php');
session_start();

// -- begin ENV -- //
$name = empty($_POST['name']) ? '' : check_string($_POST['name'],'string'); // Login
$msg_class = empty($_POST['msg_class']) ? '' : $_POST['msg_class']; // Класс сообщения (failed или success)
$msg = empty($_POST['msg']) ? '' : $_POST['msg']; // Сообщения
// -- end ENV -- //

// ----- BEGIN ----- //
if ( !isset($_POST['stage']) ) {include('./forms/login.html'); /*Форма для ввода имени и пароля*/ }
  else if ($_POST['stage'] == 'Go')
	{
			$admin_login = get_data_from_db(array("0" => "SELECT id,login,fio,email,permission FROM admins WHERE login='".$name."' and pass='".md5($_POST['pass'])."'"));
			if ($admin_login[0] <> '' and (count($admin_login[0]) == 1))
			{ 
				$_SESSION['valid'] = true;
				$_SESSION['admin_id'] = $admin_login[0][0]['id'];
				$_SESSION['admin'] = $admin_login[0][0]['login'];
				$_SESSION['admin_fio'] = $admin_login[0][0]['fio'];
				$_SESSION['admin_email'] = $admin_login[0][0]['email'];
				$_SESSION['permission'] = $admin_login[0][0]['permission'];
				unset($_POST['name'],$_POST['pass'],$_POST['stage']);
				header("Location: index2.php");
			} else {
				$msg_class = 'failed';
				$msg = 'Неверный логин или пароль! Проверьте правильность ввода.';
				include('./forms/login.html');
			};
	};
// ----- END ----- //
?>