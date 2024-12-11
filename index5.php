<?php

session_start();
require 'config.php';
// Used LLM (Copilot) to help me with the logic for creating a better looking dashboard with more features
// Prompted it to make the php simple and refered to previous demos
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
// Used LLM (Copilot) to make the delete task look good and to also help with the sql part
if (isset($_POST['delete_task']) && isset($_SESSION['user_id'])) {
    $task_id = $_POST['task_id'];
    $sql = "DELETE FROM tasks WHERE id = :id AND user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $task_id, 'user_id' => $_SESSION['user_id']]);
    header('Location: index5.php');
    exit;
}
// Used LLM (Copilot) also added complete task function, wanted it to prompt a color as well
if (isset($_POST['complete_task']) && isset($_SESSION['user_id'])) {
    $task_id = $_POST['task_id'];
    $sql = "UPDATE tasks SET is_completed = NOT is_completed WHERE id = :id AND user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $task_id, 'user_id' => $_SESSION['user_id']]);
    header('Location: index5.php');
    exit;
}
// Got This block of code from previous demos and asked an LLM to help fix it for my website because it wasnt working
$tasks = [];
if (isset($_SESSION['user_id'])) {
    $sql = "SELECT * FROM tasks WHERE user_id = :user_id ORDER BY is_completed, due_date";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user_id' => $_SESSION['user_id']]);
    $tasks = $stmt->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskManager Pro</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Got LLM to help me with the class structure because i strugle with that !-->
     <!-- Also got LLM (ChatGPT) to help with the php in all the html because that was also a struggle !-->
    <nav class="main-nav">
        <div class="nav-container">
            <a href="index5.php" class="logo">TaskManager Pro</a>
            <div class="nav-links">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="about.php">About</a>
                    <a href="logout.php">Logout</a>
                <?php else: ?>
                    <a href="login.php">Login</a>
                    <a href="register.php">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <?php if (!isset($_SESSION['user_id'])): ?>

        <section class="hero">
            <div class="hero-content">
                <h1>Welcome to TaskManager Pro</h1>
                <p>Organize your life, one task at a time</p>
                <a href="register.php" class="cta-button">Get Started</a>
            </div>
        </section>
        <!-- Got LLM to help with the class structure again for what i wanted to do, didnt add any code though, just helped me step through it !-->
        <section class="features">
            <div class="container">
                <h2>Why Choose TaskManager Pro?</h2>
                <div class="feature-grid">
                    <div class="feature-card">
                        <h3>Simple Organization</h3>
                        <p>Keep track of all your tasks in one place</p>
                    </div>
                    <div class="feature-card">
                        <h3>Due Dates</h3>
                        <p>Never miss a deadline again</p>
                    </div>
                    <div class="feature-card">
                        <h3>Progress Tracking</h3>
                        <p>Monitor your productivity</p>
                    </div>
                </div>
            </div>
        </section>
    <?php else: ?>
        <!-- Got LLM to help with the dashboard !-->
        <div class="dashboard-container">
            <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
            
            <!-- Add Task Form -->
            <div class="task-form">
                <h2>Add New Task</h2>
                <form method="POST" action="index5.php">
                    <input type="text" name="task" placeholder="Task description" required>
                    <input type="date" name="due_date" required>
                    <button type="submit">Add Task</button>
                </form>
            </div>
            
            <!-- Task List (Got LLM to help with php parts) -->
            <div class="task-list">
                <?php foreach ($tasks as $task): ?>
                    <div class="task-card <?php echo $task['is_completed'] ? 'completed' : ''; ?>">
                        <h3><?php echo htmlspecialchars($task['task']); ?></h3>
                        <p>Due: <?php echo htmlspecialchars($task['due_date']); ?></p>
                        <div class="task-actions">
                            <form method="POST" action="index5.php" style="display: inline;">
                                <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                                <button type="submit" name="complete_task">
                                    <?php echo $task['is_completed'] ? 'Mark Incomplete' : 'Complete'; ?>
                                </button>
                            </form>
                            <form method="POST" action="index5.php" style="display: inline;">
                                <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                                <button type="submit" name="delete_task" class="delete-btn">Delete</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Got LLM to help with the php line below !-->
    <footer class="main-footer">
        <div class="footer-container">
            <p>&copy; <?php echo date('Y'); ?> TaskManager Pro. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>