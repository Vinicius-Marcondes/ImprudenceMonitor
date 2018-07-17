<?php
	session_start();
	require('../../conexao_banco.php');
	
	$id = $_POST['btn'];
	
	$selecao_veiculo = "SELECT * FROM automoveis_pessoais WHERE ID_AUTOMOVEIS = '$id'";
	$consulta_veiculo =  $conexao_bd->query($selecao_veiculo);
	$veiculo = mysqli_fetch_array($consulta_veiculo);
	
	$nome = $_POST['nome'];
	$tipo = $_POST['tipo'];
	$equipamento = $_POST['equipamento'];
	$placa = $_POST['placa'];
	if(isset($_POST['modelo'])){ $modelo = $_POST['modelo']; } else { $modelo = ''; }
	if(isset($_POST['marca'])){ $marca = $_POST['marca']; } else { $modelo = ''; }
	
	if(empty($_POST['placa']) || $_POST['placa'] == $veiculo['PLACA_AUTOMOVEIS']){
			$placa = $veiculo['PLACA_AUTOMOVEIS'];
	} else {
		$selecao_placa = "SELECT * FROM automoveis_pessoais WHERE PLACA_AUTOMOVEIS = '$placa'";
		$consulta_placa =  $conexao_bd->query($selecao_placa);
		if($consulta_placa->num_rows == 0){
			$placa = $_POST['placa'];
		} else {
			$_SESSION['msg_edit_veiculos'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Placa já está em uso.</div>";
			header("Location: ../editar_veiculospessoais.php?id=$id");
		}
	}
		
		$set_veiculo = "UPDATE automoveis_pessoais SET NOME_AUTOMOVEIS = '$nome', MODELO_AUTOMOVEIS = '$modelo', MARCA_AUTOMOVEIS = '$marca', TIPO_AUTOMOVEIS = '$tipo', EQUIPAMENTOS_PESSOAIS_ID_EQUIPAMENTOS = '$equipamento', PLACA_AUTOMOVEIS = '$placa' WHERE ID_AUTOMOVEIS = '$id'";
		$update_veiculo = $conexao_bd->query($set_veiculo);
		
		if($update_veiculo == true){
			$_SESSION['msg_edit_veiculos'] = "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Veículo alterado com sucesso.</div>";
			header("Location: ../editar_veiculospessoais.php?id=$id");
		} else {
			header("Location: ../editar_veiculospessoais.php?id=$id");
		}
?>