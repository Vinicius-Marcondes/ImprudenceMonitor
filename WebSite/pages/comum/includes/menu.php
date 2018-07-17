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
                    <li class="dropdown hidden-xs">
                        <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true"><i class="md md-notifications"></i> <span class="badge badge-xs badge-danger">3</span></a>
                        <ul class="dropdown-menu dropdown-menu-lg">
							<li class="text-center notifi-title">Notificações</li>
                            <li class="list-group">
                                <a href="javascript:void(0);" class="list-group-item">
                                    <div class="media">
                                        <div class="pull-left"><em class="fa fa-user-plus fa-2x text-info"></em></div>
                                        <div class="media-body clearfix">
                                            <div class="media-heading">New user registered</div>
                                            <p class="m-0"><small>You have 10 unread messages</small></p>
                                        </div>
                                    </div>
                                </a>
								<a href="javascript:void(0);" class="list-group-item">
                                    <div class="media">
										<div class="pull-left"><em class="fa fa-diamond fa-2x text-primary"></em></div>
                                        <div class="media-body clearfix">
											<div class="media-heading">New settings</div><p class="m-0"><small>There are new settings available</small></p>
                                        </div>
                                    </div>
								</a>
								<a href="javascript:void(0);" class="list-group-item">
									<div class="media">
										<div class="pull-left"><em class="fa fa-bell-o fa-2x text-danger"></em></div>
										<div class="media-body clearfix">
											<div class="media-heading">Updates</div>
											<p class="m-0"><small>There are<span class="text-primary">2</span> new updates available</small></p>
										</div>
									</div>
								</a>
								<a href="javascript:void(0);" class="list-group-item"><small>Visualizar todas as notificações</small></a>
							</li>
						</ul>
                    </li>
                    <li class="dropdown">
                        <a href="" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true"><img src="../../images/0_pessoas/<?php echo $_SESSION['logo']; ?>" alt="user-img" class="img-circle"> </a>
                        <ul class="dropdown-menu">
                            <li><a href="perfil.php?page=1"><i class="md md-face-unlock"></i> Perfil</a></li>
                            <li><a href="perfil.php?page=4"><i class="md md-settings"></i> Configurações</a></li>
                            <li><a href="lock_screen.php"><i class="md md-lock"></i> Bloquear Tela</a></li>
                            <li><a href="../sair_sistema.php"><i class="md md-settings-power"></i> Desconectar</a></li>
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
			<div class="pull-left"><img src="../../images/0_pessoas/<?php echo $_SESSION['logo']; ?>" alt="" class="thumb-md img-circle"></div>
            <div class="user-info">
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><?php echo $_SESSION['nome']; ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="perfil.php?page=1"><i class="md md-face-unlock"></i> Perfil</a></li>
						<li><a href="perfil.php?page=4"><i class="md md-settings"></i> Configurações</a></li>
                        <li><a href="lock_screen.php"><i class="md md-lock"></i> Bloquear Tela</a></li>
                        <li><a href="../sair_sistema.php"><i class="md md-settings-power"></i> Desconectar</a></li>
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
                        <li><a href="perfil.php?page=2">Atividades</a></li>
                        <li><a href="perfil.php?page=3">Empresa</a></li>
                        <li><a href="perfil.php?page=4">Configurações</a></li>
                    </ul>
                </li>
				<?php
					if($nome_arquivo == 'veiculospessoais'){
  						$active1 = true;
					} else if($nome_arquivo == 'equipamentospessoais'){
						$active2 = true;
					}
				?>
				<li class="has_sub">
					<a href="#" class="waves-effect <?php if(isset($active1) || isset($active2)){ echo "active"; } ?>"><i class="md md-drive-eta"></i><span> Veículos </span><span class="pull-right"><i class="md md-add"></i></span></a>
                    <ul class="list-unstyled">
                        <li class="<?php if(isset($active1)){ echo "active"; unset($active1); } ?>"><a href="veiculospessoais.php">Veículos pessoais</a></li>
                        <li class="<?php if(isset($active2)){ echo "active"; unset($active2); } ?>"><a href="equipamentospessoais.php">Equipamentos pessoais</a></li>
                    </ul>
                </li>
				<?php
					if($nome_arquivo == 'imprudencias'){
						$active = true;
					}
				?>
				<li><a href="imprudencias.php" class="waves-effect <?php if(isset($active)){ echo "active"; unset($active); } ?>"><i class="md md-info"></i><span> Imprudências </span></a></li>
			</ul>
			<?php require('../conexao_banco.php'); ?>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>