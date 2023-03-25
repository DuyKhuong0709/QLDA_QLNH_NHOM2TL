
<?php
include("server.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
    switch($_GET["action"]) {
        case "add":
           
            $productByCode = $db_handle->runQuery("SELECT * FROM products WHERE code='" . $_GET["code"] . "'");
            $itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["image"], 'amount'=>$productByCode[0]["amount"]));
            
            if(!empty($_POST["quantity"])) {
                if(!empty($_SESSION["cart_item"])) {
                    if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) { 
                        foreach($_SESSION["cart_item"] as $k => $v) {
                        
                                if($productByCode[0]["code"] == $k) {
                                    if(empty($_SESSION["cart_item"][$k]["quantity"])) {
                                        $_SESSION["cart_item"][$k]["quantity"] = 0;  
                                    }
                                        $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                                    
                                    if ($_SESSION["cart_item"][$k]["quantity"] > $itemArray[$k]["amount"]) {
                                        $_SESSION["cart_item"][$k]["quantity"] = $itemArray[$k]["amount"];
                                    }    
                                                                         
                                    header('location:product.php');
                                }                       
                        }   
                    } else {
                        $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
                        header('location:product.php');
                    }
                } else {              
                    $_SESSION["cart_item"] = $itemArray;
                    header('location:product.php');
                    
                } 
            }
            
        break;
        case "remove":
            if(!empty($_SESSION["cart_item"])) {
                foreach($_SESSION["cart_item"] as $k => $v) {
                        if($_GET["code"] == $k)
                            unset($_SESSION["cart_item"][$k]);				
                        if(empty($_SESSION["cart_item"]))
                            unset($_SESSION["cart_item"]);
                }
                header('location:product.php');
            }
        break;
        case "empty":
            unset($_SESSION["cart_item"]);
            header('location:product.php');
        break;	
    }
}
    ?>

<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Shopping</title>
    <link rel="stylesheet" type="text/css" href="/css/product.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
</head>
<body>
    <?php include('navbar.php')?>
    <div id="wrap">
        <div id="columns" class="columns_4">
            <?php
            $product_array = $db_handle->runQuery("SELECT * FROM products ORDER BY id ASC");
                if (!empty($product_array)) { 
                    foreach($product_array as $key=>$value){
            ?>
                <figure>
                    <form method="post" action="product.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
                        <img class="img"src="/ProductImg/<?php echo $product_array[$key]["image"]; ?>">
                        <div class="text-info"><?php echo $product_array[$key]["name"]; ?></div>
                        <div class="text-danger"><?php echo $product_array[$key]["price"]." BNN$"; ?></div>
                        <div class="text-info"><?php echo $product_array[$key]["amount"]." remaining"; ?></div>
                        <input type="text" class="form-control" name="quantity" value="1" />
                        <?php if ($product_array[$key]["amount"] > 0) { ?>    
                            <input type="submit" name="add" value="Add to Cart" class="button"/>
                        <?php } else { ?>
                            <input type="button" value="Out of stock" style="background-color:salmon"class="button" disable/>
                        <?php } ?>
                    </form>
                </figure>                     
            <?php
                    }
                }
            ?>
        <div>
    </div>
   