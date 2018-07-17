<?php
	$conexao_bd = new mysqli('localhost', 'root', 'usbw', 'mdi_banco');
	if (!$conexao_bd) {
		die('Não foi possível conectar: ' . mysql_error());
	}
?>
