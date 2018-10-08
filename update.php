
<?php
    require('conn.php');
    
if(@$_GET){
$ID_ARDUINO = $_GET['ID_ARDUINO'];
    $CONT = $_GET['CONT'];
    $VALOR_X = $_GET['VALOR_X'];
    $VALOR_Y = $_GET['VALOR_Y'];
    if(mysqli_query($conn,"UPDATE imprudencias SET X_IMPRUDENCIAS = '$CONT' WHERE EQUIPAMENTOS_ID_IMPRUDENCIAS =$ID_ARDUINO")){
        echo "Dados atualizados com sucesso!";
    }else{
        echo "Falha ao atualizar os dados!";
    }
}?>
<html>
<head>
<meta charset="UTF-8">
</head>
<body>
<form action="update.php" method="get">
<input type="text" name="ID_ARDUINO">
<input type="text" name="CONT">
<input type="text" name="VALOR_X">
<input type="text" name="VALOR_Y">
<input type="submit">
</form>


</body>
</html>
