<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
<meta name="author" content="Coderthemes">
<link rel="icon" href="../../images/favicon_3.ico" type="image/x-icon" />
<!-- Base Css Files -->
<link href="../../css/bootstrap.min.css" rel="stylesheet" />
<!-- Font Icons -->
<link href="../../assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
<link href="../../assets/ionicon/css/ionicons.min.css" rel="stylesheet" />
<link href="../../css/material-design-iconic-font.min.css" rel="stylesheet">
<!-- animate css -->
<link href="../../css/animate.css" rel="stylesheet" />
<!-- Waves-effect -->
<link href="../../css/waves-effect.css" rel="stylesheet">
<!-- Table -->
<link href="../../assets/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="../../assets/responsive-table/rwd-table.min.css" rel="stylesheet" type="text/css" media="screen" />
<link href="../../assets/jquery-datatables-editable/datatables.css" rel="stylesheet" type="text/css" />
<!-- sweet alerts -->
<link href="assets/sweet-alert/sweet-alert.min.css" rel="stylesheet">
<!-- Custom Files -->
<link href="../../css/helper.css" rel="stylesheet" type="text/css" />
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
<script src="../../js/modernizr.min.js"></script>
<?php 
	require_once('../library/functions.php');
	$user = new User; 

    if(isset($_GET['desconectar'])){
        $user->logout();
    }
            
    $user->verificarSessao();
?>