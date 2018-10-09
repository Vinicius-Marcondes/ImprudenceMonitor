
<?php
    require('conn.php');
    
if(@$_GET){
    $ID_USER = $_GET['idUser'];
    $cont = $conn->query("SELECT X_IMPRUDENCIAS FROM imprudencias WHERE PESSOAS_ID_IMPRUDENCIAS = $ID_USER");
    while($row = $cont->fetch_array()){
	    $amount = $row['X_IMPRUDENCIAS'];
    }
    $CONT = $_GET['CONT'];
    if($CONT>$amount){
        if(mysqli_query($conn,"UPDATE imprudencias SET X_IMPRUDENCIAS = '$CONT' WHERE ID_IMPRUDENCIAS = $ID_USER")){
            echo "Dados atualizados com sucesso!";
        }else{
            echo "Falha ao atualizar os dados!";
        }
    }
    else{
        echo "amount < CONT";
    }
}?>

