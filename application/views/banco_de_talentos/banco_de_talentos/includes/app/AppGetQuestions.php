<?php
require_once "Connection.php";
require_once "Session.php";

$IdChat = $_SESSION['current_chat'];

$query = mysql_query("SELECT IdMensagem,Mensagem FROM $table WHERE Status = 'pergunta-aberta' AND IdChat = $IdChat ORDER BY IdMensagem DESC",$conexao) or die(mysql_error());
//faz um looping e cria um array com os campos da consulta

  while($array = mysql_fetch_array($query)){
  //mostra na tela o nome e a data de nascimento
  echo '<li id="'.$array['IdMensagem'].'" class="checkBox"><input type="checkbox" class="check-for-question" value="'.$array['IdMensagem'].'" name="checked-for-question[]" id="">'.$array['Mensagem'].'</li>';
  }
?>