<?php
	$conexao_bd = new mysqli('127.0.0.1', 'root', 'usbw', 'mdi_banco');
	if (!$conexao_bd) {
		die('Não foi possível conectar: ' . mysql_error());
	}
?>