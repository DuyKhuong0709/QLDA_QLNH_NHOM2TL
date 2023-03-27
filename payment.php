<?php 
include('server.php');
$username = $_SESSION['username'];
$query = "SELECT * FROM users WHERE username='$username '";
$results = mysqli_query($db, $query);
$user = mysqli_fetch_assoc($results);

if (!isset($_SESSION['username'])) {
    $_SESSION['error'] = "You need to login first!";
    header('location:login.php');
}

if (!isset($_SESSION['cart_item'])) {
    header('location:product.php');
}

if ($user['balance']  < $_SESSION['price']) {
    $_SESSION['error'] = "You don't have enough money!";
    header('location:index.php');
    
}
if($user['role'] == 'admin'){
    $discount = 90;
   
} else if ($user['role'] == 'vip'){
    $discount = 30;
    
} else {
    $discount = 0;
    
} 
if (isset($_POST['pay'])) {
    
    foreach($_SESSION['cart_item'] as $k=>$v){
        
        if($_SESSION["cart_item"][$k]['amount'] < $_SESSION["cart_item"][$k]["quantity"]){
            $new_amount = 0;
        } else {
            $new_amount = $_SESSION["cart_item"][$k]["amount"] -  $_SESSION["cart_item"][$k]["quantity"];
        }
        $code = $_SESSION["cart_item"][$k]["code"];
        $query2 = "UPDATE products SET amount='$new_amount' WHERE code='$code'";
            mysqli_query($db, $query2);
    }
    $new_balance = $user['balance'] - ($_SESSION['price'] - $_SESSION['price']*$discount/100);
    $query1 = "UPDATE users SET balance='$new_balance' WHERE username='$username '";
            mysqli_query($db, $query1);
    
    $_SESSION['success'] = "Successful Payment";
    unset($_SESSION['cart_item']);
    header('location:index.php');
}



