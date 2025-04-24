<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'user') die("Unauthorized");
$conn = new mysqli("localhost", "u8gr0sjr9p4p4", "9yxuqyo3mt85", "db6egnojziu599");

$task_id = $_POST['task_id'];
$status = $_POST['status'];

$conn->query("UPDATE tasks SET status='$status' WHERE id=$task_id");

echo "<script>alert('Status updated!'); window.location='dashboard.php';</script>";
?>
