<?php
require 'includes/db_connect.php';

// Store the command in a variable string
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

// Execute the command
if (mysqli_query($conn, $sql)) {
    echo "<h1>Success!</h1><p>Users table created silently. <a href='register.php'>Go Register</a></p>";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>