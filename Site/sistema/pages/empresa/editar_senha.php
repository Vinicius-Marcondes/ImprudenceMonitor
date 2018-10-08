<?php 
	session_start();
	require('../conexao_banco.php'); 
	$senha = $conexao_bd->real_escape_string($_POST['senha_antiga']); 
	$senha = hash("sha256", hash("sha256", $senha));
	$selecao_empresa = "SELECT * FROM empresa WHERE ID_EMPRESA = $_SESSION[id] AND SENHA_EMPRESA = '$senha'";
	$consulta_empresa = $conexao_bd->query($selecao_empresa);
	if($consulta_empresa->num_rows != 1){
		$_SESSION['msg_perfil_3'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>A senha digitada está diferente da senha cadastrada.</div>";
		header('Location: perfil.php?page=4');
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="../../images/favicon_1.ico">

        <title>MDI - ALTERAR SENHA</title>

        <!-- Base Css Files -->
        <link href="../../css/bootstrap.min.css" rel="stylesheet" />

        <!-- Font Icons -->
        <link href="../../assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
        <link href="../../assets/ionicon/css/ionicons.min.css" rel="stylesheet" />
        <link href="../../css/material-design-iconic-font.min.css" rel="stylesheet">

        <!-- animate css -->
        <link href="../../css/animate.css" rel="stylesheet" />

        <!-- Waves-effect -->
        <link href="../../css/waves-effect.css" rel="stylesheet">

        <!-- Custom Files -->
        <link href="../../css/helper.css" rel="stylesheet" type="text/css" />
        <link href="../../css/style.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="../../js/modernizr.min.js"></script>
        
    </head>
    <body>
        <div class="wrapper-page">
            <div class="panel panel-color panel-primary panel-pages">

                <div class="panel-heading bg-img"> 
                    <div class="bg-overlay"></div>
                    <h3 class="text-center m-t-10 text-white"> Alterar senha </h3>
                </div> 
                <div class="panel-body">
                 <form method="post" action="processos/editar_empresa.php" role="form" class="text-center"> 
                    <!--<div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Enter your <b>Email</b> and instructions will be sent to you!
                    </div>-->
                    <div class="form-group m-b-0"> 
                        <div class="input-group"> 
                            <input type="password" class="form-control input-lg" placeholder="*************" pattern=".{6,12}" title="6 até 12 caracteres" name="senha" required> 
                            <span class="input-group-btn"> <button type="submit" class="btn btn-lg btn-primary waves-effect waves-light" name="btn" value="2">Alterar</button> </span> 
                        </div> 
                    </div> 
                    
                </form>
                </div>                                 
            </div>
        </div>
    	<script>
            var resizefunc = [];
        </script>
        <script src="../../js/jquery.min.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
        <script src="../../js/waves.js"></script>
        <script src="../../js/wow.min.js"></script>
        <script src="../../js/jquery.nicescroll.js" type="text/javascript"></script>
        <script src="../../js/jquery.scrollTo.min.js"></script>
        <script src="../../assets/jquery-detectmobile/detect.js"></script>
        <script src="../../assets/fastclick/fastclick.js"></script>
        <script src="../../assets/jquery-slimscroll/jquery.slimscroll.js"></script>
        <script src="../../assets/jquery-blockui/jquery.blockUI.js"></script>
        <!-- CUSTOM JS -->
        <script src="../../js/jquery.app.js"></script>
	</body>
</html>