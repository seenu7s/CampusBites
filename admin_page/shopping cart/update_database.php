<?php
@include 'config.php';

// First check if columns already exist
$check_columns = mysqli_query($conn, "SHOW COLUMNS FROM `products` LIKE 'calories'");
if(mysqli_num_rows($check_columns) > 0) {
    echo "Nutritional columns already exist in the products table.";
    exit();
}

// Add nutritional information columns to products table
$alter_products_table = "ALTER TABLE `products` 
    ADD COLUMN calories INT DEFAULT 0,
    ADD COLUMN protein FLOAT DEFAULT 0,
    ADD COLUMN carbs FLOAT DEFAULT 0,
    ADD COLUMN fat FLOAT DEFAULT 0,
    ADD COLUMN fiber FLOAT DEFAULT 0,
    ADD COLUMN vitamins TEXT,
    ADD COLUMN minerals TEXT,
    ADD COLUMN description TEXT";

try {
    if(mysqli_query($conn, $alter_products_table)){
        echo "Products table updated successfully with nutritional information columns.";
    } else {
        echo "Error updating products table: " . mysqli_error($conn);
    }
} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage();
}
?> 