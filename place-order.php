<?php
session_start();
require "product.php";

$order_code = strtoupper(bin2hex(random_bytes(5)));

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total_price = 0;

foreach ($cart as $item) {
    $total_price += $item['price'];
}

$order_details = "Order Code: $order_code\n";
$order_details .= "Date and Time Ordered: " . date('Y-m-d H:i:s') . "\n";
$order_details .= str_repeat("-", 30) . "\n";
$order_details .= "Order Items:\n";
$order_details .= str_repeat("-", 30) . "\n";

foreach ($cart as $item) {
    $order_details .= "Product ID: {$item['id']}\n";
    $order_details .= "Product Name: {$item['name']}\n";
    $order_details .= "Price: {$item['price']} PHP\n";
    $order_details .= str_repeat("-", 30) . "\n";
}

$order_details .= "Total Price: $total_price PHP\n";

file_put_contents("orders-$order_code.txt", $order_details);

$_SESSION['cart'] = [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            color: #000000;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .button-view {
            background-color: #f7e40f;
        }
        .button-view:hover {
            background-color: #bfa900;
        }
    </style>
</head>
<body>
    <h1>Order Confirmation</h1>
    <p>Thank you for your order!</p>
    <p><strong>Order Code:</strong> <?php echo htmlspecialchars($order_code); ?></p>
    <p><strong>Total Price:</strong> <?php echo htmlspecialchars($total_price); ?> PHP</p>
    
    <?php if (!empty($cart)): ?>
        <table>
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Price (PHP)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['id']); ?></td>
                        <td><?php echo htmlspecialchars($item['name']); ?></td>
                        <td><?php echo htmlspecialchars($item['price']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>

    <a href="cart.php" class="button button-view">Go to Cart</a>
</body>
</html>
