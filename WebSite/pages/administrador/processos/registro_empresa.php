<?php 
	require('../../banco.php');
	session_start();
	
	$nome = $_POST['nome'];
	$cep = $_POST['cep'];
	$telefone = $_POST['telefone'];
	$senha = hash("sha256", hash("sha256", $_POST['password']));
		
	$tmp_email = $_POST['email']; 
	$c_email = "SELECT * FROM empresas where emailE = '$tmp_email'";
	$v_email =  $conecta_banco->query($c_email);
	if($v_email->num_rows == 0){ 
		$email = $_POST['email'];
	} else {
		$_SESSION['mensagem_perfil'] = "<div class='alert alert-warning'><strong>Atenção!</strong> Este email já está em uso.</div>";
		header('Location: ../adicionar_empresas.php');
	}
		
	$tmp_cnpj = $_POST['cnpj'];
	$c_cnpj = "SELECT * FROM empresas where cnpjE = '$tmp_cnpj'";
	$v_cnpj =  $conecta_banco->query($c_cnpj);
	if($v_cnpj->num_rows == 0){ 
		$cnpj = $_POST['cnpj'];
	} else {
		$_SESSION['mensagem_perfil'] = "<div class='alert alert-warning'><strong>Atenção!</strong> Este cnpj já está em uso.</div>";
		header('Location: ../adicionar_empresas.php');
	}
		
	if(isset($email) && isset($cnpj)){
		$d_empresa = "INSERT INTO empresas (nomeE, emailE, cnpjE, cepE, telefoneE, senhaE, perfilE) 
		VALUES ('$nome', '$email', '$cnpj', '$cep', '$telefone', '$senha', '2')";
		$ins_empresa = $conecta_banco->query($d_empresa);
		
		if(isset($_FILES['arquivo'])){
			$extensao = strtolower(substr($_FILES['arquivo']['name'], -4));
			$novo_nome = md5(time()). $extensao;
			$diretorio = "../../../uploads/";
			move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$novo_nome);
			$c_empresas = "SELECT * FROM empresas where emailE = '$email'";
			$v_id =  $conecta_banco->query($c_empresas);
			$coluna_empresas = mysqli_fetch_array($v_id);
			echo $idE = $coluna_empresas['idE'];
			$d_logo = "INSERT INTO imagensperfil (idI, arquivoI, empresaI, dataI) 
			VALUES (null, '$novo_nome', '$idE', NOW())";
			$ins_logo = $conecta_banco->query($d_logo);
		}
		
		if($ins_empresa == true){
			$_SESSION['mensagem_perfil'] = "<div class='alert alert-success'><strong>Sucesso!</strong> Empresa adicionada ao banco.</div>";
			header('Location: ../adicionar_empresas.php');
		} else {
			$_SESSION['mensagem_perfil'] = "<div class='alert alert-danger'><strong>Erro!</strong> Por favor tente novamente em alguns instantes.</div>";
			header('Location: ../adicionar_empresas.php');
		}
	}
?>