<?php 
	require('../../conexao_banco.php');
	session_start();
	
	$id = $_GET['id'];
	
	$selecao_automovel  = "DELETE FROM automoveis_pessoais WHERE ID_AUTOMOVEIS = '$id' AND PESSOAS_ID_PESSOAS = $_SESSION[id]";
	$deletar_automovel  = $conexao_bd->query($selecao_automovel);
	
	if ($total = mysqli_affected_rows($conexao_bd)){
		$_SESSION['msg_veiculopessoal'] = "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Veículo removido com sucesso.</div>";
		header ("Location: ../veiculospessoais.php");
	} else {
		$_SESSION['msg_veiculopessoal'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Não foi possivel remover o veículo da sua conta.</div>";
		header ("Location: ../veiculospessoais.php");
	}   
?>