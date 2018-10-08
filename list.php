<html>
	<head>
<?php
    require('conn.php');
    echo "<table border='2px'><tr><th>ID</th><th>FUNCIONARIO</th><th>ID_ARDUINO</th><th>CONT</th><th>VALOR_X</th><th>VALOR_Y</th><th>RECORDED</th></tr>";
    $cont = mysqli_query($conn, "SELECT * FROM pessoas");
    while($row = mysqli_fetch_array($cont)){
        ?>

	<meta chearset="utf-8">
</head>
<body>        
<tr>            <td><?php echo $row[0];?></td>
        <?php
    }
    echo "</table>"
?>
</body>
</html>
