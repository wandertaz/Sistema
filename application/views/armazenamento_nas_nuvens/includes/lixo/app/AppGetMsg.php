<?php
require_once "Connection.php";
require_once "Session.php";

$IdChat = $_SESSION['current_chat'];

$query = mysql_query("SELECT IdMensagem,Mensagem,DataHoraMensagem,Status,MensagemRespostaDe,IdAutor FROM $table WHERE IdChat = $IdChat ORDER BY DataHoraMensagem DESC",$conexao) or die(mysql_error());
//faz um looping e cria um array com os campos da consulta

  while($array = mysql_fetch_array($query)){
  //mostra na tela o nome e a data de nascimento

  if($array['Status']=='resposta'){
    if ($_SESSION['current_user']==$array['IdAutor']) {
      echo '<li class="li-no-question current_author_on" id="'.$array['IdMensagem'].'">'.$array['Mensagem'];
    }else{
      echo '<li class="li-no-question" id="'.$array['IdMensagem'].'">'.$array['Mensagem'];
    }

  	echo '<ul class="resposta">';	
	$arr=explode(",",$array['MensagemRespostaDe']);
  	foreach ($arr as $perguntaRespondida) {

	  	$query2 = mysql_query("SELECT IdMensagem,Mensagem,IdAutor FROM $table WHERE IdChat = $IdChat AND IdMensagem = $perguntaRespondida",$conexao) or die(mysql_error());
	  	while($array2 = mysql_fetch_array($query2)){
        if ($_SESSION['current_user']==$array2['IdAutor']) {
            echo '<li class="current_author_on" id="'.$array2['IdMensagem'].'">'.$array2['Mensagem'].'</li>';
        }else{
            echo '<li id="'.$array2['IdMensagem'].'">'.$array2['Mensagem'].'</li>';
        }
	  	}
  	}
  	echo '</ul></li>';
  }else{
    if ($_SESSION['current_user']==$array['IdAutor']) {
      echo '<li class="li-no-question current_author_on" id="'.$array['IdMensagem'].'">'.$array['Mensagem'];
    }else{
      echo '<li class="li-no-question" id="'.$array['IdMensagem'].'">'.$array['Mensagem'];
    } 	
  }

  }
?>