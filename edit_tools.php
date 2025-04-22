<?php
session_start();
require_once 'database.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$conn    = db_connect();
$user_id = $_SESSION['user_id'];

if (empty($_GET['tool_ids']) || !is_array($_GET['tool_ids'])) {
    die('No tools selected for editing.');
}

$ids = array_map('intval', $_GET['tool_ids']);
$in  = str_repeat('?,', count($ids) - 1) . '?';
$sql = "SELECT id,name,ToolCondition,cost
        FROM tools
        WHERE user_id = ? AND id IN ($in)";
$stmt = $conn->prepare($sql);

$types = str_repeat('i', count($ids) + 1);
$stmt->bind_param($types, $user_id, ...$ids);
$stmt->execute();
$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF‑8">
  <title>Edit Tools</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <h1>Edit Selected Tools</h1>

  <?php while ($tool = $result->fetch_assoc()): ?>
    <form action="update_tool.php" method="POST" class="edit-form">
      <input type="hidden" name="id" value="<?= $tool['id'] ?>">
      <label>
        Name:
        <input type="text" name="name" value="<?= htmlspecialchars($tool['name']) ?>" required>
      </label>
      <label>
        Condition:
        <input type="text" name="condition" value="<?= htmlspecialchars($tool['ToolCondition']) ?>" required>
      </label>
      <label>
        Cost:
        <input type="number" step="0.01" name="cost" value="<?= htmlspecialchars($tool['cost']) ?>" required>
      </label>
      <button type="submit">Save Tool #<?= $tool['id'] ?></button>
    </form>
    <hr>
  <?php endwhile; ?>

  <p><a href="dashboard.php">← Back to Dashboard</a></p>
</body>
</html>
