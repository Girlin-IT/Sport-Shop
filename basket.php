<?php
session_start(); //
require 'includes/header.php';
require 'includes/db_connect.php';

// Initialize basket if empty
if (!isset($_SESSION['basket'])) { $_SESSION['basket'] = []; }

// Handle adding items
if (isset($_POST['add_to_cart'])) {
    $new_item = [
        'id' => $_POST['product_id'],
        'size' => $_POST['size']
    ];
    $_SESSION['basket'][] = $new_item;
}
?>

<main>
    <div class="contact-section">
        <h2>Your Shopping Basket</h2>
        <?php
        if (empty($_SESSION['basket'])) {
            echo "<p>Your basket is empty.</p>";
        } else {
            foreach ($_SESSION['basket'] as $item) {
                $id = $item['id'];
                $res = mysqli_query($conn, "SELECT name, price FROM products WHERE id=$id");
                $p = mysqli_fetch_assoc($res);
                echo "<p><strong>".$p['name']."</strong> (Size: ".$item['size'].") - £".$p['price']."</p>";
            }
            echo "<button class='buy-btn'>Checkout</button>";
        }
        ?>
    </div>
</main>
<?php require 'includes/footer.php'; ?>