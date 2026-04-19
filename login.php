<?php 
require 'includes/header.php'; 
require 'includes/db_connect.php'; 

$error = "";

if (isset($_POST['login'])) {
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = '$user'";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($pass, $row['password'])) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];
            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid Password!";
        }
    } else {
        $error = "User not found!";
    }
}
?>

<main style="display: flex; justify-content: center; align-items: center; min-height: 60vh;">
    <div style="background: white; padding: 40px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 100%; max-width: 400px; text-align: center; font-family: sans-serif;">
        <h2 style="color: #004d40; margin-bottom: 20px;">Member Login</h2>
        
        <?php if($error): ?>
            <p style="color: red; font-weight: bold;"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="POST">
            <div style="margin-bottom: 15px; text-align: left;">
                <label style="display: block; margin-bottom: 5px; color: #666;">Username</label>
                <input type="text" name="username" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;">
            </div>

            <div style="margin-bottom: 25px; text-align: left;">
                <label style="display: block; margin-bottom: 5px; color: #666;">Password</label>
                <input type="password" name="password" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;">
            </div>

            <button type="submit" name="login" style="background: #004d40; color: white; padding: 12px; width: 100%; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; font-size: 1rem;">
                Login
            </button>
        </form>
        
        <p style="margin-top: 20px; font-size: 0.9rem;">Not a member? <a href="register.php" style="color: #004d40; text-decoration: underline;">Join Us</a></p>
    </div>
</main>

<?php require 'includes/footer.php'; ?>