<?php
require_once "Connection.php";

$IdAutor = $_POST['current-user'];
$IdChat = $_POST['id-chat'];
$Mensagem = $_POST['mensagem'];
$DataHoraMensagem = date("Y-m-d H:i:s");
$Status = $_POST['status'];

if ($Mensagem != ''){
	mysql_query("INSERT INTO $table (IdAutor, IdChat, Mensagem, DataHoraMensagem, Status) VALUES ('$IdAutor', '$IdChat', '$Mensagem', '$DataHoraMensagem', '$Status')",$conexao) or die(mysql_error());
}
?>