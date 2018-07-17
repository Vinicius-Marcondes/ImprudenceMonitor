<?php 
	// Inicialização
	require('../../conexao_banco.php');
	session_start();
	
	if($_POST){
		// Pegando dados fornecidos
		$id = $_SESSION['id'];
		$nome = $_POST['nome'];
		$marca = $_POST['marca'];
		$modelo = $_POST['modelo'];
		$placa = $_POST['placa'];
		$tipo = $_POST['tipo'];
		$equipamento = $_POST['equipamento'];
		
		// Verrificações
		$selecao_placa = "SELECT * FROM automoveis_pessoais where PLACA_AUTOMOVEIS = '$placa'";
		$consulta_placa =  $conexao_bd->query($selecao_placa);
		if($consulta_placa->num_rows != 0){ 
			unset($placa);
		} 
		
		// Inserção dos Dados
		if(isset($placa)){
			$selecao_veiculo = "INSERT INTO automoveis_pessoais (NOME_AUTOMOVEIS, MARCA_AUTOMOVEIS, MODELO_AUTOMOVEIS, TIPO_AUTOMOVEIS, PLACA_AUTOMOVEIS, PESSOAS_ID_PESSOAS, EQUIPAMENTOS_PESSOAIS_ID_EQUIPAMENTOS) 
			VALUES ('$nome', '$marca', '$modelo', '$tipo', '$placa', '$id', '$equipamento')";
			$add_veiculo = $conexao_bd->query($selecao_veiculo);
			if($add_veiculo == true){
				$_SESSION['msg_veiculopessoal'] = "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>'$nome' foi adicionado com sucesso.</div>";
				header("Location: ../veiculospessoais.php");
			} else {
				$_SESSION['msg_veiculopessoal'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Não foi possivel adicionar o veículo a sua conta.</div>";
				header("Location: ../veiculospessoais.php");
			}
		} else {
			$_SESSION['msg_veiculopessoal'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Esta placa já está sendo utilizada.</div>";
			header("Location: ../veiculospessoais.php");
		}
	} else {
		$_SESSION['msg_veiculopessoal'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Nenhum dado fornecido.</div>";
		header("Location: ../veiculospessoais.php");
	}
?>