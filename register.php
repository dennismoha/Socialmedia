<?php
require 'config/config.php';
require 'includes/form_handler/register_handler.php';  //register handler should come before login handler because of the declared array_push variable
require 'includes/form_handler/login_handler.php';

?>
<!doctype html>
<html>
    <head>
        <title> index page</title>
        <link rel="stylesheet" type="text/css" href="assets/css/register_style.css" >
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="assets/js/register.js"></script>
            
    </head>
    <body>
        <?php   
        if(isset($_POST['register'])) {
            echo ' 
                <script>
                $(document).ready(function() {    
                $("#first").hide();
                $("#second").show();
                });
        </script>
        ';
        }
        
        ?>
        
        <div class="wrapper">
            <div class="login_box">
                <div class="header">
                    <h1>SOCIAL WEBSITE</H1>
                    <P>LOGIN or SINGUP </P>
                </div>
                
                <div id="first">
                    <form action="register.php" method="POST">
 
                        <input type="email" name="log_email" placeholder="login email" value="<?php if(isset($_POST['log_email'])) echo $_SESSION['log_email'];?>" required><br>
                        <input type="password" name="log_password" placeholder="login password"><br>
                        <input type="submit" name="login_button" value="login"><br>
                        <div style="color:white">
                        <?php if(in_array("email or password is incorrect<br>",$error_array)) echo "email or password is incorrect<br>";  ?><br>
                        </div>
                        <a href="#" id="signup" class="signup" style="color:white;text-decoration: none;">need an account?Register here!</a>
                        
                    </form>
                </div>
                
               
                <div id="second">
                    <form action="register.php" method="POST"> 
                          
                        <input type ="text" name ="reg_fname" placeholder="firstname" value = "<?php if(isset($_SESSION['reg_fname'])) { echo $_SESSION['reg_fname'];} ?>" required><br>
                        <?php if(in_array("your fname must be between 2 and 25<br>", $error_array)) echo "your fname must be between 2 and 25<br> "; ?> <!--spews out the error message stored in the $error_ variable -->
                        <br><input type ="text" name ="reg_lname" placeholder="your lastname" value ="<?php if(isset($_SESSION['reg_lname'])) { echo $_SESSION['reg_lname'];} ?> " required><br>
                        <?php if(in_array("your lname should be betweeen 2 and 25<br>",$error_array))  echo "your lname should be betweeen 2 and 25<br>"; ?>
                        <br> <input type ="email" name ="reg_email" placeholder="enter your email" value="<?php if(isset($_SESSION['reg_email'])) { echo $_SESSION['reg_email'];} ?>" required><br>

                        <br><input type ="email" name ="reg_email2" placeholder="confirm email" value="<?php if(isset($_SESSION['reg_email2'])) {echo $_SESSION ['reg_email2'];} ?>" required><br>
                        <?php  if (in_array("email is arleady in use<br>",$error_array))   echo "email is already in use" ; 
                        else  if(in_array("email is in invalid format<br>", $error_array)) echo "email is in invalid format<br>" ;
                        else    if(in_array("emails dont match <br>",$error_array))  echo "emails dont match <br>"; ?><br>

                        <input type ="password" name ="reg_password" placeholder="enter your password" required><br>
                        <br><input type ="password" name ="reg_password2" placeholder="confirm password" required><br>
                        <?php if(in_array("your passwords aren't matching<br>",$error_array)) {echo "your passwords aren't matching<br>";}
                        else if (in_array("your passwords can only contain letters or characters<br>",$error_array)) echo "your passwords can only contain letters or characters<br" ;
                        else if (in_array("your passwords can only contain letters or characters<br>",$error_array)) echo "your passwords can only contain letters or characters<br>" ;
                        else if (in_array( "your password should be between 5 and 8 characters<br>",$error_array)) echo "your password should be between 30 and 35 characters<br>";  ?>

                        <br><input type ="submit" name="register_button" value="register">
                        <?php if (in_array("<span style='color:#14C800;'>your set to go buddy </span><br>",$error_array) ) echo "<span style='color:#14C800;'>your set to go buddy </span><br>"; ?><br>
                        <a href="#" id="signin" class="signin" style="color:white;text-decoration: none;">arleady have an account?Signin here!</a>                    
                    </form>
                </div>
                
            </div>
        </div>
    </body>
</html>
