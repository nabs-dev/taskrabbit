<?php
$conn = new mysqli("localhost", "u8gr0sjr9p4p4", "9yxuqyo3mt85", "db6egnojziu599");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name']; $email = $_POST['email']; $pass = $_POST['password']; $role = $_POST['role'];
  $conn->query("INSERT INTO users (name,email,password,role) VALUES ('$name','$email','$pass','$role')");
  echo "<script>alert('Signup successful!'); window.location='login.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Signup</title>
  <style>
    body { font-family: sans-serif; background: #eef2f3; }
    .form-box { width: 350px; margin: 80px auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 15px rgba(0,0,0,0.1); }
    h2 { text-align: center; }
    input, select { width: 100%; margin: 10px 0; padding: 10px; border-radius: 5px; border: 1px solid #ccc; }
    button { width: 100%; padding: 10px; background: #28a745; color: white; border: none; border-radius: 5px; }
  </style>
</head>
<body>
  <div class="form-box">
    <h2>Signup</h2>
    <form method="post">
      <input name="name" placeholder="Full Name" required>
      <input name="email" type="email" placeholder="Email" required>
      <input name="password" type="password" placeholder="Password" required>
      <select name="role">
        <option value="user">User</option>
        <option value="worker">Worker</option>
      </select>
      <button type="submit">Register</button>
    </form>
  </div>
</body>
</html>
