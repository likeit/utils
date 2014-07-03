<?php
/*    header('Content-type: text/html; charset=utf-8');

    if ($pagename!='SignIn') {
        include('../common/dbconnect.inc');
        session_start();
        require_once('../common/auth.php');

        if (!(isset($_SESSION['sess_login']) && isset($_SESSION['sess_pass']))) {
            header('Location: /');
            exit();
        };
    }
//*/
?>

<!DOCTYPE html>

<html lang='en'>

<head>
	<meta charset='utf-8'>
	<link href='../css/supply.css'		type='text/css' rel='stylesheet' media='screen'>
	<link href='../css/modal.css'			type='text/css' rel='stylesheet' media='screen'>
	<link href='../css/autocomplete.css'	type='text/css' rel='stylesheet' media='screen'>
	<title>SupplyMan: <?php echo $pagename_ru?></title>
	<script type='text/javascript' src='../js/jquery-1.7.2.min.js'></script>
    <script type='text/javascript' src='../js/autocomplete.js'></script>
    <script type='text/javascript' src='../js/supply.js'></script>
    <script type='text/javascript' >

        <?php
        $query = mysql_query("SELECT * FROM printer_models");
        $count = mysql_num_rows($query);
        $model_arr = array();
        for ($i=0; $i<$count; $i++) {
            $model_arr[$i] = mysql_result($query, $i,   "name");
        };
        echo "var printer_models=['".implode("', '",$model_arr)."'];\n\t";
        echo "setTimeout(\"$('#edit_printer_model').autocomplete(printer_models)\",1000);";
        ?>

    </script>
</head>

<body>

<div id='grid'>

    <div id='header'>
        <div id='title'><img alt='SupplyMan' src='../img/title.png' /></div>
        <div id='messages' class=<?php echo "'$msg_type'"; ?>><?php echo $msg ?></div>
        <div id='toppanel'>
        <?php
            if ($pagename!='SignIn') {
                include('../common/menu.inc');
                include('../common/personal.inc');
            }
            if ($pagename=='printers') include('../common/edit_printer.inc');
        ?>
        </div>
    </div>

    <div id='content'>
