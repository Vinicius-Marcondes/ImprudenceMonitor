<?php
$conn = new mysqli("localhost", "root", "admin", "mdi_banco");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
