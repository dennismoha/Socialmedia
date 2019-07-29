<?php

$servername = "localhost";
$username = "root";
$password  = "";

$conn = new mysqli($servername,$username,$password);
if (!$conn ) {
    die("connection failed:".mysqli_connect_error());
}else {
    echo "server reached succesfully";
}

/*
$sql = "CREATE DATABASE social ";
if ($conn->query($sql) == true) {
    die ("database not successfully created:".$mysqli_connect_error());
}else {
    echo "database is succesfully created";
}
*/

//table creation


?>