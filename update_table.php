<?php
require 'includes/db_connect.php';

// Add the email column to the users table
$sql = "ALTER TABLE users ADD COLUMN email VARCHAR(100) NOT NULL AFTER username";

if (mysqli_query($conn, $sql)) {
    echo "<h3>Success! Email column added to the database.</h3>";
} else {
    // If it's already there, it should show an error
    echo "<h3>Note: " . mysqli_error($conn) . "</h3>";
}

// add a fake email for the admin so it stays valid
$updateAdmin = "UPDATE users SET email = 'admin@ace.com' WHERE username = 'admin'";
mysqli_query($conn, $updateAdmin);

echo "<p>You can now delete this file and use your updated <a href='register.php'>Registration Page</a>.</p>";
?>