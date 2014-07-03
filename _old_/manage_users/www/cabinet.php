<?php
// *********************************** //
// Система управления пользователями   //
// ---								   //
// Личный кабинет					   //
// *********************************** //
error_reporting(-1); // Включить все ошибки
ini_set("display_errors", 1); // Показывать ошибки в броузере
session_start(); // Инициализация сессии

require('conf.php'); // Конфиг
require('subs.php'); // Функции

if (isset($_SESSION['valid']) and ($_SESSION['valid'] == true))
{
// -- begin ENV -- //
$admin_id = $_SESSION['admin_id']; // id админа
$admin = $_SESSION['admin']; // Логин админа
$admin_fio = $_SESSION['admin_fio']; // ФИО админа
$admin_email = $_SESSION['admin_email']; // e-mail админа
$permission_id = $_SESSION['permission']; // Права доступа (группа пользователя)
$form_admin_fio = empty($_POST['form_admin_fio']) ? '' : check_string($_POST['form_admin_fio'],'string'); // ФИО админа с формы
$form_admin = empty($_POST['form_admin']) ? '' : check_string($_POST['form_admin'],'string'); // Логин админа с формы
$form_permission_id = empty($_POST['form_permission_id']) ? '' : check_string($_POST['form_permission_id'],'digits'); // Права доступа админа (группа) с формы
if (isset($_POST['form_admin_email']) and ($_POST['form_admin_email']!= ''))
{  if (check_string($_POST['form_admin_email'],'email')) $form_admin_email = $_POST['form_admin_email']; // e-mail админа с формы
		else $form_admin_email = '';
} else $form_admin_email = '';
$form_admin_pass = empty($_POST['form_admin_pass']) ? '' : $_POST['form_admin_pass']; // Пароль админа с формы
$action = empty($_REQUEST['action']) ? '' : check_string($_REQUEST['action'],'string'); // Действие
//$msg_class = empty($_POST['msg_class']) ? '' : $_POST['msg_class']; // Класс сообщения (failed или success)
$page_name = 'Личный кабинет: '.$admin_fio;
// -- end ENV -- //

// ----- BEGIN ----- //
switch ($action)
{
	case 'cabinet_edit':
		//Проверка введённых данных
		if ((strlen($form_admin_fio) > 3) and (strlen($form_admin) > 3) and ($form_permission_id != '') and ($form_admin_email != ''))
		{
			if ($permission_id == 1) // Если пользователь = админ
			{
				if ($form_admin_pass != '') // Если в поле пароля что-то есть, то пароль поменять
				{
					$query_cabinet_edit = "UPDATE admins SET login='".$form_admin."',fio='".$form_admin_fio."',pass='".md5($form_admin_pass)."',email='".$form_admin_email."',permission=".$form_permission_id." WHERE id=".$admin_id;
				} else { // Иначе пароль не указан, пароль не менять
					$query_cabinet_edit = "UPDATE admins SET login='".$form_admin."',fio='".$form_admin_fio."',email='".$form_admin_email."',permission=".$form_permission_id." WHERE id=".$admin_id;
						};
			} else { // Пользователь не админ
				if ($form_admin_pass != '') // Если в поле пароля что-то есть, то пароль поменять
				{
					$query_cabinet_edit = "UPDATE admins SET login='".$form_admin."',fio='".$form_admin_fio."',pass='".md5($form_admin_pass)."',email='".$form_admin_email."' WHERE id=".$admin_id;
				} else { // Иначе пароль не указан, пароль не менять
					$query_cabinet_edit = "UPDATE admins SET login='".$form_admin."',fio='".$form_admin_fio."',email='".$form_admin_email."' WHERE id=".$admin_id;
						};
					};
			if (write_data_to_db($query_cabinet_edit,'update'))
			{
				$msg = 'Данные сохранены'; $msg_class = 'success';
				// Перечитать настройки пользователя
				$admin_login = get_data_from_db(array("0" => "SELECT id,login,fio,email,permission FROM admins WHERE id=".$admin_id));
				if ($admin_login[0] <> '' and (count($admin_login[0]) == 1))
				{ 
					$admin = $_SESSION['admin'] = $admin_login[0][0]['login'];
					$admin_fio = $_SESSION['admin_fio'] = $admin_login[0][0]['fio'];
					$admin_email = $_SESSION['admin_email'] = $admin_login[0][0]['email'];
					$form_permission_id = $_SESSION['permission'] = $admin_login[0][0]['permission'];
				} else { $msg = 'Ошибка!'; $msg_class = 'failed';	};
			} else $msg = 'Ошибка в ведённых данных'; $msg_class = 'failed';
		};
		break;
		
};
// ----- END ----- //
include("./forms/header.html");
include ("./forms/cabinet.html");
include("./forms/footer.html");
} else header("Location: login.php");
?>