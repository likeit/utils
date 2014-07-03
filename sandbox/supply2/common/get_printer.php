<?php

require_once('../common/dbconnect.inc');

$printer_id = $_POST["printer_id"];

$printer   = mysql_query ("SELECT * FROM printers WHERE id = $printer_id");
$p         = mysql_fetch_array ($printer);
$p_models  = mysql_query ("SELECT * FROM printer_models WHERE id = ".$p["model"]);
$m         = mysql_fetch_array ($p_models);
echo $p["name"].'|'.$m['name'].'|'.$p["area"].'|'.$p['cartridge_use'].'|'.$p['comment'];

?>
