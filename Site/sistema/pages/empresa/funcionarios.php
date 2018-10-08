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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-body">
										<div class="row">
											<?php if(isset($_SESSION['msg_funcionarios'])){ echo $_SESSION['msg_funcionarios']; unset($_SESSION['msg_funcionarios']); } ?>
											<div class="col-sm-6">
                                                <div class="m-b-30">
                                                    <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#adicionar_funcionario">Adicionar <i class="fa fa-plus"></i></button>
                                                    <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#con-close-modal">Vincular <i class="fa fa-plus"></i></button>
                                                </div>
                                            </div>
										</div>
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
												<?php 
													$selecao_funcionarios = "SELECT * FROM pessoas INNER JOIN perfil ON pessoas.PERFIL_ID_PESSOAS = perfil.ID_PERFIL WHERE EMPRESA_ID_PESSOAS = $_SESSION[id]";
													$consulta_funcionarios = $conexao_bd->query($selecao_funcionarios);
													if($consulta_funcionarios->num_rows > 0){
												?>
                                                <table id="datatable" class="table table-small-font table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Nome</th>
                                                            <th>Email</th>
                                                            <th>RG</th>
                                                            <th>CPF</th>
                                                            <th>Telefone</th>
                                                            <th>CEP</th>
                                                            <th>Função</th>
                                                            <th>Opções</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
														<?php while($funcionario = mysqli_fetch_assoc($consulta_funcionarios)){ ?>
                                                        <tr>
                                                        	<td><?php echo $funcionario['ID_PESSOAS']; ?></td> 
                                                            <td><?php echo $funcionario['NOME_PESSOAS']; ?></td> 
                                                            <td><?php echo $funcionario['EMAIL_PESSOAS']; ?></td>  
                                                            <td><?php echo $funcionario['RG_PESSOAS']; ?></td>  
                                                            <td><?php echo $funcionario['CPF_PESSOAS']; ?></td>  
                                                            <td><?php echo $funcionario['TELEFONE_PESSOAS']; ?></td>                                                            
															<td><?php echo $funcionario['CEP_PESSOAS']; ?></td>     
															<td><?php echo $funcionario['NOME_PERFIL']; ?></td>                
                                                            <td class="actions">
																<a href="consultar_funcionario.php?id=<?php echo $funcionario['ID_PESSOAS']; ?>"><i class="fa fa-binoculars"></i></a>
																<a href="editar_funcionario.php?id=<?php echo $funcionario['ID_PESSOAS']; ?>"><i class="fa fa-pencil"></i></a>
																<a href="processos/remover_funcionario.php?id=<?php echo $funcionario['ID_PESSOAS']; ?>"><i class="fa fa-trash-o"></i></a>
															</td>
                                                        </tr>
														<?php } ?>
                                                    </tbody>
                                                </table>
												<?php } else { echo "Não consta nenhum funcionário."; }?>
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
		<?php include_once('funcionarios_modal.php'); include_once('includes/scripts_ok.php'); include_once('funcionarios_modal2.php'); 
        if(@$_POST) {
                // Pegando dados fornecidos
                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $cpf = $_POST['cpf'];
                $rg = $_POST['rg'];
                $cep = $_POST['cep'];
                $sexo = $_POST['sexo'];
                $telefone = $_POST['telefone'];
                $celular = $_POST['celular'];
                $senha = $_POST['senha'];
                $funcao = 4;
                $empresa = $_SESSION['id'];

                $usuario = new User;
                $usuario->registerPerson($conexao_bd, $nome, $email, $cpf, $rg, $cep, $sexo, $telefone, $celular, $senha, $funcao, $empresa);
            }
        ?>
	</body>
</html>