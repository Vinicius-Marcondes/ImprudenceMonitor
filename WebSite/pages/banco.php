<?php
	$conecta_banco = new mysqli('localhost', 'root', 'usbw', 'mdi');
	if (!$conecta_banco) {
    die('Could not connect: ' . mysql_error());
	}
?>
