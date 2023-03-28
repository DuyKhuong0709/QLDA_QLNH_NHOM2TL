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

if(isset($_POST['submit'])) {

    // Get the file details
    $file = $_FILES["image"];
    $fileName = $file['name'];
    $fileType = $file['type'];
    $fileTempName = $file['tmp_name'];
    $fileError = $file['error'];
    $fileSize = $file['size'];

    // Allow certain file formats
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png');

    // Check if the file is the correct type and within the allowed size
    if (in_array($fileActualExt, $allowed) && $fileError === 0 && $fileSize < 10000000) { //1 trieu bytes = 10MB he thap phan decimal
        $fileNameNew = uniqid('', true) . "." . $fileActualExt;
        $fileDestination = './UserImg/' . $fileNameNew;
        move_uploaded_file($fileTempName, $fileDestination);
        $query2 = "UPDATE users SET image='$fileNameNew' WHERE username= '$username' ";
		mysqli_query($db, $query2);
        header("location: profile.php");

    } else {
        $_SESSION['error'] = "File must be a jpeg, png, or jpg and must be under 10MB";
        
    }

}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
    
<body>
<?php include('navbar.php'); ?>
<div class="header">
	<h2>Profile</h2>
</div>

<div class="content" >
    <!-- notification message -->
	<?php if (isset($_SESSION['success'])) : ?>
      <div class=" success" >
      	<p>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</p>
      </div>	
  	<?php endif ?>
	  <?php if (isset($_SESSION['error'])) : ?>
      <div class="error" >
      	<p>
          <?php 
          	echo $_SESSION['error']; 
          	unset($_SESSION['error']);
          ?>
      	</p>
      </div>
  	<?php endif ?>

    <img class='avt' src="/UserImg/<?php echo $user['image']?>">
    <button class='btn2' id="show-form">change picture</button>
	<form id ='form-submit' class="submit" method="post" action="profile.php" enctype="multipart/form-data">
		<input type="file" name="image">
		<input class='btn2' type="submit" name="submit" value="Upload">
	</form>
    <script>
        const button = document.getElementById('show-form');
        const form = document.getElementById('form-submit');

        button.addEventListener('click', () => {
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
        });
    </script>
    <p>
		Welcome 
		<b><?php echo $user['username']; ?></b>
	</p>
    <p>
		You are:   
		<b><?php echo $user['role']; ?></b>
	</p>
    <p>
		Your email address:   
		<b><?php echo $user['email']; ?></b>
	</p>
    <a href='change-password.php' >change password</a>
    
    <?php if($user['role'] == 'user'){?>
        <a href='upgrade.php' >Buy VIP</a>
    <?php } ?>
</div>