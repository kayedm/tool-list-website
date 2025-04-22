<?php
// start session to track user login status
session_start();
require_once 'database.php';

// Check if user is logged in, if not redirect to login page 
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

// Check if the form is submitted and tool IDs are provided
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tool_ids'])) {
    $conn = db_connect();
    $user_id = $_SESSION['user_id'];
    $tool_ids = $_POST['tool_ids'];

    // Make sure all IDs are integers
    $tool_ids = array_map('intval', $tool_ids);

    // Build placeholders for SQL IN clause (e.g., ?,?,?)
    $placeholders = implode(',', array_fill(0, count($tool_ids), '?'));

    // Prepare SQL: delete tools that match the user ID and one of the tool IDs
    $sql = "DELETE FROM tools WHERE user_id = ? AND id IN ($placeholders)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Merge user_id with tool_ids to bind all values
        $types = str_repeat('i', count($tool_ids) + 1);
        $stmt->bind_param($types, ...array_merge([$user_id], $tool_ids));
        $stmt->execute();
        $stmt->close();
    }

    $conn->close();
}

// Redirect back to main page
header("Location: dashboard.php"); // Change to your actual page if different
exit;
?>
