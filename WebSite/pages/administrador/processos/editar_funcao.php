<?php
	session_start();
	require('../../banco.php');
	
	$cod = $_POST['editar2'];
	$c_selecao = "SELECT * FROM perfil where idPE = '$cod'";
	$v_selecao =  $conecta_banco->query($c_selecao);
	$coluna_selecao = mysqli_fetch_array($v_selecao);
	
	if(empty($_POST['nome']) || $_POST['nome'] == $coluna_selecao['nomePE']){
		$nome = $coluna_selecao['nomePE'];
	} else {
		$ver_nome = $_POST['nome'];
		$c_nome = "SELECT * FROM perfil WHERE nomePE = '$ver_nome'";
		$v_nome =  $conecta_banco->query($c_nome);
		if($v_nome->num_rows == 0){
			$nome = $_POST['nome'];
		} else {
			$_SESSION['mensagem_perfil'] = "<div class='alert alert-warning'><strong>Atenção!</strong> Este nome já está em uso.</div>";
			header('Location: ../listagem_perfil.php');
		}
	}
	
	if(isset($nome)){
		$up_perfil = "UPDATE perfil SET nomePE = '$nome' where idPE = '$cod'";
		$update_perfil = $conecta_banco->query($up_perfil);
		if($update_perfil == true){
			$_SESSION['mensagem_perfil'] = "<div class='alert alert-success'><strong>Sucesso!</strong> Nome alterado.</div>";
			header('Location: ../listagem_perfil.php');
		} else {
			$_SESSION['mensagem_perfil'] = "<div class='alert alert-danger'><strong>Erro!</strong> Por favor tente novamente em alguns instantes.</div>";
			header('Location: ../listagem_perfil.php');
		}
	}
?>