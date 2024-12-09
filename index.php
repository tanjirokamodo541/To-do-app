<?php
include 'db.php';

// Handle task creation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['task'])) {
    $task = $_POST['task'];
    $sql = "INSERT INTO tasks (task) VALUES ('$task')";
    $conn->query($sql);
}

// Handle task deletion
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM tasks WHERE id = $id";
    $conn->query($sql);
}

// Handle task completion
if (isset($_GET['complete'])) {
    $id = $_GET['complete'];
    $sql = "UPDATE tasks SET status = 'completed' WHERE id = $id";
    $conn->query($sql);
}

// Fetch tasks
$sql = "SELECT * FROM tasks ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">To-Do List</h1>
    
    <!-- Add Task Form -->
    <form method="POST" class="mb-4">
        <div class="input-group">
            <input type="text" name="task" class="form-control" placeholder="Enter a new task" required>
            <button type="submit" class="btn btn-primary">Add Task</button>
        </div>
    </form>

    <!-- Task List -->
    <ul class="list-group">
        <?php while ($row = $result->fetch_assoc()): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span class="<?= $row['status'] == 'completed' ? 'text-decoration-line-through' : '' ?>">
                    <?= htmlspecialchars($row['task']) ?>
                </span>
                <div>
                    <?php if ($row['status'] == 'pending'): ?>
                        <a href="?complete=<?= $row['id'] ?>" class="btn btn-success btn-sm">Complete</a>
                    <?php endif; ?>
                    <a href="?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                </div>
            </li>
        <?php endwhile; ?>
    </ul>
</div>
</body>
</html>
