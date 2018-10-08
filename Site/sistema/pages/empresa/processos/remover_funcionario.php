// ARRUMAS EQUIPAMENTOS E VEICULOS 
<?php
	session_start();
	require('../../conexao_banco.php');
	if(isset($_GET['id'])){
		$set_pessoa = "UPDATE pessoas SET EMPRESA_ID_PESSOAS = NULL WHERE ID_PESSOAS = $_GET[id]";
		$update_pessoa = $conexao_bd->query($set_pessoa);

		$selecao_equipamento = "SELECT * FROM automoveis_empresa WHERE PESSOAS_ID_AUTOMOVEIS = $_GET[id]";
		$consulta_equipamento =  $conexao_bd->query($selecao_equipamento);
		while ($equipamento = mysqli_fetch_assoc($consulta_equipamento)) {
			$set_imprudencia = "UPDATE imprudencias SET EQUIPAMENTOS_ID_IMPRUDENCIAS = NULL WHERE EQUIPAMENTOS_ID_IMPRUDENCIAS = $equipamento[EQUIPAMENTOS_ID_AUTOMOVEIS]";
			$update_imprudencia = $conexao_bd->query($set_imprudencia);
		}

		$set_automovel = "UPDATE automoveis_empresa SET PESSOAS_ID_AUTOMOVEIS = NULL WHERE PESSOAS_ID_AUTOMOVEIS = $_GET[id]";
		$update_automovel = $conexao_bd->query($set_automovel);

		if($update_pessoa == true && $update_imprudencia == true && $update_automovel == true){
			$_SESSION['msg_funcionarios'] = "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Funcionário removido com sucesso.</div>";
			header("Location: ../funcionarios.php");
		} else {
			$_SESSION['msg_funcionarios'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Erro ao remover funcionário.</div>";
			header("Location: ../funcionarios.php");
		}
	} else {
		$_SESSION['msg_funcionarios'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Erro ao remover funcionário.</div>";
		header("Location: ../funcionarios.php");
	}
?>