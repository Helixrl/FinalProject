<?php

session_start();
require 'config.php';
// Used LLM (Copilot) to help me with the logic for creating a better looking dashboard with more features
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['task'])) {
    if (isset($_SESSION['user_id'])) {
        $task = trim($_POST['task']);
        $due_date = $_POST['due_date'];
        
        if (!empty($task) && !empty($due_date)) {
            $sql = "INSERT INTO tasks (user_id, task, due_date) VALUES (:user_id, :task, :due_date)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'user_id' => $_SESSION['user_id'],
                'task' => $task,
                'due_date' => $due_date
            ]);
        }
    }
    header('Location: index5.php');
    exit;
}
// Used LLM to help with deleting task and making it look nicer
if (isset($_POST['delete_task']) && isset($_SESSION['user_id'])) {
    $task_id = $_POST['task_id'];
    $sql = "DELETE FROM tasks WHERE id = :id AND user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $task_id, 'user_id' => $_SESSION['user_id']]);
    header('Location: index5.php');
    exit;
}
// Used LLM to help with the complete task function and making it not look bland
if (isset($_POST['complete_task']) && isset($_SESSION['user_id'])) {
    $task_id = $_POST['task_id'];
    $sql = "UPDATE tasks SET is_completed = NOT is_completed WHERE id = :id AND user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $task_id, 'user_id' => $_SESSION['user_id']]);
    header('Location: index5.php');
    exit;
}

$tasks = [];
if (isset($_SESSION['user_id'])) {
    $sql = "SELECT * FROM tasks WHERE user_id = :user_id ORDER BY is_completed, due_date";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user_id' => $_SESSION['user_id']]);
    $tasks = $stmt->fetchAll();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Task Manager</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<!-- Used LLM to incorperate all the php seen in the html (could not figure out how to incorperate it) !-->
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