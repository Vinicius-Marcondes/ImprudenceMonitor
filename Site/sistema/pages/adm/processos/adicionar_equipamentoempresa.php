<?php 
	// Inicialização
	require('../../conexao_banco.php');
	session_start();
	
	if($_POST){
		// Pegando dados fornecidos
		$id = $_SESSION['empresa'];
		$nome = '000000';
		$serial = $_POST['serial'];
		
		// Verrificações
		$selecao_serial = "SELECT * FROM equipamentos_empresa where SERIAL_EQUIPAMENTOS = '$serial'";
		$consulta_serial =  $conexao_bd->query($selecao_serial);
		if($consulta_serial->num_rows != 0){ 
			unset($serial);
		} 
		
		// Inserção dos Dados
		if(isset($serial)){
			$selecao_equipamento = "INSERT INTO equipamentos_empresa (NOME_EQUIPAMENTOS, SERIAL_EQUIPAMENTOS, MODELO_EQUIPAMENTOS, EMPRESA_ID_EQUIPAMENTOS) 
			VALUES ('$nome', '$serial', NULL, NULL)";
			$add_equipamento = $conexao_bd->query($selecao_equipamento);
			if($add_equipamento == true){
				$_SESSION['msg_equipamento'] = "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>'$nome' foi adicionado com sucesso.</div>";
				header("Location: ../equipamentos.php");
			} else {
				$_SESSION['msg_equipamento'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Não foi possivel adicionar o equipamento a sua conta.</div>";
				header("Location: ../equipamentos.php");
			}
		} else {
			$_SESSION['msg_equipamento'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Esta serial já está sendo utilizada.</div>";
			header("Location: ../equipamentos.php");
		}
	} else {
		$_SESSION['msg_equipamento'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Nenhum dado fornecido.</div>";
		header("Location: ../equipamentos.php");
	}
?>