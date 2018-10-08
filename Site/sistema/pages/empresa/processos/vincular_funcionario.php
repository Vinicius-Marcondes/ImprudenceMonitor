<?php
	session_start();
	require('../../conexao_banco.php');
	if(isset($_POST['true'])){
		
		$set_pessoa = "UPDATE pessoas SET EMPRESA_ID_PESSOAS = $_POST[true] WHERE ID_PESSOAS = $_SESSION[id]";
		$update_pessoa = $conexao_bd->query($set_pessoa);
		if($update_pessoa == true){
			$selecao_notificacao = "DELETE FROM notificacoes WHERE EMPRESA_ID_NOTIFICACOES = $_POST[true] AND PESSOAS_ID_NOTIFICACOES = $_SESSION[id]";
			$deletar_notificacao = $conexao_bd->query($selecao_notificacao);
			header("Location: ../perfil.php?page=2");
		} else {
			header("Location: ../perfil.php?page=2");
		}

	} else {
		$selecao_notificacao = "DELETE FROM notificacoes WHERE EMPRESA_ID_NOTIFICACOES = $_POST[false] AND PESSOAS_ID_NOTIFICACOES = $_SESSION[id]";
		$deletar_notificacao = $conexao_bd->query($selecao_notificacao);
		header("Location: ../perfil.php?page=2");
	}
?>