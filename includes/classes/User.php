<?php

	#helps us get first name and last name when creating post
	class User{

	private $user;
	private $conn;

	public function __construct($conn,$user) {
		$this -> conn = $conn;
		$user_details_query = mysqli_query($conn,"SELECT * FROM users WHERE username = '$user'");
		$this -> user = mysqli_fetch_array($user_details_query);
	}

	public function getUserName() {
		return $this ->user['username'];
	}

	public function getNumPosts() {
		$username = $this -> user['username'];
		$query = mysqli_query($this->conn,"SELECT num_posts FROM users WHERE username = '$username'");
		$row = mysqli_fetch_array($query);
		return $row['num_posts'];
	}


	public function getFirstAndLastName() {
		$username = $this ->user['username'];
		$query = mysqli_query($this-> conn,"SELECT reg_fname,reg_lname FROM users WHERE username ='$username'");
		$row = mysqli_fetch_array($query);
		return $row['reg_fname'] . ' ' . $row['reg_lname'];
	}

	public function isClosed() {
		$username = $this -> user['username'];
		$query = mysqli_query($this -> conn, "SELECT user_closed FROM users WHERE username = '$username'");
		$row = mysqli_fetch_array($query);

		if($row['user_closed'] == 'no') {
			return false;
		}else {
			return true;
		}
	}


	}

	


?>