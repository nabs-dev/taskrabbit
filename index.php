<?php
session_start();
$conn = new mysqli("localhost", "u8gr0sjr9p4p4", "9yxuqyo3mt85", "db6egnojziu599");
$tasks = $conn->query("SELECT * FROM tasks");
?>
<!DOCTYPE html>
<html>
<head>
  <title>TaskRabbit Clone - Home</title>
  <style>
    body { font-family: Arial; background: #f9f9f9; margin: 0; }
    header { background: #4CAF50; color: white; padding: 15px; text-align: center; font-size: 24px; }
    .container { padding: 20px; }
    .task { background: white; padding: 15px; margin-bottom: 15px; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }
    .task h3 { margin: 0 0 10px; }
    .filters { margin-bottom: 20px; }
    .filters select { padding: 5px; }
    button { padding: 8px 15px; background: #4CAF50; border: none; color: white; cursor: pointer; border-radius: 5px; }
  </style>
</head>
<body>
<header>TaskRabbit Clone</header>
<div class="container">
  <div class="filters">
    <label>Filter by Category:</label>
    <select onchange="filterTasks(this.value)">
      <option value="">All</option>
      <option value="Cleaning">Cleaning</option>
      <option value="Delivery">Delivery</option>
      <option value="Repair">Repair</option>
    </select>
    <button onclick="redirectTo('login.php')">Login</button>
    <button onclick="redirectTo('post_task.php')">Post a Task</button>
  </div>

  <div id="task-list">
    <?php while($row = $tasks->fetch_assoc()): ?>
      <div class="task" data-cat="<?= $row['category'] ?>">
        <h3><?= $row['title'] ?></h3>
        <p><strong>Budget:</strong> $<?= $row['budget'] ?> | <strong>Location:</strong> <?= $row['location'] ?></p>
        <p><?= $row['description'] ?></p>
      </div>
    <?php endwhile; ?>
  </div>
</div>
<script>
  function redirectTo(file) {
    window.location.href = file;
  }
  function filterTasks(cat) {
    let tasks = document.querySelectorAll('.task');
    tasks.forEach(task => {
      task.style.display = (!cat || task.dataset.cat === cat) ? 'block' : 'none';
    });
  }
</script>
</body>
</html>
