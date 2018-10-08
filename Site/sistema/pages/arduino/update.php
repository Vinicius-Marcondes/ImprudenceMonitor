
<?php
require('../conexao_banco.php');

if(@$_GET){
    $ID_USER = $_GET['ID_USER'];
    $CONT = $_GET['CONT'];
    $VALOR_X = $_GET['VALOR_X'];
    $VALOR_Y = $_GET['VALOR_Y'];
    $sql_query = $conexao_bd->query("SELECT X_IMPRUDENCIAS FROM imprudencias WHERE ID_IMPRUDENCIAS = $ID_USER");
    while($row=$sql_query->fetch_assoc()){
        $aa = $row['X_IMPRUDENCIAS'];
    };
    if($aa<$CONT){
        echo "CONT > X-imprudencias";
        if($conexao_bd->query("UPDATE imprudencias SET X_IMPRUDENCIAS = '$CONT'/*, VALOR_X = '$VALOR_X', VALOR_Y = '$VALOR_Y'*/ WHERE ID_IMPRUDENCIAS =$ID_USER")){
            echo "Dados atualizados com sucesso!";
        }else{
            echo "Falha ao atualizar os dados!";
        }
    }
    else {
        echo "CONT < x-imprudencias";
    }
}?>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
<form action="update.php" method="get">
    <input type="text" name="ID_USER">
    <input type="text" name="CONT">
    <input type="text" name="VALOR_X">
    <input type="text" name="VALOR_Y">
    <input type="submit">
</form>


</body>
</html>
