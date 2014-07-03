<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset='utf-8'" />
	<link rel="stylesheet" href="/css/main.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="/css/userlist.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="/css/edituser.css" type="text/css" media="screen" />
</head>
<body>
<?php
error_reporting(-1); // Включить все ошибки
ini_set("display_errors", 1); // Показывать ошибки в броузере

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
		chmod($image_to,0777);
		imagedestroy($o);
		imagedestroy($i);
		return 2;
	};
	if($originalsize[0]<=$fitwidth && $originalsize[1]<=$fitheight)
	{
		$i = ImageCreateFromJPEG($image_from);
		imagejpeg($i, $image_to, $quality); 
		chmod($image_to,0777);
		return 1;
	};
}; 

// ---- Загрузка файлов на сервер ----
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
// ---
if (($_FILES['userfile']['error'] == '0') and ($_FILES['userfile']['size'] <= 1048576) and ($_FILES['userfile']['type'] == 'image/jpeg')) 
	{
		$uploadfile = $uid.'.jpg';
		if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir.$uploadfile))
			{
				if ( Resizeimage($uploaddir.$uploadfile,$mini_uploaddir.'mini_'.$uploadfile,200,270,75) ) 
				{ $msg .= "Фото загружено"; $msg_class = 'success'; }
			} else { $msg .= "ОШИБКА!"; $msg_class = 'failed'; };
	} else { $msg .= 'ВНИМАНИЕ: Файл не загружен!'; $msg_class = 'failed'; };
return $uploadphoto = array('file' => $uploadfile, 'msg' => $msg, 'msg_class' => $msg_class);
};
// ----

if (isset($_POST['stage']))
{
$uid = 'lala';
$uploadphoto = uploadphoto($uid);
$photo_name = $uploadphoto['file'];
$msg = $uploadphoto['msg'];
$msg_class = $uploadphoto['msg_class'];
};
?>
<div id="notify" class=<?php echo '"'.$msg_class.'">'.$msg ?>&nbsp;</div>
<div id="addphoto">
	<div class="photo" style="float: none; cursor: default">
		<div class="photoimg"><img src="<?php if (isset($photo_name) and $photo_name != '') { echo "photos/mini_".$photo_name; } else echo 'img/anonymous.png'; ?>"></img></div>
	</div>
	<div>
		<form enctype="multipart/form-data" method="post">
			<input name="userfile" type="file"/>&nbsp;<input type="submit" name="stage" value="Save"/>
		</form>
	</div>
</div>
</body>
</html>