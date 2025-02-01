<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - Together</title>
    <link rel="stylesheet" href="assets/css/profile.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="profile-content">
        <h1>Welcome, <?= htmlspecialchars($_SESSION['email']) ?>!</h1>
        <p>This is your profile page.</p>
        <p>Here you can view and manage your personal information.</p>
    </div>
</body>
</html>