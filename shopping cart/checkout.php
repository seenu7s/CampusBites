<?php
session_start(); // Start the session
@include 'config.php';

if (isset($_POST['order_btn'])) {
    // Sanitize and validate inputs
    $name = htmlspecialchars(trim($_POST['name']));
    $number = htmlspecialchars(trim($_POST['number']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $method = htmlspecialchars(trim($_POST['method']));
    $flat = htmlspecialchars(trim($_POST['flat']));
    $street = htmlspecialchars(trim($_POST['street']));
    $city = htmlspecialchars(trim($_POST['city']));
    $state = htmlspecialchars(trim($_POST['state']));
    $country = htmlspecialchars(trim($_POST['country']));
    $pin_code = htmlspecialchars(trim($_POST['pin_code']));

    // Fetch cart data
    $cart_query = mysqli_query($conn, "SELECT * FROM `cart`");
    $price_total = 0;
    $product_name = [];

    if (mysqli_num_rows($cart_query) > 0) {
        while ($product_item = mysqli_fetch_assoc($cart_query)) {
            $product_name[] = $product_item['name'] . ' (' . $product_item['quantity'] . ')';
            $product_price = $product_item['price'] * $product_item['quantity'];
            $price_total += $product_price;
        }
    }

    $total_product = implode(', ', $product_name);

    // Use prepared statements for inserting order details
    $stmt = $conn->prepare("INSERT INTO `order` (name, number, email, method, flat, street, city, state, country, pin_code, total_products, total_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssssss", $name, $number, $email, $method, $flat, $street, $city, $state, $country, $pin_code, $total_product, $price_total);

    if ($stmt->execute()) {
        // QR Code generation
        require_once 'phpqrcode/qrlib.php';
        $path = 'images/';
        if (!is_dir($path)) {
            mkdir($path, 0755, true); // Ensure the directory exists
        }
         
        $qrcode = $path . time() . ".png";
        $qr_content = "Order Details:\nName: $name\nTotal Price: $price_total\nProducts: $total_product";
        QRcode::png($qr_content, $qrcode);

        // Store the QR code path in session
        $_SESSION['qrcode_path'] = $qrcode;
        
        // Display order confirmation
        echo "
        <div class='order-message-container'>
            <div class='message-container'>
                <h3>Thank you for shopping!</h3>
                <div class='order-detail'>
                    <span>{$total_product}</span>
                    <span class='total'>Total: \${$price_total}/-</span>
                </div>
                <div class='customer-details'>
                    <p>Your name: <span>{$name}</span></p>
                    <p>Your number: <span>{$number}</span></p>
                    <p>Your email: <span>{$email}</span></p>
                    <p>Your address: <span>{$flat}, {$street}, {$city}, {$state}, {$country} - {$pin_code}</span></p>
                    <p>Your payment mode: <span>{$method}</span></p>
                    <p>(*Pay when the product arrives*)</p>
                </div>
                <div class='qr-code'>
                    <h4>Scan this QR Code for Order Details:</h4>
                    <img src='{$qrcode}' alt='QR Code'>
                </div>
                <a href='download.php' class='btn'>Continue Shopping & Download QR Code</a>
            </div>
        </div>
        ";
    } else {
        echo "Error: Unable to place order. Please try again.";
    }
    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>

    <!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'header.php'; ?>

<div class="container">
<section class="checkout-form">
    <h1 class="heading">Complete Your Order</h1>
    <form action="" method="post">
        <div class="display-order">
            <?php
            $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
            $grand_total = 0;
            if (mysqli_num_rows($select_cart) > 0) {
                while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                    $total_price = number_format($fetch_cart['price'] * $fetch_cart['quantity']);
                    $grand_total += $total_price;
            ?>
            <span><?= htmlspecialchars($fetch_cart['name']); ?>(<?= htmlspecialchars($fetch_cart['quantity']); ?>)</span>
            <?php
                }
            } else {
                echo "<div class='display-order'><span>Your cart is empty!</span></div>";
            }
            ?>
            <span class="grand-total">Grand Total: $<?= number_format($grand_total); ?>/-</span>
        </div>

        <div class="flex">
            <div class="inputBox">
                <span>Your Name</span>
                <input type="text" placeholder="Enter your name" name="name" required>
            </div>
            <div class="inputBox">
                <span>Your Number</span>
                <input type="number" placeholder="Enter your number" name="number" required>
            </div>
            <div class="inputBox">
                <span>Your Email</span>
                <input type="email" placeholder="Enter your email" name="email" required>
            </div>
            <div class="inputBox">
                <span>Payment Method</span>
                <select name="method">
                    <option value="cash on delivery" selected>Cash on Delivery</option>
                    <option value="credit card">Credit Card</option>
                    <option value="paypal">PayPal</option>
                </select>
            </div>
            <div class="inputBox">
                <span>Address Line 1</span>
                <input type="text" placeholder="e.g. Flat No." name="flat" required>
            </div>
            <div class="inputBox">
                <span>Address Line 2</span>
                <input type="text" placeholder="e.g. Street Name" name="street" required>
            </div>
            <div class="inputBox">
                <span>City</span>
                <input type="text" placeholder="e.g. Mumbai" name="city" required>
            </div>
            <div class="inputBox">
                <span>State</span>
                <input type="text" placeholder="e.g. Maharashtra" name="state" required>
            </div>
            <div class="inputBox">
                <span>Country</span>
                <input type="text" placeholder="e.g. India" name="country" required>
            </div>
            <div class="inputBox">
                <span>Pin Code</span>
                <input type="text" placeholder="e.g. 123456" name="pin_code" required>
            </div>
        </div>
        <input type="submit" value="Order Now" name="order_btn" class="btn">
    </form>
</section>
</div>

<!-- Custom JS file link -->
<script src="js/script.js"></script>
   
</body>
</html>
