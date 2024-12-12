<?php
session_start();
require 'config.php';
// Login Page
$error = '';
// Used some LLM for correcting my php, got most of it using the other pages as reference
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    if (!empty($username) && !empty($password)) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: index5.php');
            exit;
        } else {
            $error = "Invalid username or password";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TaskManager Pro</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav class="main-nav">
        <div class="nav-container">
            <a href="index5.php" class="logo">TaskManager Pro</a>
            <div class="nav-links">
                <a href="register.php">Register</a>
            </div>
        </div>
    </nav>
    <!-- Used LLM for the PHP !-->
    <div class="form-container">
        <h1>Login</h1>
        <?php if ($error): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        
        <form method="POST" action="login.php">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit">Login</button>
        </form>
        <!-- Used LLM for the PHP !-->
        <p class="form-footer">
            Don't have an account? <a href="register.php">Register here</a>
        </p>
    </div>

    <footer class="main-footer">
        <div class="footer-container">
            <p>&copy; <?php echo date('Y'); ?> TaskManager Pro. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>