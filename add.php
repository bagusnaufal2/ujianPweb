<?php
include 'db.php';

if(isset($_POST['task'])) {
  $task = $_POST['task'];
  $priority = $_POST['priority'] ?? 'Sedang';
  $conn->query("INSERT INTO tasks (task, priority) VALUES ('$task', '$priority')");
}
header("Location: index.php");
?>