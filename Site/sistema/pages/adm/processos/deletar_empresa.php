<?php 
	require('../../conexao_banco.php');
	session_start();
	
	$id = $_GET['id'];
	
	$selecao_automovel = "DELETE FROM automoveis_empresa WHERE EMPRESA_ID_AUTOMOVEIS = '$id'";
	$deletar_automovel = $conexao_bd->query($selecao_automovel);

	$selecao_equip = "SELECT * FROM equipamentos_empresa WHERE EMPRESA_ID_EQUIPAMENTOS = '$id'";
	$consulta_equip = $conexao_bd->query($selecao_equip);

	while($equipamento = mysqli_fetch_assoc($consulta_equip)){
		$equip = $equipamento['ID_EQUIPAMENTOS'];
		$set_imprudencias = "UPDATE imprudencias SET EQUIPAMENTOS_ID_IMPRUDENCIAS = NULL WHERE EQUIPAMENTOS_ID_IMPRUDENCIAS = '$equip'";
		$update_imprudencias = $conexao_bd->query($set_imprudencias);
	}

	$selecao_equipamento = "DELETE FROM equipamentos_empresa WHERE EMPRESA_ID_EQUIPAMENTOS = '$id'";
	$deletar_equipamento = $conexao_bd->query($selecao_equipamento);

	$selecao_imagem = "SELECT * FROM imagens_empresas_pessoas WHERE EMPRESA_ID_IMAGENS = '$id'";
	$consulta_imagem = $conexao_bd->query($selecao_imagem);
	$img = mysqli_fetch_assoc($consulta_imagem);
	$imagem = $img['ARQUIVO_IMAGENS'];
	unlink("../../../images/1_empresas/$imagem");

	$selecao_img = "DELETE FROM imagens_empresas_pessoas WHERE EMPRESA_ID_IMAGENS = '$id'";
	$deletar_img = $conexao_bd->query($selecao_img);
	
	$set_pessoa = "UPDATE pessoas SET EMPRESA_ID_PESSOAS = NULL WHERE EMPRESA_ID_PESSOAS = '$id'";
	$update_pessoa = $conexao_bd->query($set_pessoa);

	$selecao_empresa = "DELETE FROM empresa WHERE ID_EMPRESA = '$id'";
	$deletar_empresa = $conexao_bd->query($selecao_empresa);

	if ($total = mysqli_affected_rows($conexao_bd)){
		$_SESSION['msg_empresa'] = "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Empresa removida com sucesso.</div>";
		header ("Location: ../empresas.php");
	} else {
		$_SESSION['msg_empresa'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Não foi possivel remover a empresa.</div>";
		header ("Location: ../empresas.php");
	}  
?>