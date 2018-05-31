<?php 
	require('banco.php');
		if(empty($_POST['nome'])){
			header('Location: ../registro.php');
		} else {
			$nome = $_POST['nome'];
		}
		
		if(empty($_POST['email'])){
			header('Location: ../registro.php');
		} else {
			$tmp_email = $_POST['email']; //Variavel temporaria
			$c_email = "SELECT * FROM empresas where emailE = '$tmp_email'";
			$v_email =  $conecta_banco->query($c_email);
			if($v_email->num_rows == 0){ //Verificar se email já existe no banco
				$email = $_POST['email'];
			} else {
				header('Location: ../registro.php');
			}
		}
		
		if(empty($_POST['cnpj'])){
			header('Location: ../registro.php');
		} else {
			$tmp_cnpj = $_POST['cnpj'];
			$c_cnpj = "SELECT * FROM empresas where cnpjE = '$tmp_cnpj'";
			$v_cnpj =  $conecta_banco->query($c_cnpj);
			if($v_cnpj->num_rows == 0){ //Verificar se cnpj já existe no banco
				$cnpj = $_POST['cnpj'];
			} else {
				header('Location: ../registro.php');
			}
		}
		
		if(empty($_POST['cep'])){
			header('Location: ../registro.php');
		} else {
			$cep = $_POST['cep'];
		}
		
		if(empty($_POST['telefone'])){
			header('Location: ../registro.php');
		} else {
			$telefone = $_POST['telefone'];
		}
		
		if(empty($_POST['password'])){
			header('Location: ../registro.php');
		} else {
			$senha = hash("sha256", hash("sha256", $_POST['password'])); //Senha é criptografada duas vezes para ser inserida no banco.
		}
		
	
	
	
	if(isset($nome) && isset($email) && isset($cnpj) && isset($cep) && isset($telefone) && isset($senha)){
		$d_empresa = "INSERT INTO empresas (nomeE, emailE, cnpjE, cepE, telefoneE, senhaE, perfilE) 
		VALUES ('$nome', '$email', '$cnpj', '$cep', '$telefone', '$senha', '2')";
		$ins_empresa = $conecta_banco->query($d_empresa);
		
		if(isset($_FILES['arquivo'])){
			$extensao = strtolower(substr($_FILES['arquivo']['name'], -4));
			$novo_nome = md5(time()). $extensao;
			$diretorio = "../uploads/";
			move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$novo_nome);
			$c_empresas = "SELECT * FROM empresas where emailE = '$email'";
			$v_id =  $conecta_banco->query($c_empresas);
			$coluna_empresas = mysqli_fetch_array($v_id);
			echo $idE = $coluna_empresas['idE'];
			$d_logo = "INSERT INTO imagensperfil (idI, arquivoI, empresaI, dataI) 
			VALUES (null, '$novo_nome', '$idE', NOW())";
			$ins_logo = $conecta_banco->query($d_logo);
		}
		//Limpar variaveis temporarias
		unset($tmp_email);
		unset($tmp_cnpj);
		header('Location: ../login.php');
	}
?>