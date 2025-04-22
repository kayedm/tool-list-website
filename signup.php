<?php
// signup.php
require_once 'database.php';
// 
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = ($_POST['name']);
    $email = ($_POST['email']);
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    if (empty($name) || empty($email) || empty($password) || empty($password2)) {
        exit("All fields are required.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        exit("Invalid email format.");
    }

    if ($password !== $password2) {
        exit("Passwords do not match.");
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    //Connect to DB using your wrapper
    $conn = db_connect();

    //Check if email already exists
    $check_sql = "SELECT id FROM users WHERE email = ?";
    $stmt = $conn->prepare($check_sql);

    // Check if prepare was successful
    if (!$stmt) {
        $error = "Prepare failed (email check): " . $conn->error;
        db_disconnect($conn);
        exit($error);
    }
    // Bind parameters to store the result
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    // Check if a user with that email exists
    if ($stmt->num_rows > 0) {
        $stmt->close();
        db_disconnect($conn);
        exit("Email is already registered.");
    }
    // Close the statement
    $stmt->close();
    // Prepare SQL statement to insert the new user
    $insert_sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insert_sql);
    // Prepare the statement with the parameters
    $stmt->bind_param("sss", $name, $email, $hashed_password);
    // Check if the parameters were bound successfully
    $stmt->execute();
    $stmt->close();
    db_disconnect($conn);
    header("Location: dashboard.php");
    exit;
}
