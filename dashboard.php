<?php
session_start();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

class AdminDashboard {
    private $conn;
    private $user_id;

    public function __construct($db) {
        $this->conn = $db->getConnection();
        if (!$this->conn) {
            die("Connection failed: Unable to connect to the database.");
        }
        $this->user_id = $_SESSION['user_id'];
    }

    // Ensure the user is logged in
    public function ensureLoggedIn() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: login.php');
            exit();
        }
    }

    // Fetch counts for users, appointments, services, and messages
    public function fetchCounts() {
        return [
            'user_count' => $this->fetchCount('users'),
            'appointment_count' => $this->fetchCount('appointment'),
            'service_count' => $this->fetchCount('services'),
            'message_count' => $this->fetchCount('contact_form')
        ];
    }

    // Function to fetch count for any table
    private function fetchCount($table) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) AS count FROM $table");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    }

    // Fetch all users and contact form messages
    public function fetchAllUsers() {
        return $this->conn->query("SELECT * FROM users");
    }

    public function fetchMessages() {
        return $this->conn->query("SELECT * FROM contact_form ORDER BY created_at DESC");
    }

    // Handle message deletion
    public function deleteMessage($id) {
        $stmt = $this->conn->prepare("DELETE FROM contact_form WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }

    // Make a user an admin
    public function makeAdmin($user_id) {
        $stmt = $this->conn->prepare("UPDATE users SET role = 'admin' WHERE id = :id");
        $stmt->execute(['id' => $user_id]);
    }

    // Handle user deletion
    public function deleteUser($user_id) {
        if ($user_id !== $_SESSION['user_id']) {
            $stmt = $this->conn->prepare("DELETE FROM users WHERE id = :id");
            $stmt->execute(['id' => $user_id]);
        }
    }

    // Handle form submission actions
    public function handleActions() {
        if (isset($_GET['delete'])) {
            $this->deleteMessage(intval($_GET['delete']));
            header("Location: dashboard.php?deleted=1");
            exit();
        }

        if (isset($_GET['make_admin'])) {
            $this->makeAdmin(intval($_GET['make_admin']));
            header("Location: dashboard.php?role_changed=1");
            exit();
        }

        if (isset($_GET['delete_user'])) {
            $this->deleteUser(intval($_GET['delete_user']));
            header("Location: dashboard.php?user_deleted=1");
            exit();
        }
    }
}

include 'include/db.php';
$db = new Database();
$adminDashboard = new AdminDashboard($db);

$adminDashboard->ensureLoggedIn();
$adminDashboard->handleActions();

// Fetch required data
$counts = $adminDashboard->fetchCounts();
$users_result = $adminDashboard->fetchAllUsers();
$messages = $adminDashboard->fetchMessages();
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
            <li><a href="dashboard.php#messages">Messages (<?= $counts['message_count'] ?>)</a></li>
            <li><a href="dashboard.php#users">All Users (<?= $counts['user_count'] ?>)</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="dashboard-header">
            <h1>Welcome, <?= htmlspecialchars($_SESSION['email']) ?>!</h1>
            <p>Here’s a quick overview of the system:</p>
        </div>

        <div class="dashboard-stats">
            <div class="stat">
                <h3>Total Users</h3>
                <p><?= $counts['user_count'] ?></p>
            </div>
            <div class="stat">
                <h3>Total Appointments</h3>
                <p><?= $counts['appointment_count'] ?></p>
            </div>
            <div class="stat">
                <h3>Total Services</h3>
                <p><?= $counts['service_count'] ?></p>
            </div>
            <div class="stat">
                <h3>Messages Received</h3>
                <p><?= $counts['message_count'] ?></p>
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
