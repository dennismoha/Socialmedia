<?php
//include "databaase.php";                 //this header file will contain the navigation bar and will always be included
require "config/config.php";              // this is the homepage of the user after he/she has logged in

if(isset($_SESSION['username'])) {
    $userLOGGEDIn=$_SESSION['username'];
    $user_details_query=mysqli_query($conn,"SELECT * FROM USERS WHERE username='$userLOGGEDIn'"); //enables us to search the username of the logged in user from the database and output it on the navigation bae
    $user = mysqli_fetch_array($user_details_query); //contains all the details of the user as an array and it's refrenced below in the navigation panel
}else {
    header("Location: register.php"); //stops them from accessing the homepage if not logged in.
}
?>

<html>
    <head>
        <title>welcome to the social media</title> 
            <!---javascript files here-->
       
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>      
        <script src="assets/js/bootstrap.js" ></script>
       
        <!---css files here -->  
         <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">        
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">        
        <link rel="stylesheet" type="text/css" href="assets/css/style.css" >    <!--this should always be included below bootstrap to override any of the bootstrap unnceccessary files-->                       
    </head>
    <body>
        <div class="top_bar" >
            <div class="logo">
                <a href="index.php">Socialmedia</a>
            </div>
            
            <nav> <!--curbs the navigation header of the icons -->
                <a href="<?php echo  $userLOGGEDIn; ?>"><?php echo $user['first_name']; ?>   </a>   <!--the link user_logged in php helps take you to the profile page of the logged in user -->                 
                <a href="index.php" style="text-decoration: none" title="home"><i class="fa fa-home"></i></a>
                <a href="#" style="text-decoration: none" title="messages"><i class="fa fa-envelope"></i></a>
                <a href="#" style="text-decoration: none" title="notifications"><i class="fa fa-bell-o" style="font-size:24px"></i></a>
                <a href="#" style="text-decoration: none" title="friends"><i class="fa fa-users" style="font-size:24px"></i></a>
                <a href="#" style="text-decoration: none" title="settings"><i class="fa fa-cog" style="font-size:24px"></i></a>
                <a href="includes/handlers/logout.php" style="text-decoration: none" title="singout"><i class="fa fa-sign-out" style="font-size:24px"></i></a>
            </nav>
        </div>
                  
    <div class="wrapper"><!--this class is clossed in the index.php and controls the size of the profile pic   -->
     
