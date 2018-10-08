<!DOCTYPE html>
<html>
    <head>
		<?php session_start(); include_once('includes/header.php'); ?>
        <title>MDI - FUNCIONÁRIOS</title> 
    </head>
    <body class="fixed-left">
        <div id="wrapper">
			<?php include_once('includes/menu.php'); ?>             
            <div class="content-page">
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="pull-left page-title">Funcionários</h4>
                                <ol class="breadcrumb pull-right">
                                    <li><a href="index.php">MDI</a></li>
                                    <li><a class="active">Empresa</a></li>
                                    <li>Funcionários</li>
                                </ol>
                            </div>
                        </div>
						<div class="panel panel-border panel-primary">
							<?php 
								$id = $_GET['id'];
								$selecao_pessoa = "SELECT * FROM pessoas INNER JOIN perfil ON pessoas.PERFIL_ID_PESSOAS = perfil.ID_PERFIL WHERE ID_PESSOAS = $id AND EMPRESA_ID_PESSOAS = $_SESSION[empresa]";
								$consulta_pessoa = $conexao_bd->query($selecao_pessoa);
								$pessoa = mysqli_fetch_assoc($consulta_pessoa);
							?>
                            <div class="panel-heading"> 
                                <h3 class="panel-title">Alterar função do funcionário <?php echo "'".$pessoa['NOME_PESSOAS']."'"; ?></h3> 
                            </div> 
                            <div class="panel-body"> 
								<?php if(isset($_SESSION['msg_edit_funcionarios'])){ echo $_SESSION['msg_edit_funcionarios']; unset($_SESSION['msg_edit_funcionarios']); } if($pessoa['EMPRESA_ID_PESSOAS'] == $_SESSION['empresa']){ ?>
                                <form role="form" method="post" action="processos/editar_funcao.php">
                                    
                                    <select name="funcao" required>
                                        <?php 
                                            $selecao_perfil = "SELECT * FROM perfil WHERE ID_PERFIL = $pessoa[PERFIL_ID_PESSOAS]";
                                            $consulta_perfil = $conexao_bd->query($selecao_perfil);
                                            while($perfil = mysqli_fetch_assoc($consulta_perfil)){
                                        ?>
                                        <option value="<?php echo $perfil['ID_PERFIL']; ?>"><?php echo $perfil['NOME_PERFIL']; ?></option>
                                        <?php } ?>
                                        <?php 
                                            $selecao_perfil = "SELECT * FROM perfil WHERE ID_PERFIL != 1 AND ID_PERFIL != 2 AND ID_PERFIL != $pessoa[PERFIL_ID_PESSOAS]";
                                            $consulta_perfil = $conexao_bd->query($selecao_perfil);
                                            while($perfil = mysqli_fetch_assoc($consulta_perfil)){
                                        ?>
                                        <option value="<?php echo $perfil['ID_PERFIL']; ?>"><?php echo $perfil['NOME_PERFIL']; ?></option>
                                        <?php } ?>
                                    </select>

									<div class="row" style="margin-top: 30px;">
									   <div class="col-lg-11 col-md-9 col-sm-9 col-xs-5"><a href="funcionarios.php">Voltar</a></div>
									   <div class="col-lg-1 col-md-3 col-sm-3 col-xs-7"><button class="btn btn-primary waves-effect waves-light w-md" type="submit" name="btn" value="<?php echo $id; ?>">Salvar</button></div>
                                    </div>
                                </form>
								<?php } else { echo "Acesso Restrito. <a href='funcionarios.php'>Voltar</a>"; } ?>
                            </div> 
						</div>
                    </div> 
                </div>
            </div>
        </div>
		<?php include_once('includes/scripts_ok.php'); ?>
	</body>
</html>