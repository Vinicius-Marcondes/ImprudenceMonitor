<div class="topbar">
	<div class="topbar-left">
		<div class="text-center"><a href="index.php" class="logo"><i class="md md-directions-car" style="color: white;"></i> <span>MDI </span></a></div>
	</div>
	<div class="navbar navbar-default" role="navigation">
		<div class="container">
			<div class="">
                <div class="pull-left">
                    <button class="button-menu-mobile open-left"><i class="fa fa-bars"></i></button>
                    <span class="clearfix"></span>
                </div>
                <ul class="nav navbar-nav navbar-right pull-right">
                    <li class="dropdown">
                        <a href="" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true"><img src="../../images/1_empresas/<?php echo $_SESSION['logo']; ?>" alt="user-img" class="img-circle"> </a>
                        <ul class="dropdown-menu">
                            <li><a href="perfil.php?page=1"><i class="md md-face-unlock"></i> Perfil</a></li>
                            <li><a href="perfil.php?page=4"><i class="md md-settings"></i> Configurações</a></li>
                            <li><a href="lock_screen.php"><i class="md md-lock"></i> Bloquear Tela</a></li>
                            <li><a href="?desconectar=true.php"><i class="md md-settings-power"></i> Desconectar</a></li>
                        </ul>
                    </li>
				</ul>
			</div>
        </div>
    </div>
</div>
<div class="left side-menu">
	<div class="sidebar-inner slimscrollleft">
		<div class="user-details">
			<div class="pull-left"><img src="../../images/1_empresas/<?php echo $_SESSION['logo']; ?>" alt="" class="thumb-md img-circle"></div>
            <div class="user-info">
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><?php echo $_SESSION['nome']; ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="perfil.php?page=1"><i class="md md-face-unlock"></i> Perfil</a></li>
						<li><a href="perfil.php?page=4"><i class="md md-settings"></i> Configurações</a></li>
                        <li><a href="lock_screen.php"><i class="md md-lock"></i> Bloquear Tela</a></li>
                        <li><a href="?desconectar=true.php"><i class="md md-settings-power"></i> Desconectar</a></li>
                     </ul>
                </div>
                <p class="text-muted m-0"><?php echo $_SESSION['funcao']; ?></p>
            </div>
		</div>
		<div id="sidebar-menu">
            <ul>
                <li><a href="index.php" class="waves-effect"><i class="md md-home"></i><span> Dashboard </span></a></li>
				<?php
					$nome_arquivo = basename($_SERVER['PHP_SELF'],'.php');
					if($nome_arquivo == 'perfil'){
						$active = true;
					}
				?>
                <li class="has_sub">
					<a href="#" class="waves-effect <?php if(isset($active)){ echo "active"; unset($active); } ?>"><i class="md md-account-circle"></i><span> Conta </span><span class="pull-right"><i class="md md-add"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="perfil.php?page=1">Sobre</a></li>
                        <li><a href="perfil.php?page=2">Notificações</a></li>
                        <li><a href="perfil.php?page=4">Configurações</a></li>
                    </ul>
                </li>
				<?php
					if($nome_arquivo == 'veiculosempresa'){
  						$active1 = true;
					} else if($nome_arquivo == 'equipamentosempresa'){
						$active2 = true;
					} else if ($nome_arquivo == 'funcionarios'){
                        $active3 = true;
                    }
				?>
				<li class="has_sub">
					<a href="#" class="waves-effect <?php if(isset($active1) || isset($active2) || isset($active3)){ echo "active"; } ?>"><i class="md md-business"></i><span> Empresa </span><span class="pull-right"><i class="md md-add"></i></span></a>
                    <ul class="list-unstyled">
                        <li class="<?php if(isset($active3)){ echo "active"; unset($active3); } ?>"><a href="funcionarios.php">Funcionários</a></li>
                        <li class="<?php if(isset($active1)){ echo "active"; unset($active1); } ?>"><a href="veiculosempresa.php">Veículos</a></li>
                        <li class="<?php if(isset($active2)){ echo "active"; unset($active2); } ?>"><a href="equipamentosempresa.php">Equipamentos</a></li>
                    </ul>
                </li>
			</ul>
			<?php
                require_once('../conexao_banco.php'); 
            ?>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>									