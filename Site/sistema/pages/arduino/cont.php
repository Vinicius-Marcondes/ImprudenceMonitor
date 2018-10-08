<?php
require('../conexao_banco.php');
$ID_USER = $_GET['ID_USER'];
$cont = $conexao_bd->query("SELECT X_IMPRUDENCIAS FROM imprudencias WHERE ID_imprudencias = '$ID_USER'");
while($row = $cont->fetch_array()){
	echo $row[0];
}
?>

