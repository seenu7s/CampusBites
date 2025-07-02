<?php
@include 'config.php';

// First, let's check if the products table exists
$check_table = mysqli_query($conn, "SHOW TABLES LIKE 'products'");
if(mysqli_num_rows($check_table) == 0) {
    echo "The products table does not exist. Creating it now...<br>";
    
    // Create the products table with all required columns
    $create_table = "CREATE TABLE `products` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(255) NOT NULL,
        `price` decimal(10,2) NOT NULL,
        `image` varchar(255) NOT NULL,
        `calories` int(11) DEFAULT 0,
        `protein` float DEFAULT 0,
        `carbs` float DEFAULT 0,
        `fat` float DEFAULT 0,
        `fiber` float DEFAULT 0,
        `vitamins` text,
        `minerals` text,
        `description` text,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    
    if(mysqli_query($conn, $create_table)) {
        echo "Products table created successfully!<br>";
    } else {
        echo "Error creating products table: " . mysqli_error($conn) . "<br>";
        exit();
    }
} else {
    echo "Products table exists. Checking columns...<br>";
    
    // Check if nutritional columns exist
    $columns_to_check = ['calories', 'protein', 'carbs', 'fat', 'fiber', 'vitamins', 'minerals', 'description'];
    $missing_columns = [];
    
    foreach($columns_to_check as $column) {
        $check_column = mysqli_query($conn, "SHOW COLUMNS FROM `products` LIKE '$column'");
        if(mysqli_num_rows($check_column) == 0) {
            $missing_columns[] = $column;
        }
    }
    
    if(count($missing_columns) > 0) {
        echo "Missing columns: " . implode(', ', $missing_columns) . "<br>";
        echo "Adding missing columns...<br>";
        
        // Add each missing column
        foreach($missing_columns as $column) {
            $column_type = '';
            switch($column) {
                case 'calories':
                    $column_type = 'INT DEFAULT 0';
                    break;
                case 'protein':
                case 'carbs':
                case 'fat':
                case 'fiber':
                    $column_type = 'FLOAT DEFAULT 0';
                    break;
                case 'vitamins':
                case 'minerals':
                case 'description':
                    $column_type = 'TEXT';
                    break;
            }
            
            $add_column = "ALTER TABLE `products` ADD COLUMN `$column` $column_type";
            if(mysqli_query($conn, $add_column)) {
                echo "Added column '$column' successfully!<br>";
            } else {
                echo "Error adding column '$column': " . mysqli_error($conn) . "<br>";
            }
        }
    } else {
        echo "All nutritional columns already exist in the products table.<br>";
    }
}

echo "<br>Database check and update complete. You can now <a href='admin.php'>go back to the admin panel</a>.";
?> 