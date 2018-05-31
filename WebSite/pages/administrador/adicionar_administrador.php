<!DOCTYPE html>
<html>
  <head>
    <title>FUNCIONÁRIOS | MDI</title>
	<?php session_start(); include_once("../verifica_sessao.php"); include_once("links.php"); ?>
  </head>
  <body class="theme-light-blue">
    <?php include_once("../loader.php"); include_once("menu.php"); ?>
    <section class="content">
      <div class="container-fluid">
        <div class="block-header">
          <h2>FUNCIONÁRIOS</h2>
        </div>
        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
              <div class="header">
                <h2>ADICIONAR ADMINISTRADOR</h2>
              </div>
              <div class="body">
                <div class="alert alert-success"><strong>Well Done!</strong> You successfully read this important alert message.</div>
                <div class="alert alert-warning"><strong>Warning!</strong> Better check yourself, you're not looking too good.</div>
                <div class="alert alert-danger"><strong>Oh snap!</strong> Change a few things up and try submitting again.</div>
                <form id="form_validation" method="POST">
                  <div class="form-group form-float">
                    <div class="form-line">
                      <input type="text" class="form-control" name="nome"  maxlength="100" autofocus required>
                      <label class="form-label">Nome</label>
                    </div>
                    <div class="help-info">Ex: José Matheus</div>
                  </div>
                  <div class="form-group form-float">
                    <div class="form-line">
                      <input type="email" class="form-control" name="email" maxlength="100" required>
                      <label class="form-label">Email</label>
                    </div>
                    <div class="help-info">Ex: josématheus@outlook.com</div>
                  </div>
                  <div class="form-group form-float">
                    <div class="form-line">
                      <input type="password" class="form-control" name="password"  minlength="6" maxlength="12" required>
                      <label class="form-label">Senha</label>
                    </div>
                    <div class="help-info">Min.: 6, Max.: 12</div>
                  </div>
                  <div class="form-group form-float">
                    <div class="form-line">
                      <input type="text" class="form-control" name="rg" minlength="9" maxlength="9" required>
                      <label class="form-label">RG</label>
                    </div>
                    <div class="help-info">Ex: 11.030.859-0</div>
                  </div>
                  <div class="form-group form-float">
                    <div class="form-line">
                      <input type="text" class="form-control" name="cpf" minlength="11" maxlength="11" required>
                      <label class="form-label">CPF</label>
                    </div>
                    <div class="help-info">Ex: 003.400.910-53</div>
                  </div>
                  <div class="form-group form-float">
                    <div class="form-line">
                      <input type="text" class="form-control" name="telefone" minlength="10" maxlength="11" required>
                      <label class="form-label">Telefone</label>
                    </div>
                    <div class="help-info">Ex: 41 9 9595-8091</div>
                  </div>
                  <div class="form-group form-float">
                    <div class="form-line">
                      <input type="text" class="form-control" name="cep" minlength="8" maxlength="8" required>
                      <label class="form-label">CEP</label>
                    </div>
                    <div class="help-info">Ex: 81730-280</div>
                  </div>
                  <div class="form-group">
                    <input type="radio" name="gender" id="male" class="with-gap">
                    <label for="male">Masculino</label>
                    <input type="radio" name="gender" id="female" class="with-gap">
                    <label for="female" class="m-l-20">Feminino</label>
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
