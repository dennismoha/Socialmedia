<?php
	 class Posts {
 	
 	private $user_obj;
 	private  $conn;

 	public function __construct($conn,$userObj) {
 		$this -> conn = $conn;
 		$this -> user_obj = new User($conn,$userObj); //create a new instance of the User class 
 	}

 	public function submitPost($body,$user_to) {
 		$body = strip_tags($body); #removes all htmls tags
 		$body = mysqli_real_escape_string($this->conn,$body);
 		$body = str_replace('\r\n', '\n', $body);
 		$body = nl2br($body); #replaces all new lines with a line break

 		$check_empty= preg_match('/\s+/', $body); //deletes all empty spaces in the post

 		if($check_empty != "") { #after all spaces are removed and the body is empty, nothing should be posted else post
 			$date_added = date('Y-m-d H:i:s');
 			$added_by = $this -> user_obj -> getUserName(); //from the new instance of User class above, use the getusername method to get the username of the person posting

 			if($user_to == $added_by) {
 				$user_to = "self"; #if the user adds the post by himself,save self on the $user_to  section
 			}

 			#insert post 			
 			$query = "INSERT INTO posts (body,added_by,user_to,date_added,user_closed,deleted,likes) VALUES('$body','$added_by','$user_to','$date_added','no','no','0')" ;
 			if(mysqli_query($this->conn,$query)){
 				// echo 'data addedd successfully';
 			}else {
 				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
 			}

 			$return_id = mysqli_insert_id($this->conn); #returns the post id after you have pushed it into the db

 			//insert notification

 			//update post count for user
 			 $num_posts = $this->user_obj->getNumPosts();
 			 $num_posts++;
 			 $update_query= mysqli_query($this-> conn,"UPDATE users SET num_posts='$num_posts' WHERE username='$added_by'");




 		}

 	}

 	public function loadPostFromFriends() {
 		$str = "";
 		$data = mysqli_query($this -> conn, "SELECT * FROM posts WHERE DELETED = 'no'");
 		while($row = mysqli_fetch_array($data)) {
 			$id = $row['id'];
 			$body = $row['body'];
 			$added_by = $row['added_by'];
 			$date_time = $row['date_added'];

 			if($row['user_to'] == 'none') {
 				$user_to = "";
 			}else {
 				$user_to_obj = new User($conn,$row['user_to']);
 				$user_to_name = $user_to_obj -> getFirstAndLastName();
 				$user_to = "to <a href='".$row['user_to']."'>". $user_to_name. "</a>"; #returns a link of the profile page of the user to
 			}


 			#check if the user who posted has their account closed;
 			$added_by_obj = new User($this -> conn,$added_by);
 			if($added_by_obj -> isClosed()) {
 				continue; 				
 			}
 			$user_details_query = mysqli_query($this->conn, "SELECT reg_fname,reg_lname,profile_pic FROM users WHERE username = '$added_by'");
 			$user_row = mysqli_fetch_array($user_details_query);
 			$first_name = $user_row['reg_fname'];
 			$last_name = $user_row ['reg_lname'];
 			$profile_pic = $user_row['profile_pic'];

 			

 			#TimeFrame
 			$date_time_now = date("Y-m-d H:i:s");
 			$start_date = new DateTime($date_time);//current time
 			$end_date = new DateTime($date_time_now);//Difference between dates 
 			$interval = $start_date ->diff($end_date);
 			if($interval -> y >=1) {
 				if($interval == 1) {
 					$time_message = $interval -> y . "year ago"; //1 year ago
 				}else {
 					$time_message = $interval -> y . "years ago"; # 1+ years
 				}
 			}else if($interval -> m >=1) {
 				if($interval -> d == 0) {
 					$days = "ago";
 				}else if($interval -> d == 1) {
 					$days = $interval -> d . "day ago";
 				}else {
 					$days = $interval ->d. "days ago";
 				}

 				if($interval -> m ==1) {
 					$time_message = $interval->m ."month".$days;
 				}else {
 					$time_message = $interval -> m. "months". $days;
 				}
 			}else if($interval -> d >= 1) {
 				if($interval -> d == 1) {
 					$time_message = $interval -> d . "yesterday";
 				}else {
 					$time_message = $interval -> d. "days ago";
 				}
 			}else if($interval -> h >= 1) {
 				if($interval -> h == 1) {
 					$time_message =$interval -> h. "hour ago";
 				} else 
 					$time_message =$interval -> h. "hours ago";
 			}else if($interval -> i >= 1) {
 				if($interval -> i == 1) {
 					$time_message =$interval -> i. "minutes ago";
 				} else 
 					$time_message =$interval -> i. "minutes ago";
 			}else {
 				if($interval -> s < 30) {
 					$time_message = "just now";
 				}else {
 					$time_message = $interval -> s . "seconds ago";
 				}
 			}

 			 $str .= "<div class ='status post'>
 						<div class = 'post_profile_pic'>
 							<img src='$profile_pic' width='50'
 						</div>

 						<div class='posted_by' style='color:blue;'>
 							<a href='$added_by'>$first_name $last_name</a>$user_to &nbsp;&nbsp;$time_message
 						</div>
 						<div id = 'post_body'>
 							$body </br>
 						</div>
 					</div>";
 		


 			
 		}
 		echo $str;

 		}
 	}

?>