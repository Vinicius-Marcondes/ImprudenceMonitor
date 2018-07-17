<?php 
	require('../../conexao_banco.php');
	session_start();
	
	$id = $_GET['id'];
	
	$selecao_imprudencia = "UPDATE imprudencias SET EQUIPAMENTOS_PESSOAIS_ID_EQUIPAMENTOS = NULL WHERE EQUIPAMENTOS_PESSOAIS_ID_EQUIPAMENTOS = '$id' AND PESSOAS_ID_IMPRUDENCIAS = $_SESSION[id]";
	$update_imprudencia = $conexao_bd->query($selecao_imprudencia);
	
	$selecao_veiculo = "UPDATE automoveis_pessoais SET EQUIPAMENTOS_PESSOAIS_ID_EQUIPAMENTOS = NULL WHERE EQUIPAMENTOS_PESSOAIS_ID_EQUIPAMENTOS = '$id' AND PESSOAS_ID_PESSOAS = $_SESSION[id]";
	$update_veiculo = $conexao_bd->query($selecao_veiculo);
	
	$selecao_equipamento  = "DELETE FROM equipamentos_pessoais WHERE ID_EQUIPAMENTOS = '$id' AND PESSOAS_ID_PESSOAS = $_SESSION[id]";
	$deletar_equipamento  = $conexao_bd->query($selecao_equipamento);
	
	if ($total = mysqli_affected_rows($conexao_bd)){
		$_SESSION['msg_equipamentopessoal'] = "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Equipamento removido com sucesso.</div>";
		header ("Location: ../equipamentospessoais.php");
	} else {
		$_SESSION['msg_equipamentopessoal'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Não foi possivel remover o equipamento da sua conta.</div>";
		header ("Location: ../equipamentospessoais.php");
	}   
?>