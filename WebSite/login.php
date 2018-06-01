<!DOCTYPE html>
<html>
  <head>
    <title>LOGIN | MDI</title>
    <?php session_start(); include_once('pages/links.php'); ?>
  </head>
  <body class="login-page" style="background-color: #e0e3e5;">
    <div class="login-box">
      <div class="logo">
        <a href="javascript:void(0);" style="color: black;">Monitor de<b> Imprudência</b></a>
      </div>
      <div class="card">
        <div class="body">
          <form id="sign_in" method="POST" action="pages/acessar_sistema.php">
            <div class="msg">Entre para iniciar sua sessão</div>
            <div class="input-group">
              <span class="input-group-addon"><i class="material-icons">person</i></span>
              <div class="form-line"><input type="email" class="form-control" name="email" placeholder="Email" maxlength="100" required autofocus></div>
            </div>
            <div class="input-group">
              <span class="input-group-addon"><i class="material-icons">lock</i></span>
              <div class="form-line"><input type="password" class="form-control" name="password" placeholder="Senha" minlength="6" maxlength="12" required></div>
            </div>
            <div class="row">
              <div class="col-xs-8 p-t-5">
                <input type="checkbox" name="rememberme" id="rememberme" class="chk-col-light-blue"><label for="rememberme">Manter conectado</label>
              </div>
              <div class="col-xs-4">
                <button class="btn btn-block bg-light-blue waves-effect" type="submit">CONECTAR</button>
              </div>
            </div>
            <div class="row m-t-15 m-b--20">
              <div class="col-xs-6"><a href="forgot-password.html">Esqueceu sua senha?</a></div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php include_once('pages/scripts.php'); ?>
  </body>
</html>
