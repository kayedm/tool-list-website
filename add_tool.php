<?php
// Start session and include the database connection file
session_start();
require_once 'database.php';

// Checks for form submissoin and handles the addition of a new tool
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php");
        exit;
    }
    
    // Get form values
    $name = ($_POST['name']);
    $condition = ($_POST['condition']);
    $cost = ($_POST['cost']);
    $user_id = $_SESSION['user_id'];

    // Check if valid input is provided
    if (empty($name) || empty($condition) || $cost < 0) {
        exit("Invalid input.");
    }

    $conn = db_connect();

// Prepare SQL statement to insert the new tool
    $sql = "INSERT INTO tools (name, toolcondition, cost, user_id) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

//Prepare the statement with the parameters
    $stmt->bind_param("ssdi", $name, $condition, $cost, $user_id);
    
    // Add error handling for prepare
    $stmt->execute();
    $stmt->close();
    db_disconnect($conn);
    header("Location: dashboard.php");
    exit;
    
}
?>
