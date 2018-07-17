<?php 
session_start();
echo "comum <br>"; 
echo $_SESSION['id']."<br>";
echo $_SESSION['nome']."<br>";
echo $_SESSION['senha']."<br>";
echo $_SESSION['perfil']."<br>";
echo $_SESSION['logo'];
?>