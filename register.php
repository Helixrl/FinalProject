<?php
session_start();
require 'config.php';
// Register Page
$error = '';
// Used LLM for most of my php, i wrote the first block and last block of php myself
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    if (!empty($username) && !empty($password)) {
        // Check if username exists
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        if ($stmt->fetchColumn() > 0) {
            $error = "Username already exists";
        } else {
            // Create new user
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
            if ($stmt->execute(['username' => $username, 'password' => $hashed_password])) {
                header('Location: login.php');
                exit;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - TaskManager Pro</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav class="main-nav">
        <div class="nav-container">
            <a href="index5.php" class="logo">TaskManager Pro</a>
            <div class="nav-links">
                <a href="login.php">Login</a>
            </div>
        </div>
    </nav>
    <!-- Used LLM for the error php line !-->
    <div class="form-container">
        <h1>Register</h1>
        <?php if ($error): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        
        <form method="POST" action="register.php">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit">Register</button>
        </form>
        
        <p class="form-footer">
            Already have an account? <a href="login.php">Login here</a>
        </p>
    </div>

    <footer class="main-footer">
        <div class="footer-container">
            <p>&copy; <?php echo date('Y'); ?> TaskManager Pro. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>