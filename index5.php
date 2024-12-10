<?php

session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}

// Handle book search
$search_results = null;
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search_term = '%' . $_GET['search'] . '%';
    $search_sql = 'SELECT id, artist, title, real_name FROM books WHERE title LIKE :search';
    $search_stmt = $pdo->prepare($search_sql);
    $search_stmt->execute(['search' => $search_term]);
    $search_results = $search_stmt->fetchAll();
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['artist']) && isset($_POST['title']) && isset($_POST['real_name'])) {
        // Insert new entry
        $artist = htmlspecialchars($_POST['artist']);
        $title = htmlspecialchars($_POST['title']);
        $real_name = htmlspecialchars($_POST['real_name']);
        
        $insert_sql = 'INSERT INTO books (artist, title, real_name) VALUES (:artist, :title, :real_name)';
        $stmt_insert = $pdo->prepare($insert_sql);
        $stmt_insert->execute(['artist' => $artist, 'title' => $title, 'real_name' => $real_name]);
    } elseif (isset($_POST['delete_id'])) {
        // Delete an entry
        $delete_id = (int) $_POST['delete_id'];
        
        $delete_sql = 'DELETE FROM books WHERE id = :id';
        $stmt_delete = $pdo->prepare($delete_sql);
        $stmt_delete->execute(['id' => $delete_id]);
    }
}

// Get all books for main table
$sql = 'SELECT id, artist, title, real_name FROM books';
$stmt = $pdo->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personalized Task Manager</title>
    <link rel="stylesheet" href="styles.css">

</head>
<body>
    <!-- Hero Section -->
    <header class="hero">
        <h1>Personalized Task Manager</h1>
        <p>Organize your task, track your progress, and achieve your goals effortlessly.</p>
    </header>
    <!-- First Row -->
    <section class="row-1">
        <div class="row">
            <article class="text-left">
                <h2>Final</h2>
                <p>Final</p>
            </article>
            <img src="image" alt="image">
        </div>
    </section>

    <!-- Second Row -->
    <section class="row-2">
        <div class="row">
            <img src="image" alt="image">
            <article class="text-right">
                <h2>Final</h2>
                <p>Final</p>
            </article>
        </div>

        <!-- Flexbox Row with Three Cards -->
        <div class="flex-cards">
            <article class="card">
                <h3>Final</h3>
                <p>Final</p>
            </article>
            <article class="card">
                <h3>Final</h3>
                <p>Final</p>
            </article>
            <article class="card">
                <h3>Final</h3>
                <p>Final</p>
            </article>
        </div>
    </section>
</body>
</html>
