<?php

// --- ������� � ��
function db_connect()
{
	$db_host='localhost'; // ��� ������� MySQL
	$db_user='manage_users'; // ��� ������������ ��� ����������� � ������� MySQL
	$db_pass='5178563'; // ������ ������������ ��� ����������� � ������� MySQL
	$db_name='manage_users'; // ��� ���� ������ �� ������� MySQL
	$link = mysql_connect($db_host, $db_user, $db_pass, $db_name) or die('MySQL connect error: '.mysql_error());
	mysql_select_db($db_name) or die('MySQL select DB error: '.mysql_error());
	return $link;
};

// --- ���������� �� ��
function db_disconnect($resurs)
{
	mysql_close($resurs);
};

// �������� ������ �� ��
// ������ �� ���� ����������� �������: Array( [����� �/�] => Array([�������] => ��������) )
function get_data_from_db($query)
{
	$link = db_connect();
	mysql_query("SET NAMES cp1251");
	$result = mysql_query($query, $link) or die('MySQL error: '.mysql_error());
	db_disconnect($link);
	for ($i = 1; $i <= mysql_num_rows($result); $i++)
	{ $all_data[$i] = mysql_fetch_assoc($result); };
	return $all_data;
};

// ��������/�������� ������ � ��
function write_data_to_db($query)
{
	$link = db_connect();
	mysql_query("SET NAMES cp1251");
	$result = mysql_query($query, $link) or die('MySQL error: '.mysql_error());
	db_disconnect($link);
	if ($result) { return $msg = true; } else return $msg = false;
};

// ---- �������� ������ �� ������ ----
/*function uploadphoto()
{
$uploaddir = '.\photos\\';
$mini_uploaddir = '.\photos\mini\\';
$uploadfile = '';
// �������� �����
if ($_FILES['userfile']['error'] != '0' ) { $msg = '<font color=#FF6317>������!</font><br>'; }
	elseif ($_FILES['userfile']['size'] > 1048576) { $msg .= '<font color=#FF6317>������ ����� ������ 1 ��.</font><br>'; }
		elseif ($_FILES['userfile']['type'] != 'image/jpeg') { $msg .= '<font color=#FF6317>��� �� jpeg/jpg ����.</font><br>'; };
// ---
if (($_FILES['userfile']['error'] == '0') and ($_FILES['userfile']['size'] <= 1048576) and ($_FILES['userfile']['type'] == 'image/jpeg')) 
	{
		$uploadfile = date("YmdHms").'.jpg';
		if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir.$uploadfile))
			{
				if ( Resizeimage($uploaddir.$uploadfile,$mini_uploaddir.'mini_'.$uploadfile,170,126,75) ) 
				{ $msg .= "<font color=#FF6317>���� ���������.</font><br>"; }
			} else { $msg .= "<font color=#FF6317>������!</font><br>"; };
	} else { $msg .= '<font color=#FF6317>��������: ���� �� ��������!</font><br>'; };
return $uploadphoto = array('file'=>$uploadfile, 'msg' => $msg);
};*/
// ----

?>