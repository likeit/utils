<?php
require_once('../common/dbconnect.inc');

$p_id               = $_POST["p_id"];
$count              = substr_count($p_id,",")+1;
$p_model_row        = mysql_query("SELECT * FROM printers WHERE id='$p_id'");
$p_model            = mysql_result($p_model_row, 0, "model");
$this_p_model_count = 0+mysql_num_rows(mysql_query("SELECT * FROM printers WHERE model=$'p_model'"));
$result             = mysql_query("DELETE FROM printers WHERE id IN ($p_id)");

//echo "count=$this_p_model_count";
if ($result == 'true') {
    if ($this_p_model_count<1) {
//        echo "DELETE FROM printer_models WHERE id='$p_model'";
        $query=mysql_query("DELETE FROM printer_models WHERE id='$p_model'");
    }
    if ($count>1)   echo "Принтеры успешно удалены!|success";
    else            echo "Принтер $p_name успешно удалён!|success";
} else
    if ($count>1)   echo "Не удалось удалить принтеры!|error";
    else            echo "Не удалось удалить принтер $p_name!|error";

?>
