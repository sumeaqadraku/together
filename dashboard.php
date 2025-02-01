<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Include the database connection
include 'include/db.php';

// Create a new database connection instance
$db = new Database();
$conn = $db->getConnection(); // This should now return a valid connection or die on failure

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: Unable to connect to the database.");
}

// Fetch total users
$stmt = $conn->prepare("SELECT COUNT(*) AS user_count FROM users");
$stmt->execute();
$user_count = $stmt->fetch(PDO::FETCH_ASSOC)['user_count'];

// Fetch total appointments
$stmt = $conn->prepare("SELECT COUNT(*) AS appointment_count FROM appointment");
$stmt->execute();
$appointment_count = $stmt->fetch(PDO::FETCH_ASSOC)['appointment_count'];

// Fetch total services
$stmt = $conn->prepare("SELECT COUNT(*) AS service_count FROM services");
$stmt->execute();
$service_count = $stmt->fetch(PDO::FETCH_ASSOC)['service_count'];

// Fetch total messages
$stmt = $conn->prepare("SELECT COUNT(*) AS message_count FROM contact_form");
$stmt->execute();
$message_count = $stmt->fetch(PDO::FETCH_ASSOC)['message_count'];

// Fetch all users
$users_result = $conn->query("SELECT * FROM users");

// Fetch all messages
$messages = $conn->query("SELECT * FROM contact_form ORDER BY created_at DESC");

// Handle message deletion
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM contact_form WHERE id = :id");
    $stmt->execute(['id' => $id]);
    header("Location: dashboard.php?deleted=1");
    exit();
}

// Handle making a user an admin
if (isset($_GET['make_admin'])) {
    $user_id = intval($_GET['make_admin']);
    $stmt = $conn->prepare("UPDATE users SET role = 'admin' WHERE id = :id");
    $stmt->execute(['id' => $user_id]);
    header("Location: dashboard.php?role_changed=1");
    exit();
}

// Handle user deletion
if (isset($_GET['delete_user'])) {
    $user_id = intval($_GET['delete_user']);
    if ($user_id !== $_SESSION['user_id']) {
        $stmt = $conn->prepare("DELETE FROM users WHERE id = :id");
        $stmt->execute(['id' => $user_id]);
        header("Location: dashboard.php?user_deleted=1");
    } else {
        header("Location: dashboard.php?user_delete_error=1");
    }
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
            <li><a href="dashboard.php#messages">Messages (<?= $message_count ?>)</a></li>
            <li><a href="dashboard.php#users">All Users (<?= $user_count ?>)</a></li>
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
                    <th>Email</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                <?php while ($row = $messages->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
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

        <!-- Users Table Section -->
        <section id="users">
            <h2>All Users</h2>
            <?php if (isset($_GET['role_changed'])): ?>
                <p class="success-message">User role updated successfully!</p>
            <?php endif; ?>

            <?php if (isset($_GET['user_deleted'])): ?>
                <p class="success-message">User deleted successfully!</p>
            <?php endif; ?>

            <?php if (isset($_GET['user_delete_error'])): ?>
                <p class="error-message">You cannot delete your own account!</p>
            <?php endif; ?>

            <table>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
                <?php while ($row = $users_result->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['role']) ?></td>
                    <td>
                        <?php if ($row['role'] != 'admin'): ?>
                            <a href="dashboard.php?make_admin=<?= $row['id'] ?>" class="make-admin-btn" onclick="return confirm('Are you sure you want to make this user an admin?')">Make Admin</a>
                        <?php else: ?>
                            <span class="already-admin">Already Admin</span>
                        <?php endif; ?>
                        <a href="dashboard.php?delete_user=<?= $row['id'] ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this user?')">Delete User</a>
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
