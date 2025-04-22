<?php
// Required for database connection and query execution
require_once('credentials.php');


// Database connection function
function db_connect() {
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    confirm_db_connect();
    return $connection;
}


// Database disconnection function
function db_disconnect($connection) {
    if(isset($connection)) {
    mysqli_close($connection);
    }
}

// Function to confirm database connection
function confirm_db_connect() {
    if(mysqli_connect_errno()) {
    $msg = "Database connection failed: ";
    $msg .= mysqli_connect_error();
    $msg .= " (" . mysqli_connect_errno() . ")";
    exit($msg);
    }
}

// Function to confirm query execution
function confirm_result_set($result_set) {
    if (!$result_set) {
    exit("Database query failed.");
    }
}

?>
