<?php
	session_start();
	require('../../conexao_banco.php');
	
	$id = $_POST['btn'];
	$funcao = $_POST['funcao'];
		
	$set_pessoa = "UPDATE pessoas SET PERFIL_ID_PESSOAS = '$funcao' WHERE ID_PESSOAS = '$id'";
	$update_pessoa = $conexao_bd->query($set_pessoa);
		
	if($update_pessoa == true){
		$_SESSION['msg_edit_usuario'] = "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Fuñção alterada com sucesso.</div>";
		header("Location: ../editar_usuario.php?id=$id");
	} else {
		$_SESSION['msg_edit_usuario'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Erro ao alterar Função.</div>";
		header("Location: ../editar_usuario.php?id=$id");
	}
?>