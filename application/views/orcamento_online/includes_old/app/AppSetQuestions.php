<?php
require_once "Connection.php";

$IdAutor = $_POST['current-user'];
$IdChat = $_POST['id-chat'];
$Mensagem = $_POST['mensagem'];
$DataHoraMensagem = date("Y-m-d H:i:s");
$Status = 'resposta';

$MensagemRespostaDe = implode(',',$_POST['checked-for-question']);



// $str = implode(',',$checkedForReply);
// $arr=explode(",",$str);
// print_r($arr);

if ($Mensagem != ''&&$MensagemRespostaDe){
	mysql_query("INSERT INTO $table (IdAutor, IdChat, Mensagem, DataHoraMensagem, Status, MensagemRespostaDe) VALUES ('$IdAutor', '$IdChat', '$Mensagem', '$DataHoraMensagem', '$Status', '$MensagemRespostaDe')",$conexao) or die(mysql_error());

	if ($_POST['checked-for-question']) {
		foreach ($_POST['checked-for-question'] as $Pergunta) {
			mysql_query("UPDATE $table SET Status = 'pergunta-respondida' WHERE IdMensagem = ".$Pergunta.";",$conexao) or die(mysql_error());
		}
	}
}
?>


