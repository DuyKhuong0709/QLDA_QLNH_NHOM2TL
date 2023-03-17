<?php 
include('server.php');

if (isset($_POST['reg_user'])) {
	
	$username = mysqli_real_escape_string($db, $_POST['username']);
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
	$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
	$role = 'user';
	$balance = 0;
  
  
	
	if (empty($username)) { array_push($errors, "Username is required"); }
	if (empty($email)) { array_push($errors, "Email is required"); }
	if (empty($password_1)) { array_push($errors, "Password is required"); }
	if ($password_1 != $password_2) {
	  array_push($errors, "The two passwords do not match");
	}
  
	
	$user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
	$result = mysqli_query($db, $user_check_query); 
	$user = mysqli_fetch_assoc($result);  
	


	if ($user) { 
	  if ($user['username'] === $username) {
		array_push($errors, "Username already exists");
	  }
  
	  if ($user['email'] === $email) {
		array_push($errors, "email already exists");
	  }
	}
	if ($_SESSION['captcha'] != $_POST['captcha']){ 
		array_push($errors, "Wrong captcha");
	}
	
	if (count($errors) == 0) {
		$password = password_hash($password_1, PASSWORD_DEFAULT);
   
		$query = "INSERT INTO users (username, email, password, role, balance) 
	   			  VALUES('$username', '$email', '$password', '$role', $balance)";
 	  	mysqli_query($db, $query);
 
		$_SESSION['username'] = $username;
		$_SESSION['role'] = $role;
		$_SESSION['success'] = "Successful Registration";
		$_SESSION['balance'] = $balance;

		header('location: index.php');
		
	}
  }
  
