<?php
	$conecta_banco = new mysqli('192.168.100.69', 'vinicius', 'admin', 'mdi');
	if (!$conecta_banco) {
    die('Could not connect: ' . mysql_error());
	}
?>
