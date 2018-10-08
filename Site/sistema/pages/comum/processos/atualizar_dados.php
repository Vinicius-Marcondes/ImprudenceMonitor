<?php
	session_start();
	require('../../conexao_banco.php');
	
	$selecao_pessoa = "SELECT * FROM pessoas INNER JOIN perfil ON pessoas.PERFIL_ID_PESSOAS = perfil.ID_PERFIL WHERE ID_PESSOAS = $_SESSION[id]";
	$consulta_pessoa =  $conexao_bd->query($selecao_pessoa);
	if($consulta_pessoa->num_rows == 1){
		$pessoa = mysqli_fetch_array($consulta_pessoa);
		$_SESSION['nome'] = $pessoa['NOME_PESSOAS'];
		$_SESSION['perfil'] = $pessoa['PERFIL_ID_PESSOAS'];
		$_SESSION['empresa'] = $pessoa['EMPRESA_ID_PESSOAS'];
		$_SESSION['funcao'] = $pessoa['NOME_PERFIL'];
		$id = $_SESSION['id'];
		$selecao_imagem = "SELECT * FROM imagens_empresas_pessoas where PESSOAS_ID_PESSOAS = '$id'";
		$consulta_imagem =  $conexao_bd->query($selecao_imagem);
		if($consulta_imagem->num_rows == 1){
			$logo = mysqli_fetch_array($consulta_imagem);
			$_SESSION['logo'] = $logo['ARQUIVO_IMAGENS'];
		} else {
			$_SESSION['logo'] = "padrao.png";
		}
	}
	
	header('Location: ../perfil.php?page=4');
?>
