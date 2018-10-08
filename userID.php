<?php
    require("conn.php");
    $ID_ARDUINO = $_GET['ID_ARDUINO'];
    $cont = mysqli_query($conn, "SELECT * FROM imprudencias WHERE EQUIPAMENTOS_ID_IMPRUDENCIAS = $ID_ARDUINO");
    while($row = mysqli_fetch_array($cont)){
        echo $row['ID_IMPRUDENCIAS'];
    }
