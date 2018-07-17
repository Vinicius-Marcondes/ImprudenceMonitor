<?php
	session_start();
	require('../../conexao_banco.php');
	
	$id = $_POST['btn'];
	
	$selecao_equipamento = "SELECT * FROM equipamentos_pessoais WHERE ID_EQUIPAMENTOS = '$id'";
	$consulta_equipamento =  $conexao_bd->query($selecao_equipamento);
	$equipamento = mysqli_fetch_array($consulta_equipamento);
	
	$nome = $_POST['nome'];
	if(isset($_POST['modelo'])){ $modelo = $_POST['modelo']; } else { $modelo = ''; }
	$serial = $_POST['serial'];
		
	if(empty($_POST['serial']) || $_POST['serial'] == $equipamento['SERIAL_EQUIPAMENTOS']){
			$serial = $equipamento['SERIAL_EQUIPAMENTOS'];
	} else {
		$selecao_serial = "SELECT * FROM equipamentos_pessoais WHERE SERIAL_EQUIPAMENTOS = '$serial'";
		$consulta_serial =  $conexao_bd->query($selecao_serial);
		if($consulta_serial->num_rows == 0){
			$serial = $_POST['serial'];
		} else {
			$_SESSION['msg_edit_equipamentos'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Serial já está em uso.</div>";
			header("Location: ../editar_equipamentospessoais.php?id=$id");
		}
	}
		
		$set_equipamento = "UPDATE equipamentos_pessoais SET NOME_EQUIPAMENTOS = '$nome', MODELO_EQUIPAMENTOS = '$modelo', SERIAL_EQUIPAMENTOS = '$serial' WHERE ID_EQUIPAMENTOS = '$id'";
		$update_equipamento = $conexao_bd->query($set_equipamento);
		
		if($update_equipamento == true){
			$_SESSION['msg_edit_equipamentos'] = "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Equipamento alterado com sucesso.</div>";
			header("Location: ../editar_equipamentospessoais.php?id=$id");
		} else {
			//$_SESSION['msg_edit_equipamentos'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Erro ao alterar dados.</div>";
			header("Location: ../editar_equipamentospessoais.php?id=$id");
		}
?>