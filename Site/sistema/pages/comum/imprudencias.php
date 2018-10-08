<!DOCTYPE html>
<html>
    <head>
		<?php session_start(); include_once('includes/header.php'); ?>
        <title>MDI - IMPRUDÊNCIAS</title> 
    </head>
    <body class="fixed-left">
        <div id="wrapper">
			<?php include_once('includes/menu.php'); ?>             
            <div class="content-page">
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="pull-left page-title">Imprudências</h4>
                                <ol class="breadcrumb pull-right">
                                    <li><a href="index.php">MDI</a></li>
                                    <li>Imprudências</li>
                                </ol>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="row">
											<?php 
												$selecao_imprudencias = "SELECT * FROM imprudencias WHERE PESSOAS_ID_IMPRUDENCIAS = $_SESSION[id]";
												$consulta_imprudencias = $conexao_bd->query($selecao_imprudencias);
												if($consulta_imprudencias->num_rows > 0){
											?>
                                            <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
                                                <table id="datatable" class="table table-small-font table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 5%;">#</th>
                                                            <th>X</th>
                                                            <th>Y</th>
                                                            <th style="width: 15%;">Data do ocorrido</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
														<?php while($imprudencias = mysqli_fetch_assoc($consulta_imprudencias)){ ?>
                                                        <tr>
                                                            <td><?php echo $imprudencias['ID_IMPRUDENCIAS']; ?></td>
                                                            <td><?php echo $imprudencias['X_IMPRUDENCIAS']; ?></td>
                                                            <td><?php echo $imprudencias['Y_IMPRUDENCIAS']; ?></td>
                                                            <td><?php echo $imprudencias['DATA_IMPRUDENCIAS']; ?></td>
                                                        </tr>
														<?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
											<?php } else { echo "<div class='col-md-12 col-sm-12 col-xs-12'> Não consta imprudência.</div>"; } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>          
                        </div>
                    </div> 
                </div>
            </div>
        </div>
		<?php include_once('includes/scripts_ok.php'); ?>
	</body>
</html>