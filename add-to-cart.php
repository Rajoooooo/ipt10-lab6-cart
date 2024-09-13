<?php
session_start();
require "product.php";
// Add to cart logic
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    foreach ($products as $product) {
        if ($product['id'] == $product_id) {
            
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }
            
            $_SESSION['cart'][] = $product;
            break;
        }
    }
}
//Redirect to the product browsing page
header("Location: cart.php");
exit();
?>
