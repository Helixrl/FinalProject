<?php

session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['task'])) {
    $task = trim($_POST['task']);
    $due_date = $_POST['due_date'];

    if (!empty($task) && !empty($due_date)) {
        $sql = "INSERT INTO tasks (user_id, task, due_date) VALUES (:user_id, :task, :due_date)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['user_id' => $user_id, 'task' => $task, 'due_date' => $due_date]);

        header('Location: index.php');
        exit;
    }
}

$sql = "SELECT * FROM tasks WHERE user_id = :user_id ORDER BY is_completed, due_date";
$stmt = $pdo->prepare($sql);
$stmt->execute(['user_id' => $user_id]);
$tasks = $stmt->fetchAll();
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
