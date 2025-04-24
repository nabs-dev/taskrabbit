<?php
session_start();
$conn = new mysqli("localhost", "u8gr0sjr9p4p4", "9yxuqyo3mt85", "db6egnojziu599");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = $_POST['email']; $pass = $_POST['password'];
  $res = $conn->query("SELECT * FROM users WHERE email='$email' AND password='$pass'");
  if ($res->num_rows) {
    $data = $res->fetch_assoc();
    $_SESSION['user'] = $data;
    echo "<script>window.location='dashboard.php';</script>";
  } else echo "<script>alert('Invalid credentials');</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <style>
    body { font-family: sans-serif; background: #f0f0f0; }
    .form-box { width: 350px; margin: 100px auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    h2 { text-align: center; }
    input { width: 100%; margin: 10px 0; padding: 10px; border-radius: 5px; border: 1px solid #ccc; }
    button { width: 100%; padding: 10px; background: #007bff; color: white; border: none; border-radius: 5px; }
  </style>
</head>
<body>
  <div class="form-box">
    <h2>Login</h2>
    <form method="post">
      <input name="email" type="email" placeholder="Email" required>
      <input name="password" type="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>
  </div>
</body>
</html>
