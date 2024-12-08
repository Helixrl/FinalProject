<?php
// config.php - Database configuration
$host = 'localhost'; 
$dbname = 'task_manager'; 
$user = 'chase'; 
$pass = 'chase';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>