<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
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
$user_count = $stmt->get_result()->fetch_assoc()['user_count'];

// Fetch total appointments
$stmt = $conn->prepare("SELECT COUNT(*) AS appointment_count FROM appointments");
$stmt->execute();
$appointment_count = $stmt->get_result()->fetch_assoc()['appointment_count'];

// Fetch total services
$stmt = $conn->prepare("SELECT COUNT(*) AS service_count FROM services");
$stmt->execute();
$service_count = $stmt->get_result()->fetch_assoc()['service_count'];

// Fetch total messages
$stmt = $conn->prepare("SELECT COUNT(*) AS message_count FROM contact_form");
$stmt->execute();
$message_count = $stmt->get_result()->fetch_assoc()['message_count'];

// Fetch all messages
$messages = $conn->query("SELECT * FROM contact_form ORDER BY created_at DESC");

// Handle message deletion
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM contact_form WHERE id = $id");
    header("Location: dashboard.php?deleted=1");
    exit();
}

// Fetch admin email
$admin_email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Together</title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>
<body>
    <div class="sidebar">
        <h2>Admin Dashboard</h2>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="dashboard.php#messages"> Messages (<?= $message_count ?>)</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="dashboard-header">
            <h1>Welcome, <?= htmlspecialchars($admin_email) ?>!</h1>
            <p>Here’s a quick overview of the system:</p>
        </div>

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
            <div class="stat">
                <h3>Messages Received</h3>
                <p><?= $message_count ?></p>
            </div>
        </div>

        <!-- Contact Messages Section -->
        <section id="messages">
            <h2>Contact Messages</h2>

            <?php if (isset($_GET['deleted'])): ?>
                <p class="success-message">Message deleted successfully!</p>
            <?php endif; ?>

            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                <?php while ($row = $messages->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['message']) ?></td>
                    <td><?= $row['created_at'] ?></td>
                    <td>
                        <a href="dashboard.php?delete=<?= $row['id'] ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this message?')">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
        </section>

        <div class="footer">
            <p>&copy; <?= date('Y') ?> Together. All rights reserved.</p>
        </div>
    </div>
</body>
</html>

<?php $conn->close(); ?>

<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f7fc;
        margin: 0;
        padding: 0;
    }

    .sidebar {
        width: 250px;
        background-color: #7A8A6A;
        color: white;
        padding: 20px;
        height: 100vh;
        position: fixed;
    }

    .sidebar h2 {
        text-align: center;
        margin-bottom: 40px;
        font-size: 24px;
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
        font-size: 16px;
    }

    .sidebar ul li a:hover {
        background-color: #34495e;
    }

    .main-content {
        margin-left: 270px;
        padding: 30px;
        flex: 1;
    }

    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .dashboard-header h1 {
        font-size: 32px;
        color: #34495e;
        margin: 0;
    }

    .dashboard-header p {
        font-size: 18px;
        color: #7f8c8d;
    }

    .dashboard-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }

    .stat {
        background: #fff;
        border-radius: 10px;
        padding: 30px;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .stat:hover {
        transform: translateY(-10px);
    }

    .stat h3 {
        margin: 0;
        font-size: 22px;
        color: #34495e;
    }

    .stat p {
        font-size: 32px;
        font-weight: bold;
        margin-top: 10px;
        color: #16a085;
    }

    .stat .icon {
        font-size: 40px;
        color: #34495e;
        margin-bottom: 15px;
    }

    /* Contact Messages Section */
    #messages {
        margin-top: 30px;
    }

    #messages h2 {
        font-size: 28px;
        color: #34495e;
    }

    table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
    }

    table th,
    table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    table th {
        background-color: #f4f7fc;
        color: #34495e;
        font-size: 16px;
    }

    table td {
        font-size: 14px;
        color: #7f8c8d;
    }

    table tr:hover {
        background-color: #f9f9f9;
    }

    .delete-btn {
        color: #e74c3c;
        font-weight: bold;
        text-decoration: none;
        padding: 5px 10px;
        background-color: #ecf0f1;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .delete-btn:hover {
        background-color: #e74c3c;
        color: white;
    }

    .success-message {
        color: #2ecc71;
        font-weight: bold;
        margin-top: 20px;
    }

    .footer {
        margin-top: 40px;
        text-align: center;
        color: #7f8c8d;
    }

    @media (max-width: 768px) {
        .sidebar {
            width: 200px;
        }

        .main-content {
            margin-left: 220px;
        }
    }
</style>
