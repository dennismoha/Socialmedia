<?php
if(isset($_POST['login_button'])) {
   $email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL);//Sanitize email
   $_SESSION['log_email'] = $email;//store email in session variables
   $password = hash('sha512',$_POST['log_password']); //get password
   
   $check_database_query = mysqli_query($conn, "SELECT * FROM users where email='$email' AND reg_password='$password'");  
   


   $check_login_query = mysqli_num_rows($check_database_query);
   
   
   if($check_login_query == 1) {
       $row = mysqli_fetch_array($check_database_query);//fetches the results in the check database query
       $username = $row ['username'];//accesses the row we want in the query
      
       $user_closed_query = mysqli_query($conn,"SELECT * FROM users WHERE email='$email' AND user_closed='yes'"); //this query checks if their is a closed accout
       if(mysqli_num_rows($user_closed_query)== 1) {
           $reopen_account= mysqli_query($conn,"UPDATE users SET user_closed='no' where email='$email' " );
           
       }
       
       
       $_SESSION['username'] = $username;
       header("Location:index.php");
       exit();
   }else
       array_push($error_array,"email or password is incorrect<br>");
}


?>