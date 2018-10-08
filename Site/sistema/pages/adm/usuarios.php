<!DOCTYPE html>
<html>
    <head>
		<?php session_start(); include_once('includes/header.php'); ?>
        <title>MDI - USUÁRIOS</title> 
    </head>
    <body class="fixed-left">
        <div id="wrapper">
			<?php include_once('includes/menu.php'); ?>             
            <div class="content-page">
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="pull-left page-title">Usuários</h4>
                                <ol class="breadcrumb pull-right">
                                    <li><a href="index.php">MDI</a></li>
                                    <li>Usuários</li>
                                </ol>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="row">
											<?php if(isset($_SESSION['msg_user'])){ echo $_SESSION['msg_user']; unset($_SESSION['msg_user']); } ?>
										</div>
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
												<?php 
													$selecao_pessoa = "SELECT * FROM pessoas INNER JOIN perfil ON pessoas.PERFIL_ID_PESSOAS = perfil.ID_PERFIL WHERE ID_PESSOAS > 0";
													$consulta_pessoa  = $conexao_bd->query($selecao_pessoa);
													if($consulta_pessoa->num_rows > 0){
												?>
                                                <table id="datatable" class="table table-small-font table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Nome</th>
                                                            <th>Gênero</th>
                                                            <th>Email</th>
                                                            <th>CPF</th>
                                                            <th>RG</th>
                                                            <th>Telefone</th>
                                                            <th>Celular</th>
                                                            <th>CEP</th>
                                                            <th>Função</th>
                                                            <th>Opções</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
														<?php 
                                                            $num = $_SESSION['id'];
                                                            while($pessoa = mysqli_fetch_assoc($consulta_pessoa)){ 
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $pessoa['ID_PESSOAS']; ?></td>
                                                            <td><?php echo $pessoa['NOME_PESSOAS']; ?></td>
                                                            <td><?php echo $pessoa['SEXO_PESSOAS']; ?></td>
                                                            <td><?php echo $pessoa['EMAIL_PESSOAS']; ?></td>
                                                            <td><?php echo $pessoa['CPF_PESSOAS']; ?></td>
                                                            <td><?php echo $pessoa['RG_PESSOAS']; ?></td>
                                                            <td><?php echo $pessoa['TELEFONE_PESSOAS']; ?></td>
                                                            <td><?php if(empty($pessoa['CELULAR_PESSOAS'])) { echo "Indisponivel"; } else { echo $pessoa['CELULAR_PESSOAS']; } ?></td>
                                                            <td><?php echo $pessoa['CEP_PESSOAS']; ?></td>
                                                            <td><?php echo $pessoa['NOME_PERFIL']; ?></td>
                                                            <?php if($pessoa['ID_PESSOAS'] == $num){
                                                                echo "<td style='color:red;'>Bloqueado</td>";
                                                            } else { ?>
                                                                <td class="actions">
                                                                    <a href="editar_usuario.php?id=<?php echo $pessoa['ID_PESSOAS']; ?>"><i class="fa fa-pencil"></i></a>
                                                                </td>
                                                            <?php } ?>
                                                        </tr>
														<?php } ?>
                                                    </tbody>
                                                </table>
												<?php } else { echo "Não consta nenhum usuário cadastrado."; }?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>          
                        </div>
                    </div> 
                </div>
            </div>
        </div>
		<?php include_once('empresas_modal.php'); include_once('includes/scripts_ok.php'); ?>
	</body>
</html>