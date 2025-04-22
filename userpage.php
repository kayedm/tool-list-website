<?php
session_start();
require_once 'database.php';
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
// Connect to the database
$conn = db_connect();
$user_id = $_SESSION['user_id'];

//Fetch user info from database
$user_stmt = $conn->prepare("SELECT username, email FROM users WHERE id = ?");
$user_stmt->bind_param("i", $user_id);
// Execute query and fetch result
$user_stmt->execute();
$user_result = $user_stmt->get_result();
$user_data = $user_result->fetch_assoc();

// Holds username and email
$user_name = $user_data['username'];
$user_email = $user_data['email'];

//Fetch tools belonging to this user
$sql = "SELECT id, name, toolcondition, cost FROM tools WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$tool_count = $result->num_rows;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Page</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <h2> User Page </h2>
        <hr>
        <p>Username: <?php echo htmlspecialchars($user_name); ?></p>
        <p class="userinfo">Email: <?php echo htmlspecialchars($user_email); ?></p>
        <p class="userinfo">You have <strong><?php echo $tool_count; ?></strong> tool(s) in your list.</p>
        <a href="dashboard.php" id="userpage-btn">Back to Dashboard</a>
    </div>

    <script>
        // Apply dark mode on page load if saved in localStorage
        window.addEventListener("DOMContentLoaded", () => {
            const darkModeSetting = localStorage.getItem("darkMode");
            if (darkModeSetting == "enabled") {
                document.body.classList.add("dark-mode");
            }
        });
    </script>

</body>

</html>