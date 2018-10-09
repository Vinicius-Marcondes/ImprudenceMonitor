<?php
require("conn.php");
$userId = $_GET['userId'];
$cont = $conn->query("SELECT X_IMPRUDENCIAS FROM imprudencias WHERE PESSOAS_ID_IMPRUDENCIAS = '$userId'");
while($row = $cont->fetch_array()){
	echo $row['X_IMPRUDENCIAS'];
}
?>
<meta charset="utf-8">
