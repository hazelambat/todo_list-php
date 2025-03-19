<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <h2>Todo List</h2>
            <a href="#">New Task</a>
        </aside>

        <!-- Main Content -->
        <main class="content">
            <div class="task-container"> 
                
                <!-- "New Task" Form -->
                <div class="task-form">
                    <h3>New Task</h3>
                    <form method="POST" action="add_task.php">
                        <input type="text" name="task_name" placeholder="Enter task name" required>
                        <button type="submit">Add Task</button>
                    </form>
                </div>
                
                <!-- "Task Lists" -->
                <div class="task-wrapper">
                    <section class="task-section">
                        <h3>Task Lists</h3>
                        <?php
                        include 'db.php';
                        $pending_tasks = mysqli_query($conn, "SELECT id, task_name FROM tasks WHERE is_completed = 0");
                        $completed_tasks = mysqli_query($conn, "SELECT id, task_name, completed_at FROM tasks WHERE is_completed = 1 ORDER BY completed_at DESC");
                        ?>
                        <?php while ($row = mysqli_fetch_assoc($pending_tasks)) : ?>
                            <div class="task-item">
                                <span><?php echo htmlspecialchars($row['task_name']); ?></span>
                                <div class="task-buttons">
                                    <a href="complete_task.php?id=<?php echo $row['id']; ?>" class="btn btn-complete">Complete</a>
                                    <a href="delete_task.php?id=<?php echo $row['id']; ?>" class="btn btn-delete">Delete</a>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </section>
                </div>
                
                <!-- "Completed Tasks" -->
                <section class="task-section completed-tasks">
                    <h3>Completed Tasks</h3>
                    <?php while ($row = mysqli_fetch_assoc($completed_tasks)) : ?>
                        <div class="task-item completed">
                            <span><?php echo htmlspecialchars($row['task_name']); ?></span>
                        </div>
                    <?php endwhile; ?>
                </section>
            </div>
        </main>
    </div>
</body>
</html>

<?php
mysqli_close($conn);
?>
