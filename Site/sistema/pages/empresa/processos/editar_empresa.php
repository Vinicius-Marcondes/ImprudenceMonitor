<?php
	session_start();
	require('../../conexao_banco.php');
	
	$cod = $_SESSION['id'];
	$function = $_POST['btn'];
	
	$selecao_empresa = "SELECT * FROM empresa where ID_EMPRESA = '$cod'";
	$consulta_empresa =  $conexao_bd->query($selecao_empresa);
	$empresa = mysqli_fetch_array($consulta_empresa);
	
	if($function == 1){
		$nome = $_POST['nome'];
		$email = $_POST['email'];
		$cnpj = $_POST['cnpj'];
		
		if(empty($_POST['email']) || $_POST['email'] == $empresa['EMAIL_EMPRESA']){
			$email = $empresa['EMAIL_EMPRESA'];
		} else {
			$selecao_email = "SELECT * FROM empresa WHERE EMAIL_EMPRESA = '$email'";
			$consulta_email =  $conexao_bd->query($selecao_email);
			if($consulta_email->num_rows == 0){
				$email = $_POST['email'];
				$x = true;
			} else {
				unset($email);
				$_SESSION['msg_perfil_1'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Email já está em uso.</div>";
				header('Location: ../perfil.php?page=4');
			}
		}
		
		if(empty($_POST['cnpj']) || $_POST['cnpj'] == $pessoa['CNPJ_EMPRESA']){
			$cnpj = $empresa['CNPJ_EMPRESA'];
		} else {
			$selecao_cnpj = "SELECT * FROM empresa WHERE CNPJ_EMPRESA = $cnpj";
			$consulta_cnpj = $conexao_bd->query($selecao_cnpj);
			if($consulta_cnpj->num_rows == 0){
				$cnpj = $_POST['cnpj'];
			} else {
				unset($cpf);
				$_SESSION['msg_perfil_1'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>CNPJ já está em uso.</div>";
				header('Location: ../perfil.php?page=4');
			}
		}
		
		if(isset($cnpj) && isset($email)){
			$set_empresa = "UPDATE empresa SET NOME_EMPRESA = '$nome', EMAIL_EMPRESA = '$email', CNPJ_EMPRESA = '$cnpj' WHERE ID_EMPRESA = '$cod'";
			$update_empresa = $conexao_bd->query($set_empresa);
		}
		
		if($update_empresa == true){
			if($x){
				session_unset();
				session_destroy();
				header('Location: ../../../index.php');
			} else {
				$_SESSION['msg_perfil_1'] = "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Dados foram alterados com sucesso.</div>";
				header('Location: atualizar_dados.php');
			}
		} else {
			header('Location: ../perfil.php?page=4');
		}
	} else if($function == 2){
		$senha = $conexao_bd->real_escape_string($_POST['senha']); 
		$senha = hash("sha256", hash("sha256", $senha));
		$set_empresa = "UPDATE empresa SET SENHA_EMPRESA = '$senha' WHERE ID_EMPRESA = '$cod'";
		$update_empresa = $conexao_bd->query($set_empresa);
		
		if($update_empresa == true){
			session_unset();
			session_destroy();
			header('Location: ../../../index.php');
		} else {
			$_SESSION['msg_perfil_3'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Erro ao alterar os dados.</div>";
			header('Location: ../perfil.php?page=4');
		}
	} else if($function == 3){
		$telefone = $_POST['telefone'];
		
		$set_empresa = "UPDATE empresa SET TELEFONE_EMPRESA = '$telefone' WHERE ID_EMPRESA = '$cod'";
		$update_empresa = $conexao_bd->query($set_empresa);
		
		if($update_empresa == true){
			$_SESSION['msg_perfil_4'] = "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Dados foram alterados com sucesso.</div>";
			header('Location: ../perfil.php?page=4');
		} else {
			$_SESSION['msg_perfil_4'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Erro ao alterar os dados.</div>";
			header('Location: ../perfil.php?page=4');
		}
	} else if($function == 4){
		$cep = $_POST['cep'];
		
		$set_empresa = "UPDATE empresa SET CEP_EMPRESA = '$cep' WHERE ID_EMPRESA = '$cod'";
		$update_empresa = $conexao_bd->query($set_empresa);
		
		if($update_empresa == true){
			$_SESSION['msg_perfil_5'] = "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>CEP alterado com sucesso.</div>";
			header('Location: ../perfil.php?page=4');
		} else {
			$_SESSION['msg_perfil_5'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Erro ao alterar os dados.</div>";
			header('Location: ../perfil.php?page=4');
		}
	} else if($function == 5){
		$logo_antiga = "../../../images/1_empresas/$_SESSION[logo]";
		unlink($logo_antiga);
		
		if(isset($_FILES['arquivo'])){
			$extensao = strtolower(substr($_FILES['arquivo']['name'], -4));
			$novo_nome = md5(time()). $extensao;
			$diretorio = "../../../images/1_empresas/";
			move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$novo_nome);
			
			$set_imagem = "UPDATE imagens_empresas_pessoas SET ARQUIVO_IMAGENS = '$novo_nome' WHERE EMPRESA_ID_IMAGENS = '$cod'";
			$update_imagem = $conexao_bd->query($set_imagem);
			if($update_imagem == true){
				$_SESSION['logo'] = $novo_nome;
				$_SESSION['msg_perfil_2'] = "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Imagem de perfil alterada com sucesso.</div>";
				header('Location: ../perfil.php?page=4');
			} else {
				$_SESSION['msg_perfil_2'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Erro ao alterar imagem de perfil.</div>";
			}
		}
	}
?>