<?php


$fileName = $_POST['filename'];
$serverFile = "../../users/photos/$fileName";
//$fp = fopen($serverFile,'w');
//fwrite($fp, base64_decode($_POST['photo']));
//fclose($fp);
$encodedData = $_POST['photo'];
$decodedData = base64_decode(substr($encodedData, strpos($encodedData,",")));
//$file = base64_decode(str_replace(' ','+',$decodedData));
file_put_contents($serverFile, $decodedData);
//$returnData = "serverFile: $serverFile";
print_r($encodedData);