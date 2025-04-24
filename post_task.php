<?php
session_start();
if (!isset($_SESSION['user'])) die("Login required");
$conn = new mysqli("localhost", "u8gr0sjr9p4p4", "9yxuqyo3mt85", "db6egnojziu599");
if ($_POST) {
  extract($_POST);
  $uid = $_SESSION['user']['id'];
  $conn->query("INSERT INTO tasks (user_id, title, description, budget, deadline, location, category) 
                VALUES ($uid, '$title', '$desc', '$budget', '$deadline', '$location', '$category')");
  echo "<script>alert('Task posted!'); window.location='dashboard.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Post Task</title>
  <style>
    body { font-family: sans-serif; background: #e0f7fa; }
    .form-box { width: 400px; margin: 50px auto; background: white; padding: 25px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    input, textarea, select { width: 100%; margin: 10px 0; padding: 8px; border-radius: 5px; border: 1px solid #ccc; }
    button { width: 100%; padding: 10px; background: #00796B; color: white; border: none; border-radius: 5px; }
  </style>
</head>
<body>
  <div class="form-box">
    <h2>Post a New Task</h2>
    <form method="post">
      <input name="title" placeholder="Task Title" required>
      <textarea name="desc" placeholder="Description" required></textarea>
      <input name="budget" type="number" placeholder="Budget $" required>
      <input name="deadline" type="date" required>
      <input name="location" placeholder="Location" required>
      <select name="category">
        <option>Cleaning</option>
        <option>Delivery</option>
        <option>Repair</option>
      </select>
      <button type="submit">Post Task</button>
    </form>
  </div>
</body>
</html>
