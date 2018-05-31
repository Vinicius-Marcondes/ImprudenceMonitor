<div class="overlay"></div>
<nav class="navbar">
  <div class="container-fluid">
    <div class="navbar-header">
      <a href="javascript:void(0);" class="bars"></a>
      <a class="navbar-brand" href="index.php">MONITOR DE IMPRUDÊNCIA</a>
    </div>
  </div>
</nav>
<section>
  <aside id="leftsidebar" class="sidebar">
    <div class="user-info" style="background-color: #fdfdfd; background-image: none;">
      <div>
        <img src="../../uploads/<?php echo $_SESSION['logo']; ?>" height="30" style="max-width: 130px;" alt="User" />
      </div>
      <div class="info-container">
        <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: black"><?php echo $_SESSION['nome']; ?></div>
        <div class="email" style="color: black"><?php echo $_SESSION['email']; ?></div>
        <div class="btn-group user-helper-dropdown">
          <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="color: black">keyboard_arrow_down</i>
          <ul class="dropdown-menu pull-right">
            <li><a href="profile.html"><i class="material-icons">person</i>Perfil</a></li>
            <li role="seperator" class="divider"></li>
            <li><a href="../sair.php"><i class="material-icons">input</i>Desconectar</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="menu">
      <ul class="list">
        <li class="header">MENU</li>
        <?php
        $nome_arquivo = basename($_SERVER['PHP_SELF'],'.php');
				if($nome_arquivo == 'index'){
						$active = 'active';
				}
        ?>
        <li <?php if(isset($active)){ echo "class='$active'"; } ?>>
          <a href="index.php">
            <i class="material-icons">home</i>
            <span>Home</span>
          </a>
        </li>
        <?php
				if($nome_arquivo == 'adicionar_perfil' || $nome_arquivo == 'listagem_perfil'){
						$active = 'active';
				} else {
						unset($active);
				}
        ?>
        <li <?php if(isset($active)){ echo "class='$active'"; } ?>>
          <a href="javascript:void(0);" class="menu-toggle">
            <i class="material-icons">mode_edit</i>
            <span>Funções</span>
          </a>
          <?php
  				if($nome_arquivo == 'adicionar_perfil'){
  						$active1 = 'active';
  				} else if($nome_arquivo == 'listagem_perfil'){
  					  $active2 = 'active';
  				} else {
              unset($active1);
              unset($active2);
          }
          ?>
          <ul class="ml-menu">
            <li <?php if(isset($active1)){ echo "class='$active1'"; } ?>>
              <a href="adicionar_perfil.php">Adicionar função</a>
            </li>
            <li <?php if(isset($active2)){ echo "class='$active2'"; } ?>>
              <a href="listagem_perfil.php">Listagem</a>
            </li>
          </ul>
        </li>
        <?php
				if($nome_arquivo == 'adicionar_empresas' || $nome_arquivo == 'listagem_empresas'){
						$active = 'active';
				} else {
						unset($active);
				}
        ?>
        <li <?php if(isset($active)){ echo "class='$active'"; } ?>>
          <a href="javascript:void(0);" class="menu-toggle">
            <i class="material-icons">business</i>
            <span>Empresas</span>
          </a>
          <?php
  				if($nome_arquivo == 'adicionar_empresas'){
  						$active1 = 'active';
  				} else if($nome_arquivo == 'listagem_empresas'){
  					  $active2 = 'active';
  				} else {
              unset($active1);
              unset($active2);
          }
          ?>
          <ul class="ml-menu">
            <li <?php if(isset($active1)){ echo "class='$active1'"; } ?>>
              <a href="adicionar_empresas.php">Adicionar empresa</a>
            </li>
            <li <?php if(isset($active2)){ echo "class='$active2'"; } ?>>
              <a href="listagem_empresas.php">Listagem</a>
            </li>
          </ul>
        </li>
        <?php
				if($nome_arquivo == 'adicionar_administrador' || $nome_arquivo == 'listagem_funcionarios'){
						$active = 'active';
				} else {
						unset($active);
				}
        ?>
        <li <?php if(isset($active)){ echo "class='$active'"; } ?>>
          <a href="javascript:void(0);" class="menu-toggle">
            <i class="material-icons">people</i>
            <span>Funcionários</span>
          </a>
          <?php
  				if($nome_arquivo == 'adicionar_administrador'){
  						$active1 = 'active';
  				} else if($nome_arquivo == 'listagem_funcionarios'){
  					  $active2 = 'active';
  				} else {
              unset($active1);
              unset($active2);
          }
          ?>
          <ul class="ml-menu">
            <li <?php if(isset($active1)){ echo "class='$active1'"; } ?>>
              <a href="adicionar_administrador.php">Adicionar administrador</a>
            </li>
            <li <?php if(isset($active2)){ echo "class='$active2'"; } ?>>
              <a href="listagem_funcionarios.php">Listagem</a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
    <div class="legal">
      <div class="copyright">
        &copy; 2018 <a href="javascript:void(0);">Monitor de Imprudência</a>.
      </div>
      <div class="version">
        <b>Versão: </b> 1.0
      </div>
    </div>
  </aside>
</section>﻿
