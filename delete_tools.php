<?php
session_start();
require_once 'database.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['tool_ids'])) {
    $conn = db_connect();
    $user_id = $_SESSION['user_id'];

    // Sanitize and prepare the IDs
    $tool_ids = $_POST['tool_ids'];
    $placeholders = implode(',', array_fill(0, count($tool_ids), '?'));
    $types = str_repeat('i', count($tool_ids));

    $sql = "DELETE FROM tools WHERE id IN ($placeholders) AND user_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $params = [...$tool_ids, $user_id];
        $stmt->bind_param($types . 'i', ...$params);
        $stmt->execute();
        $stmt->close();
    }

    db_disconnect($conn);
}

header("Location: dashboard.php");
exit;
?>
