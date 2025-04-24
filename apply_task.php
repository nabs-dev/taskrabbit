<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'worker') die("Unauthorized");
$conn = new mysqli("localhost", "u8gr0sjr9p4p4", "9yxuqyo3mt85", "db6egnojziu599");

$task_id = $_POST['task_id'];
$worker_id = $_SESSION['user']['id'];

$conn->query("INSERT INTO applications (task_id, worker_id) VALUES ($task_id, $worker_id)");

echo "<script>alert('Applied Successfully!'); window.location='dashboard.php';</script>";
?>
