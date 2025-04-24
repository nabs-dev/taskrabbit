<?php
session_start();
if (!isset($_SESSION['user'])) die("Login required");
$conn = new mysqli("localhost", "u8gr0sjr9p4p4", "9yxuqyo3mt85", "db6egnojziu599");
$user = $_SESSION['user'];
$isWorker = $user['role'] === 'worker';
$tasks = $isWorker
  ? $conn->query("SELECT t.*, u.name as posted_by FROM tasks t JOIN users u ON t.user_id = u.id")
  : $conn->query("SELECT * FROM tasks WHERE user_id=" . $user['id']);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <style>
    body { font-family: sans-serif; background: #f4f7f6; margin: 0; }
    header { background: #333; color: white; padding: 15px; display: flex; justify-content: space-between; }
    .container { padding: 20px; }
    .task { background: white; margin-bottom: 15px; padding: 15px; border-radius: 8px; box-shadow: 0 0 8px rgba(0,0,0,0.05); }
    .task h3 { margin: 0; }
    button { padding: 8px 12px; background: #007bff; color: white; border: none; border-radius: 5px; }
  </style>
</head>
<body>
  <header>
    <div>Welcome, <?= $user['name'] ?> (<?= ucfirst($user['role']) ?>)</div>
    <div>
      <?php if (!$isWorker): ?>
        <button onclick="location.href='post_task.php'">Post Task</button>
      <?php endif; ?>
      <button onclick="location.href='logout.php'">Logout</button>
    </div>
  </header>
  <div class="container">
    <h2><?= $isWorker ? 'Available Tasks' : 'My Posted Tasks' ?></h2>
    <?php while($row = $tasks->fetch_assoc()): ?>
      <div class="task">
        <h3><?= $row['title'] ?> - $<?= $row['budget'] ?></h3>
        <p><?= $row['description'] ?></p>
        <p><strong>Location:</strong> <?= $row['location'] ?> | <strong>Deadline:</strong> <?= $row['deadline'] ?></p>
        <?php if ($isWorker): ?>
          <form method="post" action="apply_task.php">
            <input type="hidden" name="task_id" value="<?= $row['id'] ?>">
            <button type="submit">Apply</button>
          </form>
        <?php else: ?>
          <form method="post" action="update_status.php">
            <input type="hidden" name="task_id" value="<?= $row['id'] ?>">
            <select name="status">
              <option value="Pending" <?= $row['status']=='Pending'?'selected':'' ?>>Pending</option>
              <option value="In Progress" <?= $row['status']=='In Progress'?'selected':'' ?>>In Progress</option>
              <option value="Completed" <?= $row['status']=='Completed'?'selected':'' ?>>Completed</option>
            </select>
            <button type="submit">Update</button>
          </form>
        <?php endif; ?>
      </div>
    <?php endwhile; ?>
  </div>
</body>
</html>
