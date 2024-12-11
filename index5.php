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

        header('Location: index5.php');
        exit;
    }
}

$sql = "SELECT * FROM tasks WHERE user_id = :user_id ORDER BY is_completed, due_date";
$stmt = $pdo->prepare($sql);
$stmt->execute(['user_id' => $user_id]);
$tasks = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Task Manager</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="main-container">
    <h1>Task Manager</h1>
    <p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
    <a href="logout.php">Logout</a>

    <h2>Your Tasks</h2>
    <ul>
        <?php foreach ($tasks as $task): ?>
            <li>
                <?php echo htmlspecialchars($task['task']); ?> 
                - <?php echo htmlspecialchars($task['due_date']); ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <h2>Add Task</h2>
    <form method="POST" action="index5.php">
        <input type="text" name="task" placeholder="Task description" required>
        <input type="date" name="due_date" required>
        <button type="submit">Add Task</button>
    </form>
</div>
</body>
</html>