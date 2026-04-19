<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ace Tennis Apparel</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <h1>Ace Tennis Apparel</h1>
    <nav>
        <a href="index.php">Home</a><span class="nav-separator">|</span>
        <a href="shirts.php">Tennis Shirts</a><span class="nav-separator">|</span>
        <a href="contact.php">Contact Us</a>

        <?php if (isset($_SESSION['username'])): ?>
            <span class="nav-separator">|</span>
            <span style="color: green;">Welcome <b><?php echo htmlspecialchars($_SESSION['username']); ?></b></span>
            
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <span class="nav-separator">|</span>
                <a href="add_product.php" style="color: brown; font-weight: bold;">Admin: Add Item</a>
            <?php endif; ?>
            
            <span class="nav-separator">|</span>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <span class="nav-separator">|</span>
            <a href="login.php">Member Login</a><span class="nav-separator">|</span>
            <a href="register.php">Join Us</a>
        <?php endif; ?>
    </nav>
    <hr>
</header>