<?php
	session_start();
	require('../../conexao_banco.php');
	
	$cod = $_SESSION['id'];
	$function = $_POST['btn'];
	
	$selecao_pessoa = "SELECT * FROM pessoas where ID_PESSOAS = '$cod'";
	$consulta_pessoa =  $conexao_bd->query($selecao_pessoa);
	$pessoa = mysqli_fetch_array($consulta_pessoa);
	
	if($function == 1){
		$nome = $_POST['nome'];
		$email = $_POST['email'];
		$cpf = $_POST['cpf'];
		$rg = $_POST['rg'];
		
		if(empty($_POST['email']) || $_POST['email'] == $pessoa['EMAIL_PESSOAS']){
			$email = $pessoa['EMAIL_PESSOAS'];
		} else {
			$selecao_email = "SELECT * FROM pessoas WHERE EMAIL_PESSOAS = '$email'";
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
		
		if(empty($_POST['cpf']) || $_POST['cpf'] == $pessoa['CPF_PESSOAS']){
			$cpf = $pessoa['CPF_PESSOAS'];
		} else {
			$selecao_cpf = "SELECT * FROM pessoas WHERE CPF_PESSOAS = $cpf";
			$consulta_cpf = $conexao_bd->query($selecao_cpf);
			if($consulta_cpf->num_rows == 0){
				$cpf = $_POST['cpf'];
			} else {
				unset($cpf);
				$_SESSION['msg_perfil_1'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>CPF já está em uso.</div>";
				header('Location: ../perfil.php?page=4');
			}
		}
		
		if(empty($_POST['rg']) || $_POST['rg'] == $pessoa['RG_PESSOAS']){
			$rg = $pessoa['RG_PESSOAS'];
		} else {
			$selecao_rg = "SELECT * FROM pessoas WHERE RG_PESSOAS = $rg";
			$consulta_rg = $conexao_bd->query($selecao_rg);
			if($consulta_rg->num_rows == 0){
				$rg = $_POST['rg'];
			} else {
				unset($rg);
				$_SESSION['msg_perfil_1'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>RG já está em uso.</div>";
				header('Location: ../perfil.php?page=4');
			}
		}
		if(isset($rg) && isset($cpf) && isset($email)){
			$set_funcionario = "UPDATE pessoas SET NOME_PESSOAS = '$nome', EMAIL_PESSOAS = '$email', RG_PESSOAS = '$rg', CPF_PESSOAS = '$cpf' WHERE ID_PESSOAS = '$cod'";
			$update_funcionario = $conexao_bd->query($set_funcionario);
		}
		
		if($update_funcionario == true){
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
		$set_funcionario = "UPDATE pessoas SET SENHA_PESSOAS = '$senha' WHERE ID_PESSOAS = '$cod'";
		$update_funcionario = $conexao_bd->query($set_funcionario);
		
		if($update_funcionario == true){
			session_unset();
			session_destroy();
			header('Location: ../../../index.php');
		} else {
			$_SESSION['msg_perfil_3'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Erro ao alterar os dados.</div>";
			header('Location: ../perfil.php?page=4');
		}
	} else if($function == 3){
		$telefone = $_POST['telefone'];
		$celular = $_POST['celular'];
		if(empty($_POST['celular'])){
			$celular = 'NULL';
		}
		
		$set_funcionario = "UPDATE pessoas SET TELEFONE_PESSOAS = '$telefone', CELULAR_PESSOAS = '$celular' WHERE ID_PESSOAS = '$cod'";
		$update_funcionario = $conexao_bd->query($set_funcionario);
		
		if($update_funcionario == true){
			$_SESSION['msg_perfil_4'] = "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Dados foram alterados com sucesso.</div>";
			header('Location: ../perfil.php?page=4');
		} else {
			$_SESSION['msg_perfil_4'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Erro ao alterar os dados.</div>";
			header('Location: ../perfil.php?page=4');
		}
	} else if($function == 4){
		$cep = $_POST['cep'];
		
		$set_funcionario = "UPDATE pessoas SET CEP_PESSOAS = '$cep' WHERE ID_PESSOAS = '$cod'";
		$update_funcionario = $conexao_bd->query($set_funcionario);
		
		if($update_funcionario == true){
			$_SESSION['msg_perfil_5'] = "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>CEP alterado com sucesso.</div>";
			header('Location: ../perfil.php?page=4');
		} else {
			$_SESSION['msg_perfil_5'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Erro ao alterar os dados.</div>";
			header('Location: ../perfil.php?page=4');
		}
	} else if($function == 5){
		$logo_antiga = "../../../images/0_pessoas/$_SESSION[logo]";
		echo unlink($logo_antiga);
		
		if(isset($_FILES['arquivo'])){
			$extensao = strtolower(substr($_FILES['arquivo']['name'], -4));
			$novo_nome = md5(time()). $extensao;
			$diretorio = "../../../images/0_pessoas/";
			move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$novo_nome);
			
			$set_funcionario = "UPDATE imagens_empresas_pessoas SET ARQUIVO_IMAGENS = '$novo_nome' WHERE PESSOAS_ID_PESSOAS = '$cod'";
			$update_funcionario = $conexao_bd->query($set_funcionario);
			if($update_funcionario == true){
				$_SESSION['logo'] = $novo_nome;
				$_SESSION['msg_perfil_2'] = "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Imagem de perfil alterada com sucesso.</div>";
				header('Location: ../perfil.php?page=4');
			} else {
				$_SESSION['msg_perfil_2'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Erro ao alterar imagem de perfil.</div>";
			}
		}
	}
?>