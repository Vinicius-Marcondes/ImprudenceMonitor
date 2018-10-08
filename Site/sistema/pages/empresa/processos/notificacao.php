<?php
	session_start();
	require('../../conexao_banco.php');
	
	if(!isset($_SESSION['ingressar'])){
		$id = $_POST['id'];
		$id_empresa = $_SESSION['id'];

		$selecao_empresa = "SELECT * FROM empresa WHERE ID_EMPRESA = '$id_empresa'";
		$consulta_empresa =  $conexao_bd->query($selecao_empresa);
		$empresa = mysqli_fetch_assoc($consulta_empresa);
		$nome_empresa = $empresa['NOME_EMPRESA'];

		$selecao_pessoa = "SELECT * FROM pessoas INNER JOIN perfil ON pessoas.PERFIL_ID_PESSOAS = perfil.ID_PERFIL WHERE ID_PESSOAS = '$id'";
		$consulta_pessoa = $conexao_bd->query($selecao_pessoa);
		$pessoa = mysqli_fetch_assoc($consulta_pessoa);
		if(!empty($pessoa['EMPRESA_ID_PESSOAS'])){
			unset($id);
			$_SESSION['msg_funcionarios'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Esta pessoa já está vinculada em outra empresa.</div>";
			header("Location: ../funcionarios.php");
		}

		$selecao_not= "SELECT * FROM notificacoes WHERE PESSOAS_ID_NOTIFICACOES = '$id' AND EMPRESA_ID_NOTIFICACOES = '$id_empresa'";
		$consulta_not = $conexao_bd->query($selecao_not);

		if($consulta_not->num_rows != 0){
			unset($id);
			$_SESSION['msg_funcionarios'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Já foi enviada uma solicitação à esta pessoa.</div>";
			header("Location: ../funcionarios.php");
		}

		if($pessoa['NOME_PERFIL'] == "Administrador"){
			unset($id);
			$_SESSION['msg_funcionarios'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Esta pessoa não pode se associar a nenhuma empresa.</div>";
			header("Location: ../funcionarios.php");
		}

		if($consulta_pessoa->num_rows == 0){
			unset($id);
			$_SESSION['msg_funcionarios'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Este código não é valido.</div>";
			header("Location: ../funcionarios.php");
		}

		$msg = "A empresa $nome_empresa quer vincular você a ela. Caso for engano pedimos para negar a solicitação.";
		$tipo = "contratação";

		if(isset($id)){
			$selecao_notificacao = "INSERT INTO notificacoes (MENSAGEM_NOTIFICACOES, TIPO_NOTIFICACOES, EMPRESA_ID_NOTIFICACOES, PESSOAS_ID_NOTIFICACOES) VALUES ('$msg', '$tipo', '$id_empresa', '$id')";
			$add_notificacao = $conexao_bd->query($selecao_notificacao);
			if($add_notificacao == true){
				$_SESSION['msg_funcionarios'] = "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Solicitação enviada com sucesso.</div>";
				header("Location: ../funcionarios.php");
			} else {
				$_SESSION['msg_funcionarios'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Não foi possivel vincular esta pessoa.</div>";
				header("Location: ../funcionarios.php");
			}
		}
	}
?>