<?php
	if($_SESSION['lock']){
		header("Location: lock_screen.php");
	} else if(!isset($_SESSION['email']) || !isset($_SESSION['senha'])){
		header("Location: ../../index.php");
	}
?>
