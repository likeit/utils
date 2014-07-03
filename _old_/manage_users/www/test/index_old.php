<?php
session_start();
include('subs.php');

function check_propusk_number($number)
{
  $check = get_data_from_db("SELECT fio FROM users WHERE propusk_number='".$number."' and deleted is null");
  if ($check) return $msg = 'Данный номер пропуска уже используется сотрудником: <strong>'.$check[1]['fio'].'</strong>';
};

if (isset($_SESSION['valid']) and ($_SESSION['valid'] == true))
{
//ENV
if (isset($_SESSION['name'])) $name = $_SESSION['name']; // Admin login name
if (isset($_POST['fio'])) $fio = $_POST['fio']; // User FIO
if (isset($_POST['birth_year']) and isset($_POST['birth_month']) and isset($_POST['birth_day']))
{
    $birth_year = $_POST['birth_year'];
    $birth_month = $_POST['birth_month'];
    $birth_day = $_POST['birth_day'];
    $birthday = $birth_year.$birth_month.$birth_day;
};
if (isset($_POST['position_id'])) $position_id = $_POST['position_id'];
if (isset($_POST['territory_id'])) $territory_id = $_POST['territory_id'];
if (isset($_POST['comment'])) $comment = $_POST['comment'];
$territory = get_data_from_db("SELECT id,name FROM territory WHERE disabled is null");
$positions = get_data_from_db("SELECT id,name FROM positions WHERE disabled is null");
$organisations = get_data_from_db("SELECT id,name FROM organisations WHERE disabled is null");
if (isset($_POST['propusk_number'])) $propusk_number = $_POST['propusk_number'];

if (isset($_GET['stage']) and ($_GET['stage'] == 'Reset')) { header("Location: index.php"); } elseif
(isset($_POST['stage']) and ($_POST['stage'] == 'Get'))
{
// check propusk number
//if (!check_propusk_number($_POST['propusk_number']))

// check photo
/*$photoname = 'no_photo.jpg';
if (isset($_FILES['photo_name']['tmp_name']) and ($_FILES['photo_name']['tmp_name'] <> ''))
  {
    $uploaddir = './photos/';
    $photoname = date("YmdHms").'.jpg';
    move_uploaded_file($_FILES['photo_name']['tmp_name'], $uploaddir.$photoname);
  };
write_data_to_db("INSERT INTO users(date_add,fio,birthday,photo,position_id,territory_id,organisation_id,propusk_number,status,comment,admin_add_id) VALUES (NOW(),'".$fio."','".$birthday."','".$photoname."',".$position_id.",".$territory_id.",'".$propusk_number."',1,'".$comment."',(SELECT id from admins WHERE login='".$name."'))");
*/
$msg = check_propusk_number($propusk_number);
};

include("./forms/begin.html");
include("./forms/add_user_form.html");
echo $msg;
if (isset($_GET['is_upload_photo'])) include("./forms/manage_photo.html");
include("./forms/end.html");

} else header("Location: login.php");
?>