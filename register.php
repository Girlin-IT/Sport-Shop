<?php 
require 'includes/header.php'; 
require 'includes/db_connect.php'; 

$message = "";

// Check if the form was submitted
if (isset($_POST['register'])) {
    // Collect and sanitize all THREE inputs
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = $_POST['password'];
    
    // Security Check: See if username or email already exists
    $checkUser = mysqli_query($conn, "SELECT * FROM users WHERE username='$user' OR email='$email'");
    
    if (mysqli_num_rows($checkUser) > 0) {
        $message = "<p style='color: red; font-weight: bold;'>Error: Username or Email already exists.</p>";
    } else {
        // Hash the password for safety
        $hashedPass = password_hash($pass, PASSWORD_DEFAULT);
        
        // THE UPDATED QUERY: Inserting all 4 columns (username, email, password, role)
        $query = "INSERT INTO users (username, email, password, role) VALUES ('$user', '$email', '$hashedPass', 'customer')";
        
        if (mysqli_query($conn, $query)) {
            $message = "<p style='color: green; font-weight: bold;'>Registration successful! <a href='login.php' style='color: #004d40;'>Login here</a></p>";
        } else {
            $message = "<p style='color: red; font-weight: bold;'>Database Error: " . mysqli_error($conn) . "</p>";
        }
    }
}
?>

<main style="display: flex; justify-content: center; align-items: center; min-height: 70vh; padding: 20px;">
    <div style="background: white; padding: 40px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 100%; max-width: 450px; text-align: center; font-family: sans-serif;">
        
        <h2 style="color: #004d40; font-size: 2rem; margin-bottom: 10px;">Become a Member</h2>
        <p style="color: #666; margin-bottom: 25px;">Join Ace Tennis Apparel today.</p>
        
        <?php echo $message; ?>

        <form method="POST">
            <div style="margin-bottom: 15px; text-align: left;">
                <label style="display: block; margin-bottom: 5px; color: #333; font-weight: bold;">Username</label>
                <input type="text" name="username" required 
                       style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;">
            </div>

            <div style="margin-bottom: 15px; text-align: left;">
                <label style="display: block; margin-bottom: 5px; color: #333; font-weight: bold;">Email Address</label>
                <input type="email" name="email" required 
                       style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;">
            </div>

            <div style="margin-bottom: 25px; text-align: left;">
                <label style="display: block; margin-bottom: 5px; color: #333; font-weight: bold;">Password</label>
                <input type="password" name="password" required 
                       style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;">
            </div>

            <button type="submit" name="register" 
                    style="background: #004d40; color: white; padding: 14px; width: 100%; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; font-size: 1rem;">
                Sign Up
            </button>
        </form>
        
        <p style="margin-top: 20px; font-size: 0.9rem; color: #666;">
            Already have an account? <a href="login.php" style="color: #004d40; text-decoration: underline;">Login</a>
        </p>
    </div>
</main>

<?php require 'includes/footer.php'; ?>