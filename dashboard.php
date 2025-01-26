<?php
session_start();

// Ensure the user is logged in and has an admin role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}

// Include the database connection
include 'include/db.php';

// Fetch total users
$stmt = $conn->prepare("SELECT COUNT(*) AS user_count FROM users");
$stmt->execute();
$user_count_result = $stmt->get_result();
$user_count = $user_count_result->fetch_assoc()['user_count'];

// Fetch total appointments (example)
$stmt = $conn->prepare("SELECT COUNT(*) AS appointment_count FROM appointments");
$stmt->execute();
$appointment_count_result = $stmt->get_result();
$appointment_count = $appointment_count_result->fetch_assoc()['appointment_count'];

// Fetch total services (example)
$stmt = $conn->prepare("SELECT COUNT(*) AS service_count FROM services");
$stmt->execute();
$service_count_result = $stmt->get_result();
$service_count = $service_count_result->fetch_assoc()['service_count'];

// Fetch admin email from the session
$admin_email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Together</title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <style>
        /* Basic styling for dashboard */
        body {
            display: flex;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            height: 100vh;
            position: fixed;
        }
        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
        }
        .sidebar ul li {
            margin: 15px 0;
        }
        .sidebar ul li a {
            text-decoration: none;
            color: white;
            display: block;
            padding: 10px;
            border-radius: 5px;
        }
        .sidebar ul li a:hover {
            background-color: #34495e;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
            flex: 1;
        }
        .dashboard-stats {
            display: flex;
            gap: 20px;
        }
        .stat {
            flex: 1;
            background: #ecf0f1;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .stat h3 {
            margin: 0;
            font-size: 18px;
            color: #34495e;
        }
        .stat p {
            font-size: 24px;
            font-weight: bold;
            margin: 10px 0 0;
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }
            .main-content {
                margin-left: 200px;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Admin Dashboard</h2>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="manage_users.php">Manage Users</a></li>
            <li><a href="manage_appointments.php">Manage Appointments</a></li>
            <li><a href="services.php">Manage Services</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <h1>Welcome, <?= htmlspecialchars($admin_email) ?>!</h1>
        <p>Here’s a quick overview of the system:</p>
        <div class="dashboard-stats">
            <div class="stat">
                <h3>Total Users</h3>
                <p><?= $user_count ?></p>
            </div>
            <div class="stat">
                <h3>Total Appointments</h3>
                <p><?= $appointment_count ?></p>
            </div>
            <div class="stat">
                <h3>Total Services</h3>
                <p><?= $service_count ?></p>
            </div>
        </div>
    </div>
</body>
</html>
