<!doctype html>
<html>
    <head>
        <meta charset="UTF-8")
    </head>
    <body>

    <?php

    ini_set("display_errors",1);
    error_reporting(E_ALL ^E_NOTICE);

    $ROOT_CATALOG           = $_SERVER["DOCUMENT_ROOT"];
    $PRICE_CATALOG          = $ROOT_CATALOG."/data";
    $SCRIPTS_CATALOG        = $ROOT_CATALOG."/admin";
    $UPLOAD_CONFIG_FILENAME = $ROOT_CATALOG."/admin/update_config.xml";

    $xml = simplexml_load_file($UPLOAD_CONFIG_FILENAME);
    $i = 0;

    function eval_script($p) {
        if (file_exists($p)) {
            echo "script found";
            $p_handle = fopen($p, "r");
            $p_contents = fread($p_handle, filesize($p));
            fclose($p_handle);
            eval($p_contents);
        } else echo "script not found";
}


    foreach ($xml -> files ->file as $price_file) {
        $files[$i]['filename']    = (string) $price_file -> attributes() -> name;
        $files[$i]['script']      = (string) $price_file -> attributes() -> script;
        $files[$i]['upload_time'] = date("Y-m-d G:i:s", filemtime($PRICE_CATALOG."/".$files[$i]['filename']));
        $files[$i]['update_time'] = (string) $price_file -> attributes() -> update_time;

        if (strtotime($files[$i]['update_time']) < strtotime($files[$i]['upload_time'])) {
            echo "Price \"".$files[$i]['filename']."\" was changed. Updating...";
            exec($SCRIPTS_CATALOG."/".$files[$i]['script']);
            $price_file -> attributes() -> update_time = date("Y-m-d G:i:s");
            echo "Done.<br>";
        } else echo "Price \"".$files[$i]['filename']."\" was not changed.<br>";
        $i++;
    }

    $xml -> saveXML($UPLOAD_CONFIG_FILENAME);

    ?>

    </body>
</html>
/usr/local/bin/php -f /home/avtosale/domains/autoexpres.ru/public_html/admin/