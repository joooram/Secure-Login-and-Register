<?php
session_start(); // Start the session so we can destroy it

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to login page
header("Location: login.php");
exit();
?>
