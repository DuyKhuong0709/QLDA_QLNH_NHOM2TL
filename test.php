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

?>


<html>
<head>
    <title>test</title>
	<link rel="stylesheet" type="text/css" href="/css/chat.css">
</head>
<body>
    <div class="chat-container">
    <div class="chat-header">
        <h2>Chat</h2>
    </div>
    <div class="chat-input">
        <form action="test.php" method="post">
        <input type="text" name="message" placeholder="Type a message">
        <button type="submit">Send</button>
        <button type="submit" name="clear">Clear All Messages</button>
        
     
        </form>
        <button onclick="location.href='test2.php'" >Search</button>
    </div>
    <div class="chat-messages">
        <?php
        $sql = "SELECT * FROM messages ORDER BY time DESC";
        $result = mysqli_query($db, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="message">';
            echo '<p>' . $row['user'] . ': ' . $row['message'] . '</p>';
            echo '<p class="timestamp">' . $row['time'] . '</p>';
            echo '</div>';
            }
        }

        ?>
    </div>
    </div>
</body>
</html>


