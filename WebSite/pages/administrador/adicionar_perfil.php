<!DOCTYPE html>
<html>
  <head>
    <title>FUNÇÕES | MDI</title>
	<?php session_start(); include_once("../verifica_sessao.php"); include_once("links.php"); ?>
  </head>
  <body class="theme-light-blue">
    <?php include_once("../loader.php"); include_once("menu.php");?>
    <section class="content">
      <div class="container-fluid">
        <div class="block-header">
          <h2>FUNÇÕES</h2>
        </div>
        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
              <div class="header">
                <h2>ADICIONAR FUNÇÃO</h2>
              </div>
              <div class="body">
                <?php 
				if(isset($_SESSION['mensagem_perfil'])){
					echo $_SESSION['mensagem_perfil'];
					unset($_SESSION['mensagem_perfil']);
				}
				?>
                <form id="form_validation" method="POST" action="processos/registro_perfil.php">
                  <div class="form-group form-float">
                    <div class="form-line">
                      <input type="text" class="form-control" name="nome" maxlength="100" required>
                      <label class="form-label">Nome da função</label>
                    </div>
                    <div class="help-info">Ex: Administrador</div>
                  </div>
                  <button type="submit" class="btn bg-orange waves-effect"><i class="material-icons">save</i><span>ADICIONAR</span></button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php include_once("scripts.php"); ?>
  </body>
</html>
