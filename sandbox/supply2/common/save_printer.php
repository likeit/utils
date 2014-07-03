<?php

require_once('../common/dbconnect.inc');

$p_id         = $_POST["p_id"];
$p_name       = $_POST["p_name"];
$p_model      = $_POST["p_model"];
$p_area       = $_POST["p_area"];
$p_supply     = $_POST["p_supply"];
$p_comment    = $_POST["p_comment"];

//find model
$p_model_row  = mysql_query("SELECT * FROM printer_models WHERE name='$p_model'");
$m              = mysql_fetch_array ($p_model_row);
if (empty($m)) {
    $add_model = mysql_query("
          INSERT INTO printer_models  (id,    name)
          VALUES                      (null,  '$p_model')
    ");
    $p_model_row  = mysql_query("SELECT * FROM printer_models WHERE name='$p_model'");
    $m              = mysql_fetch_array ($p_model_row);
};
$p_model        = $m['id'];

if ($p_id == 'New') {
// ADD PRINTER
    $action = 'new';
    $query = ("
        INSERT INTO printers
            (id,    name,         model,        area,         cartridge_use,  comment)
        VALUES
            (null,  '$p_name',    '$p_model',   '$p_area',    '$p_supply',    '$p_comment')
    ");
} else {
// EDIT PRINTER
    $action = 'edit';
    $query = "
        UPDATE printers SET
            name='$p_name',
            model='$p_model',
            area='$p_area',
            cartridge_use='$p_supply',
            comment='$p_comment'
        WHERE id='$p_id'
    ";
}

$result = mysql_query($query);

if ($result == 'true')
    if ($action == 'new')
        echo "Принтер $p_name успешно добавлен!|success";
    else
        echo "Принтер $p_name успешно изменён!|success";
else
    echo "Не удалось добавить принтер $p_name! Проверьте все поля!|error";

?>
