<?php
// *********************************** //
// Система управления пользователями   //
// ---								   //
// Библиотека функций				   //
// *********************************** //
require('conf.php'); // Основной Конфиг

// --- Коннект к БД
function db_connect()
{
	include('db_conf.php'); // Конфиг подключения к БД
	$link = mysql_connect($cfg_db_host, $cfg_db_user, $cfg_db_pass, $cfg_db_name) or die('MySQL connect error: '.mysql_error());
	mysql_select_db($cfg_db_name) or die('MySQL select DB error: '.mysql_error());
	return $link;
};

// --- Дисконнект от БД
function db_disconnect($resurs)
{
	mysql_close($resurs);
};

// Получить данные из БД
function get_data_from_db($query)
{
	if(is_array($query))
	{
		$link = db_connect();
		mysql_query("SET NAMES utf8"); // Работаем в UTF-8
		$i = 0;
		foreach($query as $queryArr)
		{
			$resArr[$i] = mysql_query($queryArr, $link);  // Массив ресурсов запросов: Array([0] => Resourse#1, [1] => Resourse#2, ...)
			for ($n = 0; $n < mysql_num_rows($resArr[$i]); $n++)
				{ 
					$all_data[$i][$n] = mysql_fetch_assoc($resArr[$i]); // Массив результатов запросов. Для каждого запроса - массив результатов
				};
			$i++;
		};
		db_disconnect($link);
	} else $all_data = false;
	return $all_data;
};
/* Старая функция !!!!
// Массив из всех результатов запроса: Array( [1] => Array([столбец] => значение) )
function get_data_from_db($query)
{
	//global $count_rowss;
	$link = db_connect();
	mysql_query("SET NAMES utf8");
	$result = mysql_query($query, $link) or die('MySQL error: '.mysql_error());
	db_disconnect($link);
	for ($i = 1; $i <= mysql_num_rows($result); $i++)
	{ $all_data[$i] = mysql_fetch_assoc($result); };
	return $all_data;
};
*/

// Записать/обновить данные в БД (insert/del or update)
function write_data_to_db($query,$type)
{
	$link = db_connect();
	mysql_query("SET NAMES utf8");
	$result = mysql_query($query, $link) or die('MySQL error: '.mysql_error());
	if ($result and $type == 'insert') { return $id = mysql_insert_id(); }  // id записи, которая была добавлена INSERT'ом
		elseif ($result and ($type == 'update' or $type == 'delete')) { return true; }
			else return $id = false;
	db_disconnect($link);
};

function check_propusk_number($number)
{
	$check = get_data_from_db("SELECT fio FROM users WHERE propusk_number='".$number."' and deleted is null");
	if ($check) return $msg = 'Данный номер пропуска уже используется сотрудником: <strong>'.$check[1]['fio'].'</strong>';
};

// --- Проверка введённых данных
function check_string($str,$type)
{
	switch ($type)
	{
		case 'digits':
			$string = preg_replace("/[^0-9]/", "", $str); // только цифры
			break;
		case 'text':
			$string = preg_replace("/[^\p{L}0-9\n\+\-\_\(\):\.!@ ]/u", "", $str); // (UTF-8) Только буквы, цифры, переносы строк, символы: +-_():.!@ пробел
			break;
		case 'string':
			$string = preg_replace("/[^\p{L}0-9\_ ]/u", "", $str); // (UTF-8) Только буквы, цифры, символ "_", пробел
			break;
		case 'date':
			$check = preg_match("/^[0-9]{2}(\\.[0-9]{2})(\\.[0-9]{4})$/",$str);
			if ($check == 1) { $string = true; } else $string = false;
			break;
		case 'email':
			$check = preg_match("/^[_A-Za-z0-9-]+(\\.[_A-Za-z0-9-]+)*@[A-Za-z0-9-]+(\\.[A-Za-z0-9-]+)*(\\.[A-Za-z]{2,})$/",$str);
			if ($check == 1) { $string = true; } else $string = false;
			break;
	};
return $string;
};

// Функция для чтения ответа SMTP-сервера
function read_smtp_answer($socket)
{
	$read = socket_read($socket, 1024);
};

// Функция для отправки запроса SMTP-серверу
function write_smtp_response($socket, $msg)
{
	$msg = $msg."\r\n";
	socket_write($socket, $msg, strlen($msg));
};

function mail_send($to,$subject,$src_message)
{
	include('mail_conf.php'); // Конфиг почтового сервера
	
	$message = iconv('cp1251','UTF-8',$src_message);
	$message = "Content-Type: text/plain; charset=UTF-8; format=flowed \r\nContent-Transfer-Encoding: 8bit \r\n\r\n".$src_message;

	$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP); // Создание сокета
	$result = socket_connect($socket, $cfg_address, $cfg_port); // Открываем сокет

	read_smtp_answer($socket); // Читаем информацию о сервере

	write_smtp_response($socket, 'EHLO '.$cfg_address); // Приветствуем сервер
	read_smtp_answer($socket); // ответ сервера

	write_smtp_response($socket, 'AUTH LOGIN'); // Делаем запрос авторизации
	read_smtp_answer($socket); // ответ сервера

	write_smtp_response($socket, base64_encode($cfg_login)); // Отравляем логин
	read_smtp_answer($socket); // ответ сервера

	write_smtp_response($socket, base64_encode($cfg_pwd)); // Отравляем пароль
	read_smtp_answer($socket); // ответ сервера

	write_smtp_response($socket, 'MAIL FROM:<'.$cfg_from.'>'); // Задаем адрес отправителя
	read_smtp_answer($socket); // ответ сервера

	write_smtp_response($socket, 'RCPT TO:<'.$to.'>'); // Задаем адрес получателя
	read_smtp_answer($socket); // ответ сервера

	write_smtp_response($socket, 'DATA'); // Готовим сервер к приему данных
	read_smtp_answer($socket); // ответ сервера

	// Отправка данных
	$message = "To: $to\r\n".$message; // добавляем заголовок сообщения "адрес получателя"
	$message = "Subject: $subject\r\n".$message; // заголовок "тема сообщения"
	write_smtp_response($socket, $message."\r\n.");
	read_smtp_answer($socket); // ответ сервера

	write_smtp_response($socket, 'QUIT'); // Отсоединяемся от сервера
	read_smtp_answer($socket); // ответ сервера

	if (isset($socket)) socket_close($socket); // Закрываем сокет
};

// Транслитератор
function translit($str) 
{
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

// Генератор случайных паролей
function generate_password($number)
{
//$number - число символов в пароле
	$arr = array('a','b','c','d','e','f','g','h','i','j','k','l',
				 'm','n','o','p','r','s','t','u','v','x','y','z',
				 'A','B','C','D','E','F','G','H','I','J','K','L',
				 'M','N','P','R','S','T','U','V','X','Y','Z',
				 '1','2','3','4','5','6','7','8','9');
	$pass = "";
	for($i = 0; $i < $number; $i++)
    {
      $index = rand(0, count($arr) - 1); // Случайный индекс массива
      $pass .= $arr[$index];
    };
    return $pass;
};

// Изменение размеров фотки
function ResizeImage($image_from,$image_to, $fitwidth=200,$fitheight=270,$quality=75)
{
	$os=$originalsize=getimagesize($image_from);
	if($originalsize[2]!=2 && $originalsize[2]!=3 && $originalsize[2]!=6 && ($originalsize[2]<9 or $originalsize[2]>12))
	{
		return false;
	};
	if($originalsize[0]>$fitwidth or $originalsize[1]>$fitheight)
	{
		$h=getimagesize($image_from);
		if(($h[0]/$fitwidth)>($h[1]/$fitheight))
		{
			$fitheight=$h[1]*$fitwidth/$h[0];
		} else {
				$fitwidth=$h[0]*$fitheight/$h[1];
				};
		if($os[2]==2 or ($os[2]>=9 && $os[2]<=12))$i = ImageCreateFromJPEG($image_from);
		$o = ImageCreateTrueColor($fitwidth, $fitheight);
		imagecopyresampled($o, $i, 0, 0, 0, 0, $fitwidth, $fitheight, $h[0], $h[1]);
		imagejpeg($o, $image_to, $quality); 
		chmod($image_to,0644);
		imagedestroy($o);
		imagedestroy($i);
		return 2;
	};
	if($originalsize[0]<=$fitwidth && $originalsize[1]<=$fitheight)
	{
		$i = ImageCreateFromJPEG($image_from);
		imagejpeg($i, $image_to, $quality); 
		chmod($image_to,0644);
		return 1;
	};
}; 

// Загрузка файлов на сервер
function uploadphoto($uid)
{
	$uploaddir = 'photos/';
	$mini_uploaddir = 'photos/';
	$uploadfile = '';
	$msg = '';
	// проверка файла
	if ($_FILES['userfile']['error'] != '0' ) { $msg = 'ОШИБКА!<br>'; $msg_class = 'failed'; }
		elseif ($_FILES['userfile']['size'] > 1048576) { $msg = 'Размер файла больше 1 МБ<br>'; $msg_class = 'failed'; }
			elseif ($_FILES['userfile']['type'] != 'image/jpeg') { $msg = 'Это не jpeg/jpg файл<br>'; $msg_class = 'failed'; };
	if (($_FILES['userfile']['error'] == '0') and ($_FILES['userfile']['size'] <= 1048576) and ($_FILES['userfile']['type'] == 'image/jpeg')) 
	{
		$uploadfile = $uid.'.jpg';
		if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir.$uploadfile))
			{
				if ( Resizeimage($uploaddir.$uploadfile,$mini_uploaddir.'mini_'.$uploadfile,200,270,75) ) 
				{ $msg .= "Фото загружено"; $msg_class = 'success'; }
			} else { $uploadfile = ''; $msg .= "ОШИБКА!"; $msg_class = 'failed'; };
	} else { $uploadfile = ''; $msg .= 'ВНИМАНИЕ: Файл не загружен!'; $msg_class = 'failed'; };
	return $uploadphoto = array('file' => $uploadfile, 'msg' => $msg, 'msg_class' => $msg_class);
};
?>