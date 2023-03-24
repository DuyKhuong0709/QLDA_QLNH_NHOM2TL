<?php
include('server.php');	


if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
}
if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
}
$username = $_SESSION['username'];
$query = "SELECT * FROM users WHERE username='$username'";
$results = mysqli_query($db, $query);
$user = mysqli_fetch_assoc($results);

$time = date("l").date("h:i:sa");

if (isset($_POST['message'])){
    $message = mysqli_real_escape_string($db, $_POST['message']);
   
    $query2 = "INSERT INTO messages (user, message, time) 
                VALUES('$username', '$message', '$time')";
    mysqli_query($db, $query2);
    header("location: test.php");
}

if (isset($_POST['clear'])) {
    $clear = "DELETE FROM messages";
    mysqli_query($db, $clear); 
    header("location: test.php");
}



