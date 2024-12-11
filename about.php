<?php
session_start();
require 'config.php';

// LLM helped me with the php, gave it a previous demo and told it to make it simple
$message_sent = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);
    
    if (!empty($name) && !empty($email) && !empty($message)) {
        $stmt = $pdo->prepare("INSERT INTO contact_messages (name, email, message) VALUES (:name, :email, :message)");
        if ($stmt->execute(['name' => $name, 'email' => $email, 'message' => $message])) {
            $message_sent = true;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - TaskManager Pro</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Got LLM to help with the php part !-->
    <nav class="main-nav">
        <div class="nav-container">
            <a href="index5.php" class="logo">TaskManager Pro</a>
            <div class="nav-links">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="index5.php">Dashboard</a>
                    <a href="logout.php">Logout</a>
                <?php else: ?>
                    <a href="login.php">Login</a>
                    <a href="register.php">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="about-container">
        <h1>About TaskManager Pro</h1>
        
        <section class="about-content">
            <h2>Our Mission</h2>
            <p>TaskManager Pro is designed to help you stay organized and productive. We believe in simplifying task management to help you focus on what matters most.</p>
            <!-- Used LLM for these php lines !-->
            <?php if ($message_sent): ?>
                <div class="success-message">Thank you for your message! We'll get back to you soon.</div>
            <?php endif; ?>
            
            <h2>Contact Us</h2>
            <form method="POST" action="about.php" class="contact-form">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" required></textarea>
                </div>
                
                <button type="submit">Send Message</button>
            </form>
        </section>
    </div>

    <!-- Used LLM for php part of footer !-->
    <footer class="main-footer">
        <div class="footer-container">
            <p>&copy; <?php echo date('Y'); ?> TaskManager Pro. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>