<?php 

$serverName = "*";
$connectionInfo = array(  "UID" => "*",  "PWD" => "*",  "Database" => "*", "ReturnDatesAsStrings"=> true, "CharacterSet" => 'utf-8');
$conn = sqlsrv_connect($serverName, $connectionInfo);

?>
