<?php 
// Pull in the header which contains the opening <html> and <body> tags
require 'includes/header.php'; 
?>

<main>
    <div class="contact-section">
        <?php
        // PHP Logic: Check if the form was submitted
        if (isset($_POST['submit_contact'])) {
            // Sanitize inputs for safety
            $name = htmlspecialchars($_POST['user_name']);
            $email = htmlspecialchars($_POST['user_email']);
            $subject = htmlspecialchars($_POST['user_subject']);
            
            // Success Message Box
            echo "<div class='success-msg'>";
            echo "<h3>Message Sent!</h3>";
            echo "<p>Thanks, <strong>$name</strong>. We've received your message about <strong>$subject</strong>.</p>";
            echo "<p>We will get back to you at <em>$email</em> shortly.</p>";
            echo "</div>";
        }
        ?>

        <h2>Contact Ace Tennis Apparel</h2>
        <p>Have a question about our Grand Slam collections? Get in touch with our specialist team.</p>

        <form action="contact.php" method="POST" class="contact-form">
            
            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="user_name" placeholder="Enter your name" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" id="email" name="user_email" placeholder="email@example.com" required>
            </div>

            <div class="form-group">
                <label for="subject">Inquiry Subject:</label>
                <select id="subject" name="user_subject">
                    <option value="General Inquiry">General Inquiry</option>
                    <option value="Order Status">Order Status</option>
                    <option value="Returns/Exchanges">Returns/Exchanges</option>
                    <option value="Stock Availability">Stock Availability</option>
                </select>
            </div>

            <div class="form-group">
                <label for="message">Your Message:</label>
                <textarea id="message" name="user_message" rows="6" placeholder="How can we help you today?" required></textarea>
            </div>

            <button type="submit" name="submit_contact" class="submit-btn">Send Message</button>
        </form>
    </div>
</main>

<?php 
// Pull in the footer which contains the closing </body> and </html> tags
require 'includes/footer.php'; 
?>