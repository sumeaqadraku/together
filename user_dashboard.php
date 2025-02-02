<?php
session_start();
require_once '<include/db.php'; 

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); 
    exit();
}

$user_email = $_SESSION['email'];

class Appointment {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAppointments($user_email) {
        $sql = "SELECT * FROM appointment WHERE user_email = :user_email"; 
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_email', $user_email);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

$db = new Database();
$conn = $db->getConnection();
$appointmentObj = new Appointment($conn);
$appointments = $appointmentObj->getAppointments($user_email);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
            font-weight: 300;
        }

        body {
            background-color: #f4f4f4;
            text-align: center;
            padding: 20px;
        }

        header {
            background-color: #7A8A6A;
            color: white;
            padding: 15px 0;
        }

        nav ul {
            list-style: none;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin: 0 15px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 18px;
        }

        main {
            margin-top: 50px;
            padding: 20px;
            background: white;
            display: block;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 900px;
            width: 100%;
            margin-left: auto;
            margin-right: auto;
        }

        h1 {
            margin-bottom: 10px;
        }

        h2 {
            color: #333;
        }

        p {
            font-size: 18px;
            color: #333;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: white;
        }

        td {
            color: #555;
        }

        footer {
            margin-top: 50px;
            padding: 10px;
            background-color: #7A8A6A;
            color: white;
            position: relative;
            width: 100%;
            text-align: center;
        }

        .btn {
            display: inline-block;
            background-color: #7A8A6A;
            color: white;
            padding: 10px 20px;
            margin-top: 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: rgb(90, 108, 90);
        }
    </style>
</head>
<body>

<header>
    <h1>Welcome to Your Dashboard</h1>
    <nav>
        <ul>
            <li><a href="index.php" class="btn">Home</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>

<main>
    <h2>Hello, <?= htmlspecialchars($user_email); ?>!</h2>
    <p>This is your user dashboard where you can manage your account.</p>
    <h3>Your Appointments</h3>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone Number</th>
                    <th>Appointment Date</th>
                    <th>Service Type</th>
                    <th>Notes</th>
                    <th>Status</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($appointments) > 0): ?>
                    <?php foreach ($appointments as $appointment): ?>
                        <tr>
                            <td><?= htmlspecialchars($appointment['first_name']); ?></td>
                            <td><?= htmlspecialchars($appointment['last_name']); ?></td>
                            <td><?= htmlspecialchars($appointment['phone_number']); ?></td>
                            <td><?= htmlspecialchars($appointment['appointment_date']); ?></td>
                            <td><?= htmlspecialchars($appointment['service_type']); ?></td>
                            <td><?= htmlspecialchars($appointment['notes']); ?></td>
                            <td><?= htmlspecialchars($appointment['status']); ?></td>
                            <td><?= htmlspecialchars($appointment['created_at']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8">No appointments found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>

<footer>
    <p>&copy; 2025 Together Mental Health Platform. All rights reserved.</p>
</footer>

</body>
</html>
