<?php
// *********************************** //
// Система управления пользователями   //
// ---								   //
// Главная страница					   //
// *********************************** //
error_reporting(-1); // Включить все ошибки
ini_set("display_errors", 1); // Показывать ошибки в броузере
session_start(); // Инициализация сессии

require('conf.php'); // Конфиг
require('subs.php'); // Функции

if (isset($_SESSION['valid']) and ($_SESSION['valid'] == true))
{
// -- begin ENV -- //
$admin = $_SESSION['admin']; // Логин админа
$admin_fio = $_SESSION['admin_fio']; // ФИО админа
$permission_id = $_SESSION['permission']; // Права доступа (группа пользователя)
$filter = empty($_REQUEST['filter']) ? '' : check_string($_REQUEST['filter'],'string'); // Фильтр уволенных
// - Установка/снятие настройки показа уволенных сотрудников
if ($filter == 'show_deleted') { $_SESSION['filter'] = 'show_deleted'; }
	elseif ($filter == 'not_show_deleted') { unset($_SESSION['filter']); };
if (isset($_SESSION['filter']) == 'show_deleted') { $btn_show_del = '<a href="index2.php?filter=not_show_deleted">[&nbsp;Не&nbsp;показывать&nbsp;уволенных&nbsp;]</a>'; $filter = ''; }
	else { $btn_show_del = '<a href="index2.php?filter=show_deleted">[&nbsp;Показывать&nbsp;уволенных&nbsp;]</a>'; $filter = 'WHERE status!=4 '; };
// -
$action = empty($_REQUEST['action']) ? '' : check_string($_REQUEST['action'],'string'); // Действие
$stage = empty($_POST['stage']) ? '' : check_string($_POST['stage'],'string'); // Стадия
$find_text = empty($_POST['find_text']) ? '' : check_string($_POST['find_text'],'string'); // Строка для поиска
$page_name = empty($_POST['page_name']) ? 'Система учета сотрудников в ИТ-системе' : $_POST['page_name']; // Название страницы
$uid = empty($_REQUEST['uid']) ? '' : check_string($_REQUEST['uid'],'digits'); // ID-пользователя БД в таблице users
$fio1 = empty($_POST['fio1']) ? '' : check_string($_POST['fio1'],'string'); // Фамилия
$fio2 = empty($_POST['fio2']) ? '' : check_string($_POST['fio2'],'string'); // Имя
$fio3 = empty($_POST['fio3']) ? '' : check_string($_POST['fio3'],'string'); // Отчество
$post_id = empty($_POST['post_id']) ? '' : check_string($_POST['post_id'],'digits'); // ID Должности
$area_id = empty($_POST['area_id']) ? '' : check_string($_POST['area_id'],'digits'); // ID Территории
$gild_id = empty($_POST['gild_id']) ? '' : check_string($_POST['gild_id'],'digits'); // ID Организации
$sprav_data = get_data_from_db(array("0" => "SELECT id,name FROM post WHERE disabled is null ORDER BY name", // Должности
									 "1" => "SELECT id,name FROM area WHERE disabled is null ORDER BY name", // Территории
									 "2" => "SELECT id,name FROM gild WHERE disabled is null ORDER BY name")); // Организации
foreach($sprav_data[0] as $postArray) { $posts[$postArray['id']] = $postArray['name']; }; // Массив должностей Array ([id_должности] => Название должности)
foreach($sprav_data[1] as $areaArray) { $areas[$areaArray['id']] = $areaArray['name']; }; // Массив территорий Array ([id_территории] => Название территории)
foreach($sprav_data[2] as $gildArray) { $gilds[$gildArray['id']] = $gildArray['name']; }; // Массив организаций Array ([id_организации] => Название организации)
$comment = empty($_POST['comment']) ? '' : check_string($_POST['comment'],'text'); // Комментарий
$msg_class = empty($_POST['msg_class']) ? '' : $_POST['msg_class']; // Класс сообщения (failed или success)
$msg = empty($_POST['msg']) ? '' : $_POST['msg']; // Сообщения
//$photoname = 'no_photo.jpg'; // Имя файла с фотографией по-умолчанию
$photoname = null; // Имя файла с фотографией по-умолчанию
$limit = empty($_REQUEST['limit']) ? $cfg_limit : check_string($_REQUEST['limit'],'digits'); // Количество отображаемых пользователей (limit)
$page = empty($_REQUEST['page']) ? 1 : check_string($_REQUEST['page'],'digits').','; // Номер страницы (n) в виде строки "n," для использования в SQL-запросе ...LIMIT n,limit
/*if (empty($_POST['date'])) { $birthday = '00000000'; }
	else {
			$date = check_string($_POST['date'],'date'); // Дата в виде dd.mm.yyyy
			$date_expl = explode('.', $date); // Разбитая дата: Array ( [0] => day [1] => month [2] => year )
			for ($i=2; $i>=0; $i--) { $birthday .= $date_expl[$i]; }; // Дата в SQL-формате: yearmonthday
		};*/
if (empty($_POST['date'])) { $birthday = '00000000'; }
	elseif (check_string($_POST['date'],'date'))
		{
			$date_expl = explode('.', $_POST['date']); // Разбитая дата: Array ( [0] => day [1] => month [2] => year )
			for ($i=2; $i>=0; $i--) { @$birthday .= $date_expl[$i]; }; // Дата в SQL-формате: yearmonthday
		} else { $msg = 'Дата рождения не верна!'; $msg_class = 'failed'; $birthday = '00000000'; };

// - Переменные модулей: $mod_(modulename)_(varname)
$mod_ad_login = empty($_POST['mod_ad_login']) ? '' : check_string($_POST['mod_ad_login'],'string'); // Имя пользователя в АД (pkobzev)
$mod_ad_passwd = empty($_POST['mod_ad_passwd']) ? '' : check_string($_POST['mod_ad_passwd'],'string');
$mod_aexpres_login = empty($_POST['mod_aexpres_login']) ? '' : check_string($_POST['mod_aexpres_login'],'string');
$mod_mail_login = empty($_POST['mod_mail_login']) ? '' : check_string($_POST['mod_mail_login'],'email');
// -

unset($sprav_data,$areaArray,$postArray,$gildArray,$date_expl); // Удаление временных переменных
// -- end ENV -- //

// ----- BEGIN ----- //
switch ($action)
{
	case 'add':
		
		if ($stage == 'save')
		{
			$query_add = "INSERT INTO users(date_add,fio1,fio2,fio3,birthday,photo,post_id,area_id,gild_id,status,comment,admin_add_id) VALUES (NOW(),'".$fio1."','".$fio2."','".$fio3."',".$birthday.",'".$photoname."',".$post_id.",".$area_id.",".$gild_id.",1,'".$comment."',(SELECT id from admins WHERE login='".$admin."'))";
				if (write_data_to_db($query_add,'insert'))
				{
					$msg = 'Заявка отправлена';
					$msg_class = 'success';
					$msg_mail = "Сотрудник ".$fio1.' '.$fio2.' '.$fio3." принят на должность ".$posts[$post_id]." с ".date('d.m.Y')."г.".$cfg_mail_sign;
					mail_send($cfg_mailto,"Новый сотрудник: ".$fio1." ".$fio2." ".$fio3,$msg_mail);
				} else { $msg = 'Ошибка!'; $msg_class = 'failed'; };
		};
        $page_name = 'Добавление нового сотрудника';
		include("./forms/header.html");
		include("./forms/userdetails.php");
		break;
	case 'edit':
		if ($stage == 'save' and $uid != '') // Если нажата кнопка сохранить и указан uid
		{
			if ($permission_id == 1) {
				$query_edit_save = "UPDATE users SET date_mod=NOW(),fio1='".$fio1."',fio2='".$fio2."',fio3='".$fio3."',birthday=".$birthday.",photo='".$photoname."',post_id=".$post_id.",area_id=".$area_id.",gild_id=".$gild_id.",comment='".$comment."',admin_mod_id=(SELECT id from admins WHERE login='".$admin."') WHERE id=".$uid;
				if (write_data_to_db($query_edit_save,'update')) { $msg = 'Данные сохранены'; $msg_class = 'success'; } 
					else { $msg = 'Ошибка!'; $msg_class = 'failed';	};
									} else { $msg = 'Не достаточно прав доступа'; $msg_class = 'failed'; };
		} elseif ($stage == 'save_photo' and $uid != '' )
			{
				$uploadphoto = uploadphoto($uid);  // Загрузка фото на сервер
				$photoname = $uploadphoto['file']; // Имя файла с фотографией
				$msg = $uploadphoto['msg'];
				$msg_class = $uploadphoto['msg_class']; 
				if ($photoname != '')
				{
					$query_edit_photo = "UPDATE users SET date_mod=NOW(),photo='".$photoname."',admin_mod_id=(SELECT id from admins WHERE login='".$admin."') WHERE id=".$uid;
					if (!write_data_to_db($query_edit_photo,'update')) { $msg = 'Ошибка записи в БД!'; $msg_class = 'failed'; };
				};
			};
		$page_name = 'Редактирование сотрудника';
		$query_edit_user = array("0" => "SELECT fio1,fio2,fio3,DATE_FORMAT(birthday,\"%d.%m.%Y\") as birthday,photo,post_id,area_id,gild_id,comment FROM users WHERE id=".$uid);
		foreach(get_data_from_db($query_edit_user) as $data_edit_user) // Получить данные по сотрудникам из БД
		{
			$fio1 = $data_edit_user[0]['fio1'];
			$fio2 = $data_edit_user[0]['fio2'];
			$fio3 = $data_edit_user[0]['fio3'];
			$date = $data_edit_user[0]['birthday'];
			$photoname = $data_edit_user[0]['photo'];
			$post_id = $data_edit_user[0]['post_id'];
			$area_id = $data_edit_user[0]['area_id'];
			$gild_id = $data_edit_user[0]['gild_id'];
			$comment = $data_edit_user[0]['comment'];
		};
		// Модуль АД
		$fio1_low = mb_convert_case($fio1,MB_CASE_LOWER, "UTF-8"); // (UTF-8) Фамилия в нижнем регистре
		$fio2_low = mb_convert_case($fio2,MB_CASE_LOWER, "UTF-8"); // (UTF-8) Имя в нижнем регистре
		$mod_ad_login = translit(mb_substr($fio2_low,0,1,"UTF-8").$fio1_low); // (UTF-8) Имя пользователя, например: pkobzev
		$mod_ad_passwd = generate_password($cfg_pass_numb);
		// --
		
		// Модуль AExpres
		$fio1_up = mb_convert_case($fio1,MB_CASE_UPPER, "UTF-8"); // (UTF-8) Фамилия в верхнем регистре
		$fio2_up = mb_convert_case($fio2,MB_CASE_UPPER, "UTF-8"); // (UTF-8) Имя в верхнем регистре
		$fio3_up = mb_convert_case($fio3,MB_CASE_UPPER, "UTF-8"); // (UTF-8) Отчество в верхнем регистре
		$mod_aexpres_login = mb_substr($fio2_up,0,1,"UTF-8").mb_substr($fio3_up,0,1,"UTF-8").$fio1_up; // (UTF-8) Имя пользователя, например: ПВКОБЗЕВ
		// --
		
		// Модуль АД
		$mod_mail_login = $mod_ad_login.'@autoexpres.ru';
		// --
		
		include("./forms/header.html");
		include("./forms/userdetails.php");
		break;
	
	default: // Список сотрудников
		if ($stage == 'find' and $find_text != '')
		{ 
			$query_all_users = array("0" => "SELECT SQL_CALC_FOUND_ROWS id,DATE_FORMAT(date_add,\"%d.%m.%Y\") as date_add,fio1,fio2,fio3,photo,status,area_id,gild_id,post_id FROM users WHERE fio1 LIKE '%".$find_text."%' ORDER BY fio1 LIMIT ".$limit*($page-1).",".$limit, "1" => "SELECT FOUND_ROWS()");
		} else {
					$query_all_users = array("0" => "SELECT SQL_CALC_FOUND_ROWS id,DATE_FORMAT(date_add,\"%d.%m.%Y\") as date_add,fio1,fio2,fio3,photo,status,area_id,gild_id,post_id FROM users ".$filter."ORDER BY fio1 LIMIT ".$limit*($page-1).",".$limit, "1" => "SELECT FOUND_ROWS()");
				};
		$all_users = get_data_from_db($query_all_users);
		if (!$all_users) {$msg = 'Данные отсутствуют'; $msg_class = 'failed'; };
		
		// -- Переключатель страниц
		$pages = ceil($all_users[1][0]['FOUND_ROWS()']/$limit); 
		$page_menu = '<div class="pages">';
		for ($i=1; $i<=$pages; $i++)
		{	
			if ($page == $i) { $page_menu .= '<span class="curpage">'.$i.'</span>'; }
				else $page_menu .= '<a href="?page='.$i.'">'.$i.'</a>';
		};
		$page_menu .= '</div>';
		// -- Конец переключателя страниц
		
		$page_name = 'Список сотрудников (всего '.$all_users[1][0]['FOUND_ROWS()'].')';
		include("./forms/header.html");
		include("./forms/all_users.html");
};
// ----- END ----- //

include("./forms/footer.html");
} else header("Location: login.php");
?>