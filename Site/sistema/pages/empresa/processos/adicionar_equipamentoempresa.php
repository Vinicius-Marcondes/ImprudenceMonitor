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
		$selecao_serial = "SELECT * FROM equipamentos_empresa WHERE SERIAL_EQUIPAMENTOS = '$serial'";
		$consulta_serial = $conexao_bd->query($selecao_serial);
		$equipamento = mysqli_fetch_array($consulta_serial);
		if($consulta_serial->num_rows == 0 || $equipamento['EMPRESA_ID_EQUIPAMENTOS'] > 0){ 
			unset($serial);
		} 
		
		// Inserção dos Dados
		if(isset($serial)){
			$set_equipamento = "UPDATE equipamentos_empresa SET NOME_EQUIPAMENTOS = '$nome', MODELO_EQUIPAMENTOS = '$modelo', EMPRESA_ID_EQUIPAMENTOS = '$_SESSION[id]' WHERE SERIAL_EQUIPAMENTOS = '$serial'";
			$update_equipamento = $conexao_bd->query($set_equipamento);

			if($update_equipamento == true){
				$_SESSION['msg_equipamento'] = "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>'$nome' foi adicionado com sucesso.</div>";
				header("Location: ../equipamentosempresa.php");
			} else {
				$_SESSION['msg_equipamento'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Não foi possivel adicionar o equipamento a sua conta.</div>";
				header("Location: ../equipamentosempresa.php");
			}
		} else {
			$_SESSION['msg_equipamento'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Não foi possivel adicionar o equipamento a sua conta.</div>";
			header("Location: ../equipamentosempresa.php");
		}
	}
?>