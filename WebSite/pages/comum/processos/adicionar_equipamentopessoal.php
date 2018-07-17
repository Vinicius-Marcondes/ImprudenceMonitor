<?php 
	// Inicialização
	require('../../conexao_banco.php');
	session_start();
	
	if($_POST){
		// Pegando dados fornecidos
		$id = $_SESSION['id'];
		$nome = $_POST['nome'];
		$serial = $_POST['serial'];
		$modelo = $_POST['modelo'];
		
		// Verrificações
		$selecao_serial = "SELECT * FROM equipamentos_pessoais where SERIAL_EQUIPAMENTOS = '$serial'";
		$consulta_serial =  $conexao_bd->query($selecao_serial);
		if($consulta_serial->num_rows != 0){ 
			unset($serial);
		} 
		
		// Inserção dos Dados
		if(isset($serial)){
			$selecao_equipamento = "INSERT INTO equipamentos_pessoais (NOME_EQUIPAMENTOS, SERIAL_EQUIPAMENTOS, MODELO_EQUIPAMENTOS, PESSOAS_ID_PESSOAS) 
			VALUES ('$nome', '$serial', '$modelo', '$id')";
			$add_equipamento = $conexao_bd->query($selecao_equipamento);
			if($add_equipamento == true){
				$_SESSION['msg_equipamentopessoal'] = "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>'$nome' foi adicionado com sucesso.</div>";
				header("Location: ../equipamentospessoais.php");
			} else {
				$_SESSION['msg_equipamentopessoal'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Não foi possivel adicionar o equipamento a sua conta.</div>";
				header("Location: ../equipamentospessoais.php");
			}
		} else {
			$_SESSION['msg_equipamentopessoal'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Esta serial já está sendo utilizada.</div>";
			header("Location: ../equipamentospessoais.php");
		}
	} else {
		$_SESSION['msg_equipamentopessoal'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Nenhum dado fornecido.</div>";
		header("Location: ../equipamentospessoais.php");
	}
?>