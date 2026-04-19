<?php
require 'includes/db_connect.php';

// Add columns for images and available sizes
$sql = "ALTER TABLE products 
        ADD COLUMN image VARCHAR(255) DEFAULT 'default_shirt.png',
        ADD COLUMN sizes VARCHAR(100) DEFAULT 'S, M, L, XL'";

if (mysqli_query($conn, $sql)) {
    echo "<h1>Database Updated Successfully!</h1>";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>