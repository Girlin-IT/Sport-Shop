<?php
session_start();
session_destroy(); // Clears all user data
header("Location: index.php"); // Send back to home page
exit();
?>