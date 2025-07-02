<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Register Order</title>
</head>
<body>

<style>
        .container {
            padding: 20px;
        }

        .alert {
            margin-bottom: 20px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }

        img {
            max-width: 100%; /* Make image responsive */
            height: auto;
        }

        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }
        }
    </style>

<div class="container">
    
    
    <?php
    // Database connection
    $conn = mysqli_connect('localhost', 'root', '', 'shop_db');

    if (!$conn) {
        die('<div class="alert alert-danger"><strong>Error!</strong> Database connection failed.</div>');
    }

    // Include QR Code library
    require_once '../phpqrcode/qrlib.php';

    // Sanitize and validate inputs
    $name = mysqli_real_escape_string($conn, $_POST['name'] ?? '');
    $price_total = floatval($_POST['price_total'] ?? 0);
    $total_product = intval($_POST['total_product'] ?? 0);

    if (empty($name) || $price_total <= 0 || $total_product <= 0) {
        //echo '<div class="alert alert-warning"><strong>Warning!</strong> Invalid input. Please try again.</div>';
    } else {
        // Check if the name is already registered
        $stmt = $conn->prepare("SELECT * FROM `order` WHERE name = ?");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            // Insert new record
            $stmt = $conn->prepare("INSERT INTO `order` (name, total_products, total_price, created_at) VALUES (?, ?, ?, NOW())");
            $stmt->bind_param("sii", $name, $total_product, $price_total);

            if ($stmt->execute()) {
                // Generate QR Code
                $path = 'qrcodes/';
                if (!is_dir($path)) {
                    mkdir($path, 0755, true); // Ensure directory exists
                }
                $qr_content = "Order Details:\nName: $name\nTotal Products: $total_product\nTotal Price: $$price_total";
                $filename = $path . time() . ".png";
                QRcode::png($qr_content, $filename);

                // Success message with QR code
                echo '<div class="alert alert-success"><strong>Success!</strong> Order successfully registered.</div>';
                echo '<p>' . date('l jS \of F Y h:i:s A') . '</p>';
                echo '<h4>Order Details</h4>';
                echo '<ul>';
                echo "<li><strong>Name:</strong> $name</li>";
                echo "<li><strong>Total Products:</strong> $total_product</li>";
                echo "<li><strong>Total Price:</strong> $$price_total</li>";
                echo '</ul>';
                echo '<h4>Scan QR Code for Order Details:</h4>';
                echo "<img src='$filename' alt='QR Code' style='width:200px; height:200px;'>";
            } else {
                echo '<div class="alert alert-danger"><strong>Error!</strong> Could not register order. Please try again later.</div>';
            }
        } else {
            // Record already exists
            echo '<div class="alert alert-warning"><strong>Notice!</strong> Order is already registered.</div>';
            echo '<p>' . date('l jS \of F Y h:i:s A') . '</p>';
        }
        $stmt->close();
    }

    // Close database connection
    mysqli_close($conn);
    ?>
</div>

</body>
</html>
