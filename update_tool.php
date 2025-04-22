<?php
session_start();
require_once 'database.php';
if (!isset($_SESSION['user_id'])) {
  header('Location: index.php');
  exit;
}

$conn    = db_connect();
$user_id = $_SESSION['user_id'];

if (empty($_POST['ids']) || !is_array($_POST['ids'])) {
  die('No tools to update.');
}

foreach ($_POST['ids'] as $id) {
  $id        = (int) $id;
  $name      = trim($_POST['name'][$id] ?? '');
  $condition = trim($_POST['condition'][$id] ?? '');
  $cost      = (float) ($_POST['cost'][$id]  ?? 0);

  $sql = "UPDATE tools
          SET name=?, ToolCondition=?, cost=?
          WHERE id=? AND user_id=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssdii", $name, $condition, $cost, $id, $user_id);
  $stmt->execute();
}

header('Location: dashboard.php');
exit;
