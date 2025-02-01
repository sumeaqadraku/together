<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Redirect based on role
if ($_SESSION['role'] == 'admin') {
    header("Location: dashboard.php"); // Admin goes to dashboard
} else {
    header("Location: user_dashboard.php"); // Regular users go to their dashboard
}
exit();
?>
