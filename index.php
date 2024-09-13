<?php
session_start();
require "product.php";

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            color: #333;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 15px;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .product-name {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }
        .product-price {
            color: #555;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }
        .button:hover {
            background-color: #0056b3;
        }
        .view-cart-button {
            display: block;
            width: 200px;
            margin: 20px auto;
            text-align: center;
            background-color: #28a745;
        }
        .view-cart-button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <h1>Product List</h1>
    <ul>
        <?php foreach ($products as $product): ?>
            <li>
                <span class="product-name"><?php echo htmlspecialchars($product['name']); ?></span>
                <div class="product-price"><?php echo htmlspecialchars($product['price']); ?> PHP</div>
                <form method="post" action="add-to-cart.php">
                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
                    <button type="submit" class="button">Add to Cart</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="cart.php" class="button view-cart-button">View Cart</a>
</body>
</html>
