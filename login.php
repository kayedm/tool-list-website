<?php
// Start a session and include the database connection file
session_start();
require_once 'database.php';

// Check for a request and handle the login form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Get email and password from form
    $email = ($_POST['email']);
    $password = $_POST['password'];

    // Check if email and password are empty
    if (empty($email) || empty($password)) {
        // Log error message and exit
        exit("Please fill in all fields.");
    }

    //Make varible for database connection
    $conn = db_connect();

    // Prepare SQL statement
    $sql = "SELECT id, username, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);

    // Check if prepare was successful
    if (!$stmt) {
        $error = "Prepare failed (login check): " . $conn->error;
        db_disconnect($conn);
        exit($error);
    }

    // Bind parameters to store the result
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Check if a user with that email exists and fetch the result
    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $username, $hashed_password);
        $stmt->fetch();
    
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
    
            $stmt->close();
            db_disconnect($conn);
            header("Location: dashboard.php");
            exit;
        }
    }
    
    $stmt->close();
    db_disconnect($conn);
    exit("Invalid email or password.");
    
}
