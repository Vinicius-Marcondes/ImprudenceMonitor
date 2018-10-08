<?php
require("conn.php");
$ID_ARDUINO = $_GET['ID_ARDUINO'];
$cont = $conn->query("SELECT * FROM imprudencias WHERE EQUIPAMENTOS_ID_IMPRUDENCIAS = '$ID_ARDUINO'");
while($row = $cont->fetch_array()){
	echo $row['X_IMPRUDENCIAS'];
}
?>
<meta charset="utf-8">
