<?php
$conn = new mysqli("localhost", "root", "usbw", "mdi_banco");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
