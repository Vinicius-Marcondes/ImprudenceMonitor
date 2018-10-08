<?php
require('../conexao_banco.php');
if(@$_GET){
    $ID_ARDUINO = $_GET['ID_ARDUINO'];
    if(@$_GET['ID_ARDUINO']) {
        $cont = $conexao_bd->query("SELECT PESSOAS_ID_IMPRUDENCIAS FROM imprudencias WHERE EQUIPAMENTOS_ID_IMPRUDENCIAS = $ID_ARDUINO");
        while ($row = $cont->fetch_array()) {
            echo $row[0];
        }
    }
}

