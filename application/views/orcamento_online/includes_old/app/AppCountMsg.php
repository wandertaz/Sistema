<?php
require_once "Connection.php";

$query = mysql_query("SELECT IdMensagem FROM $table ORDER BY IdMensagem DESC",$conexao) or die(mysql_error());
$row = mysql_fetch_array($query);
echo $row[0];
?>