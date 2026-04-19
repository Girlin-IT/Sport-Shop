<?php
require 'includes/db_connect.php';

// Add new columns
$sql_alter = "ALTER TABLE products 
              ADD COLUMN IF NOT EXISTS image VARCHAR(255) DEFAULT 'default.png',
              ADD COLUMN IF NOT EXISTS sizes VARCHAR(100) DEFAULT 'S, M, L, XL'";
mysqli_query($conn, $sql_alter);

// Insert a detailed product for testing
$sql_insert = "INSERT INTO products (name, price, description, image, sizes) 
               VALUES ('Pro Aero Shirt', 45.00, 'High-performance moisture-wicking fabric.', 'pro_aero.png', 'S, M, L, XL')";
mysqli_query($conn, $sql_insert);

echo "Database updated! <a href='shirts.php'>View Products</a>";
?>