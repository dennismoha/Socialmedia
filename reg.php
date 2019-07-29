
<?php
session_start();
$conn = mysqli_connect("localhost","root","","social");

if (mysqli_connect_errno()) {
    echo "connection failed to the database:".mysqli_connect_error();
} else {
    echo "connection successful<br>";
}
//create variables to hold errors
$fname = "";//firstname
$lname = "";//secondname
$email = "";//email
$email2 = "";//email2
$password = "" ;//passowrd
$password2 = "";//password 2
$date= "";//holds the signup data
$error_array=array();//holds any error we get from the scripts

if (isset($_POST['register_button'])) {
    
    $fname = strip_tags($_POST['reg_fname']);//strip tag removes any html tags in the input field
    $fname = str_replace(' ', '',$fname);//removes any space in the input field
    $fname = ucfirst(strtolower($fname));
    $_SESSION['reg_fname']= $fname; //session variable for the first name
    
    //last name
    $lname = strip_tags($_POST['reg_lname']);
    $lname = str_replace(' ','', $lname);
    $lname = ucfirst(strtolower($lname));
    $_SESSION['reg_lname'] = $lname; // session variables for the last name
    
    //email
    $email = strip_tags($_POST['reg_email']);
    $email = str_replace (' ','',$email);
    $email = ucfirst(strtolower($email));
     $_SESSION['reg_email'] = $email; //session variables for the email
   
    //email 2
    $email2 = strip_tags($_POST['reg_email2']);
    $email2 = str_replace (' ','',$email2);
    $email2 = ucfirst(strtolower($email2));
     $_SESSION['reg_email2'] = $email;//session variables storing email
    
    //password 1 and 2
    $password = strip_tags ($_POST['reg_password']);
    
    //password 2
    $password2 = strip_tags ($_POST['reg_password2']);
    $date = date('y-m-d'); //this gets the curremt year and day
    
    if ($email == $email2) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL))  {        // WE check if the email
            $email = filter_var($email,FILTER_VALIDATE_EMAIL);  // is in valid format*/
            
            
            //check if the email arleady exists
            $em_check = mysqli_query($conn, "SELECT email from test where email='$email'"); //if it returns something it means that email is usd in the account
            
            //count the num of rows returned by em_check      
            $num_rows = mysqli_num_rows($em_check);
            if ($num_rows > 0) {
                echo " email is arleady in use<br>";
              //array_push($error_array,"email is arleady in use<br>");//this is the $error_array that pushes out the errror notification
            }
        }else {
           // echo "email is in invalid format";         
            array_push($error_array,"email is in invalid format<br>");
        }
        
    }else {
        //echo "passwords don't match";
     array_push($error_array,"emails dont match <br>");
    }
    
    //string length of the names
    if (strlen($fname) > 25 || strlen($fname) < 2) {    
       // echo "your rname  must be between 2 and 25";
        array_push($error_array,"your fname must be between 2 and 25<br>");
    }
    if (strlen($lname) > 25 || strlen($lname) <2) {
        //echo "your lname should be between 2 and 25";
        array_push($error_array,"your lname should be betweeen 2 and 25<br>");
    }
    if ($password != $password2) {
       array_push($error_array,"your passwords aren't matching<br>");
        //echo "your passwords aren't matching<br>";
    }else  {
        if (preg_match('/[^A-Za-z0-9]/',$password)){
            array_push($error_array,"your passwords can only contain letters or characters<br>");
            //echo "passwords can only contain letters or characters<br>";
        }
      
    }
    if (strlen($password > 5 || strlen($password) < 8)) {
        //echo "your password should be between 30 and 35 characters<br>";
        array_push($error_array,"your password should be between 30 and 35 characters<br>");        
    }
    if (empty($error_array)) { //if error_array is empty meaning there is no error recorded then it should proceed to encrypt the databs
       //$password = md5($password);
        $password = hash('sha512',$_POST['reg_password']); //encrypt the password
        
        //generate a username by concantenating first and lasr name
        $username = strtolower($fname."_".$lname);
        $check_username_query = mysqli_query($conn,"SELECT username FROM test WHERE username='$username");
        
        //check the database to find a simmilar match
        $i = 0;
        while (mysqli_num_rows($check_username_query) != 0) {
            $i++;
            $username= $username." ".$i++;
            $check_username_query = mysqli_query($conn,"SELECT username FROM test WHERE username='$username'");
        }
        //profile picture assingment ...root to the saved folder
        $rand = rand(1,2);//brings out a random picture
        if ($rand == 1)
        $profile_pic = "/Assets/images/profile_pics/default/head2.png";
        else if ($rand == 2)
            $profile_pic = "/Assets/images/profile_pics/default/header.png";
         
         //$query = mysqli_query($conn,"INSERT INTO test VALUES(',','$fname','$lname','$username','$email','$password','$date','$profile_pic','0','0','no',','   )");
         array_push($error_array,"<span style='font-color:red'>your set to go buddy </span>");  
                
     
    
     
         $query = mysqli_query($conn,"INSERT INTO test VALUES(',','$fname','$lname','$username','$email','$password','$date','$profile_pic','0','0','no',','   )");
         $_SESSION['reg_fname'] = "";
         $_SESSION ['reg_lname'] = "";
         $_SESSION ['reg_email'] = "";
         $_SESSION ['reg_email2'] = "";
         $_SESSION ['reg_password']= "";
}
}
?>

<!doctype html>
<html>
    <head>
        <title> index page</title>
    </head>
    <body>
        <form action="register.php" method="POST">
          
            <input type ="text" name ="reg_fname" placeholder="firstname" value = "<?php if(isset($_SESSION['reg_fname'])) { echo $_SESSION['reg_fname'];} ?>" required><br>
          <?php if(in_array("your fname must be between 2 and 25<br>", $error_array)){ echo "your fname must be between 2 and 25<br> "; }?> <!--spews out the error message stored in the $error_ variable -->
            
            <br><input type ="text" name ="reg_lname" placeholder="lastname" value ="<?php if(isset($_SESSION['reg_lname'])) { echo $_SESSION['reg_lname'];} ?> " required><br>
           <?php if(in_array("your lname should be betweeen 2 and 25<br>",$error_array)) { echo "your lname should be betweeen 2 and 25<br>";} ?>
            
            <br> <input type ="email" name ="reg_email" placeholder="enter your email" value="<?php if(isset($_SESSION['reg_email'])) { echo $_SESSION['reg_email'];} ?>" required><br>
                       
            <br><input type ="email" name ="reg_email2" placeholder="confirm email" value="<?php if(isset($_SESSION['reg_email2'])) {echo $_SESSION ['reg_email2'];} ?>" required><br>
             <?php  if (in_array("email is arleady in use<br>",$error_array))  { echo "email is already in use" ; }
             else  if(in_array("email is in invalid format<br>", $error_array)) { echo "email is in invalid format<br>" ;}
             else    if(in_array("emails dont match <br>",$error_array)) { echo "emails dont match <br>";} ?>
            
            <input type ="password" name ="reg_password" placeholder="enter your password" required><br>
            <br><input type ="password" name ="reg_password2" placeholder="confirm password" required><br>
           <?php if(in_array("your passwords aren't matching<br>",$error_array)) {echo "your passwords aren't matching<br>";}
           else if (in_array("your passwords can only contain letters or characters<br>",$error_array)) {echo "your passwords can only contain letters or characters<br" ;}
           else if (in_array("your passwords can only contain letters or characters<br>",$error_array)) {echo "your passwords can only contain letters or characters<br>" ;}
           else if (in_array( "your password should be between 5 and 8 characters<br>",$error_array)) {echo "your password should be between 30 and 35 characters<br>";}  ?>
            
            <br><input type ="submit" name="register_button" value="register">
            <?php if (in_array("<span style='font-color:red'>your set to go buddy </span><br>",$error_array) ) {echo "<span style='font-color:red'>your set to go buddy </span><br>";} ?>
        </form>
    </body>
</html>