<?php
include "server.php";
echo "<br>hello world<br>";

$conn = mysqli_connect("localhost","root","","social");

if (mysqli_connect_errno()) {
    echo "connection failed to the database:".mysqli_connect_error();
} else {
    echo "connection successful<br>";
}
/*

$sql = "CREATE TABLE users(
    id int(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY ,
    first_name VARCHAR(25) NOT NULL,
    last_name VARCHAR(25) NOT NULL,
    username VARCHAR(100) ,
    email VARCHAR(100),
    password VARCHAR(255),
    singup_date DATE,
    profile_pic VARCHAR(255),
    mum_posts INT,
    num_likes INT,
    user_closed VARCHAR(3),
    friend_array TEXT
    )";

if (mysqli_query($conn,$sql)){
    echo "table test created successfully";
}else {
    echo "error creating table:".mysqli_error($conn);    
} 
//insertind data into the table

$sql= "INSERT INTO test (first_name,last_name,username,email,password,mum_posts,num_likes) 
        VALUES('dennis','moha','dennismoha','den2@gmail.com','12345','4','3'),
               ('melisa','makena','melisamak','melisamak@gmail.com','123456','2','3') ";

if (mysqli_query($conn,$sql)) {
    echo "data was inserted successfully";
}else {
    echo "error in inserting data:" .mysqli_error($conn);
}
*/

?>