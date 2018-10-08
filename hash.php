<?php 
	if(@$_POST){
		$passwd = $_POST['passwd'];
		echo hash('sha256',hash('sha256',$passwd));
	}
?>
<html>
	<head>
	</head>
	<body>
		<form action='hash.php' method='post'>
			<input type='text' name='passwd'>
			<input type='submit'>
		</form>
	</body>
</html>
