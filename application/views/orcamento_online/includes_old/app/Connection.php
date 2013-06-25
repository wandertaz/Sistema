<?php
$host = "localhost"; $usuario = "multiphp_multi"; $senha = "multi1101"; $banco = "multiphp_mbconsultoria"; $table = "Chat";
$conexao = mysql_connect($host, $usuario, $senha) or die (mysql_error());
$db = mysql_select_db($banco,$conexao) or die (mysql_error());
?>