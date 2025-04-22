<?php
//Destroys user session and redirects to homepage
session_start();
session_unset();
session_destroy();
header("Location: index.php");
exit;
?>
