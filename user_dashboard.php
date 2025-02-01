<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

// Get user details from session
$user_email = $_SESSION['email'];

// Include the Database class to fetch the appointments
require_once 'include/db.php';

// Create a new instance of the Database class and get the connection
$db = new Database();
$conn = $db->getConnection();

// Fetch appointments from the database
$appointments_sql = "SELECT * FROM appointment";
$appointments_result = $conn->query($appointments_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>

    <style>
    /* Global styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Inter', sans-serif;
    font-weight: 300; /* Lighter font weight */
    }

    body {
        background-color: #f4f4f4;
        text-align: center;
        padding: 20px;
    }

    /* Header */
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

    /* Main Content */
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

    /* Table styles */
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

    /* Footer */
    footer {
        margin-top: 50px;
        padding: 10px;
        background-color: #7A8A6A;
        color: white;
        position: relative;
        width: 100%;
        text-align: center;
    }

    /* Buttons */
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
        background-color: #0056b3;
    }

    /* Responsiveness for smaller screens */
    @media screen and (max-width: 768px) {
        nav ul li {
            display: block;
            margin-bottom: 10px;
        }

        .btn {
            width: 100%;
            margin-top: 10px;
        }

        main {
            width: 90%;
            padding: 15px;
        }

        table th, table td {
            padding: 8px;
        }

        footer {
            font-size: 14px;
        }
    }

    @media screen and (max-width: 480px) {
        table th, table td {
            font-size: 14px;
            padding: 6px;
        }

        h1 {
            font-size: 24px;
        }

        h2 {
            font-size: 20px;
        }
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
        <br>
        <p>This is your user dashboard where you can manage your account.</p>
        <br>
        <br>


        <!-- Appointments Table -->
        <h3>Your Appointments</h3>
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
                <?php if ($appointments_result->rowCount() > 0): ?>
                    <?php while ($appointment = $appointments_result->fetch(PDO::FETCH_ASSOC)): ?>
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
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8">No appointments found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>

    <footer>
        <p>&copy; 2025 Together Mental Health Platform. All rights reserved.</p>
    </footer>

</body>
</html>
