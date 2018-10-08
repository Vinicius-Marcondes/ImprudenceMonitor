<?php 
	require('../../conexao_banco.php');
	session_start();
	
	$id = $_GET['id'];
	
	$selecao_imprudencia = "UPDATE imprudencias SET EQUIPAMENTOS_ID_IMPRUDENCIAS = NULL WHERE EQUIPAMENTOS_ID_IMPRUDENCIAS = '$id'";
	$update_imprudencia = $conexao_bd->query($selecao_imprudencia);
	
	$selecao_veiculo = "UPDATE automoveis_empresa SET EQUIPAMENTOS_ID_AUTOMOVEIS = NULL WHERE EQUIPAMENTOS_ID_AUTOMOVEIS = '$id' AND EMPRESA_ID_AUTOMOVEIS = $_SESSION[id]";
	$update_veiculo = $conexao_bd->query($selecao_veiculo);
	
	$set_equipamento = "UPDATE equipamentos_empresa SET EMPRESA_ID_EQUIPAMENTOS = NULL WHERE EMPRESA_ID_EQUIPAMENTOS = '$_SESSION[id]'";
	$update_equipamento = $conexao_bd->query($set_equipamento);
	
	if ($update_equipamento == true){
		$_SESSION['msg_equipamento'] = "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Equipamento removido com sucesso.</div>";
		header ("Location: ../equipamentosempresa.php");
	} else {
		$_SESSION['msg_equipamento'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Não foi possivel remover o equipamento da sua conta.</div>";
		header ("Location: ../equipamentosempresa.php");
	}   
?>