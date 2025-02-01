<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

// Get user details from session
$user_email = $_SESSION['email'];

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
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f4f4f4;
            text-align: center;
            padding: 20px;
        }

        /* Header */
        header {
            background-color: #333;
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
            display: inline-block;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 50%;
        }

        h1 {
            margin-bottom: 10px;
        }

        h2 {
            color: #333;
        }

        p {
            font-size: 18px;
            color: #666;
        }

        /* Footer */
        footer {
            margin-top: 50px;
            padding: 10px;
            background-color: #333;
            color: white;
            position: relative;
            width: 100%;
        }

        /* Buttons */
        .btn {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            margin-top: 20px;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn:hover {
            background-color: #0056b3;
        }

    </style>
</head>
<body>

    <header>
        <h1>Welcome to Your Dashboard</h1>
        <nav>
            <ul>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Hello, <?= htmlspecialchars($user_email); ?>!</h2>
        <p>This is your user dashboard where you can manage your account.</p>
        <a href="profile.php" class="btn">Go to Profile</a>
    </main>

    <footer>
        <p>&copy; 2025 Together Mental Health Platform. All rights reserved.</p>
    </footer>

</body>
</html>
