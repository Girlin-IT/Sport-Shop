<?php 
require 'includes/header.php'; 
require 'includes/db_connect.php'; 

// --- SECURITY GATEKEEPER ---
// Only allow users with the 'admin' role to see this page
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "<div style='text-align:center; padding:50px; font-family:sans-serif;'>";
    echo "<h2>Access Denied</h2>";
    echo "<p>You do not have permission to add products. Please <a href='login.php'>Login as Admin</a>.</p>";
    echo "</div>";
    require 'includes/footer.php';
    exit(); // Stop the script here
}

//  FORM PROCESSING LOGIC
if (isset($_POST['submit_product'])) {
    // Sanitize inputs to prevent SQL Injection 
    $name  = mysqli_real_escape_string($conn, $_POST['p_name']);
    $price = mysqli_real_escape_string($conn, $_POST['p_price']);
    $desc  = mysqli_real_escape_string($conn, $_POST['p_desc']);
    
    // Handle File Upload
    $target_dir  = "images/";
    $file_name   = basename($_FILES["p_image"]["name"]);
    $target_file = $target_dir . $file_name;
    $uploadOk    = 1;

    // Move file from temporary memory to your images folder
    if (move_uploaded_file($_FILES["p_image"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO products (name, price, description, image) 
                VALUES ('$name', '$price', '$desc', '$file_name')";
        
        if (mysqli_query($conn, $sql)) {
            $message = "<p style='color:green; font-weight:bold;'>Success! Product added to the shop.</p>";
        } else {
            $message = "<p style='color:red;'>Database Error: " . mysqli_error($conn) . "</p>";
        }
    } else {
        $message = "<p style='color:red;'>Error: Failed to upload image file.</p>";
    }
}
?>

<main style="background-color: #f4f4f4; padding: 40px 20px;">
    <section style="max-width: 600px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); font-family: sans-serif;">
        <h2 style="text-align:center; color:#004d40; margin-bottom:20px;">Admin: Add New Product</h2>
        
        <?php if(isset($message)) echo $message; ?>

        <form action="add_product.php" method="POST" enctype="multipart/form-data">
            <label style="display:block; margin-bottom:5px; font-weight:bold;">Product Name:</label>
            <input type="text" name="p_name" required placeholder="e.g. Pro Aero Shirt" style="width:100%; padding:10px; margin-bottom:20px; border:1px solid #ccc; border-radius:4px;">

            <label style="display:block; margin-bottom:5px; font-weight:bold;">Price (£):</label>
            <input type="number" step="0.01" name="p_price" required placeholder="29.99" style="width:100%; padding:10px; margin-bottom:20px; border:1px solid #ccc; border-radius:4px;">

            <label style="display:block; margin-bottom:5px; font-weight:bold;">Description:</label>
            <textarea name="p_desc" required placeholder="Describe the material and fit..." style="width:100%; padding:10px; margin-bottom:20px; border:1px solid #ccc; border-radius:4px; height:100px;"></textarea>

            <label style="display:block; margin-bottom:5px; font-weight:bold;">Product Image:</label>
            <input type="file" name="p_image" accept="image/*" required style="margin-bottom:30px;">

            <button type="submit" name="submit_product" style="background:#004d40; color:white; padding:15px; width:100%; border:none; border-radius:5px; cursor:pointer; font-weight:bold; font-size:1rem;">Upload to Database</button>
        </form>
        
        <p style="text-align:center; margin-top:20px;"><a href="shirts.php" style="color:#666; text-decoration:none;">&larr; Back to Shop</a></p>
    </section>
</main>

<?php require 'includes/footer.php'; ?>