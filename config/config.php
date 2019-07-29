<?php
session_start();
$conn = mysqli_connect("localhost","root","","social");
$timezone = date_default_timezone_set('Africa/Nairobi');

if (mysqli_connect_errno()) {
    echo "connection failed to the database:".mysqli_connect_error();
} 
?>
