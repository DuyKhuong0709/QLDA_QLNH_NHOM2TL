<?php 
include('server.php');


if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
}

if ($_SESSION['role'] != 'admin') {
    $_SESSION['msg'] = "You are not admin";
  	header('location: index.php');
} else {
	$_SESSION['success'] = 'Welcome admin';
	unset($_SESSION['success']);
}
$query = "SELECT * FROM users";
$result = mysqli_query($db, $query);

$cards = "SELECT * FROM card";
$result2 = mysqli_query($db, $cards);

$products = "SELECT * FROM products";
$result3 = mysqli_query($db, $products);


?>
<html>
<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
	<link rel="stylesheet" type="text/css" href="/css/product.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
</head>
<body>
	<div style="align:center" class="container table-responsive" >
        <h3>User Details</h3>
        <table class="table table-bordered" cellpadding="10" cellspacing="1">
            <tbody>
                <tr>
                    <th style="text-align:center;" width="5%">ID</th>
                    <th style="text-align:center;" width="20%">Userame</th>
                    <th style="text-align:center;" width="30%">Email</th>
                    <th style="text-align:center;" width="10%">Role</th>
                    <th style="text-align:center;" width="10%">Balance</th>
                    <th style="text-align:center;" width="5%">Action</th>
                </tr>	
			<?php
				while ($row = mysqli_fetch_assoc($result)) {
					if ($row['role'] != 'admin') {
			?>
				<tr>
					<td><?php echo $row['id'] ?></td>
					<td><?php echo $row['username'] ?></td>
					<td><?php echo $row['email'] ?></td>
					<form action='admin.php' method='post'>
						<td><input name='role' value="<?php echo $row['role'] ?>"></td>
						<td><input name='balance' value="<?php echo $row['balance'] ?>"></td>
						<input type='hidden' name='id' value="<?php echo $row['id'] ?>">
						<td>
							<button type='submit' name='update'>update</button>
							<button type='submit' name='delete'>delete</button>
						</td>
					</form>
				</tr>
			<?php
					}
				}
				

				if (isset($_POST['update'])) {
					
					$id = $_REQUEST['id'];
					$role = $_POST['role'];
					$balance = $_POST['balance'];
					$query1 = "UPDATE users SET role = '$role' WHERE id = '$id'";
    				mysqli_query($db, $query1);
					$query2 = "UPDATE users SET balance = '$balance' WHERE id = '$id'";
    				mysqli_query($db, $query2);
					header('location:admin.php');
					
				}
				if (isset($_POST['delete'])) {
					
					$id = $_REQUEST['id'];
					$query3 = "DELETE FROM users WHERE id = '$id';";
    				mysqli_query($db, $query3);
					header('location:admin.php');
					
				}
				
			?>
		</table>
		<h3>Cards</h3>
        <table class="table table-bordered" cellpadding="10" cellspacing="1">
            <tbody>
                <tr>
                    <th style="text-align:center;" width="5%">ID</th>
                    <th style="text-align:center;" width="20%">Info</th>
                    <th style="text-align:center;" width="30%">Number</th>
                    <th style="text-align:center;" width="10%">Value</th>
                    <th style="text-align:center;" width="10%">State</th>
                    <th style="text-align:center;" width="5%">Action</th>
                </tr>	
			<?php
				while ($card = mysqli_fetch_assoc($result2)) {
					
			?>
				<tr>
					<td><?php echo $card['id'] ?></td>
					<td><?php echo $card['info'] ?></td>
					<td><?php echo $card['cardnumber'] ?></td>
					<td><?php echo $card['cardvalue'] ?></td>
					<form action='admin.php' method='post'>
						<td><input name='state' value="<?php echo $card['state'] ?>"></td>
						<input type='hidden' name='cardid' value="<?php echo $card['id'] ?>">
						<td>
							<button type='submit' name='updatecard'>update</button>
							
						</td>
					</form>
				</tr>
			<?php
					
				}

				if (isset($_POST['updatecard'])) {
					$cardid = $_REQUEST['cardid'];
					$state = $_POST['state'];
					$query4 = "UPDATE card SET state = '$state' WHERE id = '$cardid'";
    				mysqli_query($db, $query4);	
								
				}
				
			?>
		</table>

		<h3>Products</h3>
        <table class="table table-bordered" cellpadding="10" cellspacing="1">
            <tbody>
                <tr>
                    <th style="text-align:center;" width="5%">ID</th>
                    <th style="text-align:center;" width="20%">Name</th>
                    <th style="text-align:center;" width="30%">Code</th>
                    <th style="text-align:center;" width="10%">Price</th>
                    <th style="text-align:center;" width="10%">Amount</th>
                    <th style="text-align:center;" width="5%">Action</th>
                </tr>	
			<?php
				while ($product = mysqli_fetch_assoc($result3)) {
					
			?>
				<tr>
					<td><?php echo $product['id'] ?></td>
					<td><?php echo $product['name'] ?></td>
					<td><?php echo $product['code'] ?></td>
					<form action='admin.php' method='post'>
						<td><input name='price' value="<?php echo $product['price'] ?>"></td>
						<td><input name='amount' value="<?php echo $product['amount'] ?>"></td>
						<input type='hidden' name='productid' value="<?php echo $product['id'] ?>">
						<td>
							<button type='submit' name='updateproduct'>update</button>
							
						</td>
					</form>
				</tr>
			<?php
					
				}
				
				if (isset($_POST['updateproduct'])) {
					$productid = $_REQUEST['productid'];
					$price = $_POST['price'];
					$amount = $_POST['amount'];

					$query6 = "UPDATE products SET price = '$price' WHERE id = '$productid'";
    				mysqli_query($db, $query6);
					$query7 = "UPDATE products SET amount = '$amount' WHERE id = '$productid'";
    				mysqli_query($db, $query7);
					
				}
				
			?>
		</table>


</body>
</html>
		
		