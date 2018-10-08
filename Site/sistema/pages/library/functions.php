<?php 
	/* Inicio da classe Usuario */
	class User {

		function logout(){
			session_unset();
			session_destroy();
			return true;
		} // Fim logout

		function verificarSessao(){
			if(isset($_SESSION['lock']) && $_SESSION['lock'] == true){
				header("Location: lock_screen.php");
			} else if(!isset($_SESSION['email']) || !isset($_SESSION['senha'])){
				header("Location: ../../index.php");
			}
			return true;
		}

		function registerPerson($conexao_bd, $nome, $email, $cpf, $rg, $cep, $sexo, $telefone, $celular, $senha, $funcao, $empresa) {
			$senha = $conexao_bd->real_escape_string($senha); 
			$senha = hash("sha256", hash("sha256", $senha));

			// Verrificações
			$selecao_email = "SELECT * FROM pessoas WHERE EMAIL_PESSOAS = '$email'";
			$consulta_email =  $conexao_bd->query($selecao_email);
			if($consulta_email->num_rows != 0){ 
				unset($email);
			} 
		
			$selecao_rg = "SELECT * FROM pessoas WHERE RG_PESSOAS = '$rg'";
			$consulta_rg =  $conexao_bd->query($selecao_rg);
			if($consulta_rg->num_rows != 0){ 
				unset($rg);
			}
		
			$selecao_cpf = "SELECT * FROM pessoas WHERE CPF_PESSOAS = '$cpf'";
			$consulta_cpf =  $conexao_bd->query($selecao_cpf);
			if($consulta_cpf->num_rows != 0){ 
				unset($cpf);
			}

			if(isset($email) && isset($rg) && isset($cpf)){
				$selecao_pessoa = "INSERT INTO pessoas (NOME_PESSOAS, EMAIL_PESSOAS, CPF_PESSOAS, RG_PESSOAS, CEP_PESSOAS, TELEFONE_PESSOAS, CELULAR_PESSOAS, SENHA_PESSOAS, SEXO_PESSOAS, PERFIL_ID_PESSOAS, EMPRESA_ID_PESSOAS) 
				VALUES ('$nome', '$email', '$cpf', '$rg', '$cep', '$telefone', '$celular', '$senha', '$sexo', '$funcao', '$empresa')";
				$add_pessoa = $conexao_bd->query($selecao_pessoa);
				if($add_pessoa == true){
					$extensao = strtolower(substr($_FILES['arquivo']['name'], -4));
					$novo_nome = md5(time()). $extensao;
					$diretorio = "../../images/0_pessoas/";
					move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$novo_nome);
			
					$selecao_pessoa = "SELECT * FROM pessoas WHERE EMAIL_PESSOAS = '$email'";
					$consulta_pessoa = mysqli_fetch_array($conexao_bd->query($selecao_pessoa));
					$id = $consulta_pessoa['ID_PESSOAS'];
			
					$selecao_img = "INSERT INTO imagens_empresas_pessoas (ARQUIVO_IMAGENS, PESSOAS_ID_IMAGENS) 
					VALUES ('$novo_nome', '$id')";
					$add_img = $conexao_bd->query($selecao_img);
					if($add_img == true){
						$_SESSION['msg_funcionarios'] = "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Cadastro efetuado com sucesso.</div>";
					} else {
						$_SESSION['msg_funcionarios'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Erro no cadastro, verifique seus dados e tente novamente!</div>";
					}
				} else {
					$_SESSION['msg_funcionarios'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Erro no cadastro, verifique seus dados e tente novamente!</div>";
				}
			} else {
				$_SESSION['msg_funcionarios'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Erro, já existe um cadastro com esses dados!</div>";
			}
		} // Fim registerPerson

	} /* Final da classe Usuario */
?>