<?php
require 'includes/db_connect.php';

// Delete the old table 
mysqli_query($conn, "DROP TABLE IF EXISTS users");

// Create the Users Table with the 'role' column included
$tableSql = "CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'customer') DEFAULT 'customer'
)";

if (mysqli_query($conn, $tableSql)) {
    echo "<h3>1. Users table REBUILT successfully!</h3>";
} else {
    die("Error rebuilding table: " . mysqli_error($conn));
}

// Add the Admin Account (Password: admin123)
$adminPass = password_hash('admin123', PASSWORD_DEFAULT);
$adminSql = "INSERT INTO users (username, password, role) VALUES ('admin', '$adminPass', 'admin')";

// Add a Regular Member Account (Password: tennis123)
$custPass = password_hash('tennis123', PASSWORD_DEFAULT);
$custSql = "INSERT INTO users (username, password, role) VALUES ('player1', '$custPass', 'customer')";

if (mysqli_query($conn, $adminSql) && mysqli_query($conn, $custSql)) {
    echo "<h3>2. Test accounts created!</h3>";
    echo "<p>Try logging in now at <a href='login.php'>login.php</a></p>";
} else {
    echo "Error inserting accounts: " . mysqli_error($conn);
}
?>