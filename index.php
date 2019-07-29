<?php 
include ("includes/header.php");
?>
<div class="user_details column">
    <a href="<?php echo $userLOGGEDIn ;?>" ><img id="pc" src="<?php echo $user['profile_pic'];?>" /></a> <!--this is the link for the profile picture--> <!--the user _logged in is from the header file and links the username details with the profile pic of the user -->
        <div class="user_details_left_right"><!--this class makes the number of posts and likes visible on the user profile-->
    
            <a href="<?php echo $userLOGGEDIn ; ?>"><!--this link takes us to the profile page-->  <!--the user _logged in is from the header file and takes us to the username details of the user -->
            <?php   
            echo $user['first_name']. " ".$user['last_name'];//this includes the users details  in the pic.
            ?>
            </a>
            <?php  
                  echo "Posts:" . $user['mum_posts']."<br>";
                  echo "likes "  . $user ['num_likes'];     
            ?>
        </div>
</div>
<div class="main_column column">
        <form class="post_form" action="index.php" method="POST">
            <textarea name="post_text" id="post_text" placeholder="input your info" ></textarea>
            <input type="submit" name="post"  id="post_button" placeholder="enter name" value="submit">
            <hr>
        </form>

</div>

    </div><!--this is the div class closing the wrapper class-->
    </body>
</html>