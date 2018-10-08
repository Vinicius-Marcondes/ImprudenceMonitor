<?php require('../conexao_banco.php');?>
<html>
	<head>
	<meta chearset="utf-8">
</head>
<body>
<?php
    
    echo "<table border='2px'><tr><th>ID</th><th>FUNCIONARIO</th><th>ID_ARDUINO</th><th>CONT</th><th>VALOR_X</th><th>VALOR_Y</th><th>RECORDED</th></tr>";
    $cont = $conexao_bd->query( "SELECT ID_PESSOAS FROM pessoas  INNER JOIN imprudencias ON pessoas.PESSOAS_ID = imprudencias.PESSOAS_ID_IMPRUDENCIAS
    ");
    while($row = $cont->fetch_array()){
        ?>
    <tr>
        <td><?php echo $row["NOME_PESSOAS"];?></td>
       <td><?php echo $row["ID_IMPRUDENCIAS"];?></td>
    </tr>
<?php
    }
    echo "</table>"
?>
</body>
</html>
