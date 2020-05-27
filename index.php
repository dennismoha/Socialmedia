<?php 
include ("includes/header.php");
include ("includes/classes/User.php");
include ("includes/classes/Posts.php");

if(isset($_POST['post_button'])) {
    $post = new Posts($conn, $userLOGGEDIn);
    $post -> submitPost($_POST['post_text'],'none');
    header('location:index.php'); #adding this line here prevents a page from submitting data after refresh;
}

?>
<div class="user_details column">
    
    <a href="<?php echo $userLOGGEDIn ;?>" ><img id="pc" src="<?php echo $user['profile_pic'];?>" /></a> <!--this is the link for the profile picture--> <!--the user _logged in is from the header file and links the username details with the profile pic of the user -->
        <div class="user_details_left_right"><!--this class makes the number of posts and likes visible on the user profile-->
    
            <a href="<?php echo $userLOGGEDIn ; ?>"><!--this link takes us to the profile page-->  <!--the user _logged in is from the header file and takes us to the username details of the user -->
            <?php   
            echo $user['reg_fname']. " ".$user['reg_lname'];//this includes the users details  in the pic.
            ?>
            </a>
            <?php  
                  echo "Posts:" . $user['num_posts']."<br>";
                  echo "likes "  . $user ['num_likes'];     
            ?>

            <?php
   
    $person = new User($conn,$userLOGGEDIn);
    echo $person -> getFirstAndLastName() ;
?>

        </div>
</div>
    <div class="main_column column">
        <form class="post_form" action="index.php" method="POST">
            <textarea name="post_text" id="post_text" placeholder="input your info" ></textarea>
            <input type="submit" name="post_button"  id="post_button" placeholder="enter name" value="submit">
            <hr>
        </form>

        <?php
            $postt= new Posts($conn, $userLOGGEDIn);
            $postt ->loadPostFromFriends(); 
        ?>

    </div>




    </div><!--this is the div class closing the wrapper class-->
    </body>
</html>