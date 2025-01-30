<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch the user email (for display purposes)
$user_email = $_SESSION['email'];  // Use this for the profile
?>

<?php
include 'include/db.php'; 


// Query to fetch past appointments (appointments where the appointment_date is in the past)
$query = "SELECT * FROM appointments WHERE user_id = ? AND appointment_date < NOW() ORDER BY appointment_date DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$past_appointments_result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Together</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Welcome</h2>
        <ul>
        <li>
          <?php if (isset($_SESSION['user_role'])): ?>
            <?php if ($_SESSION['user_role'] !== 'admin'): ?>
              <a href="profile.php">Profile</a>
            <?php else: ?>
              <a href="dashboard.php">Dashboard</a>
            <?php endif; ?>
          <?php else: ?>
            <a href="profile.php">Profile</a>
          <?php endif; ?>
        </li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <header>
            <h1>Hello, <?= htmlspecialchars($user_email) ?>!</h1>
        </header>

        <!-- Profile Info Section -->
        <section class="profile-info">
            <div class="profile-details">
                <div class="profile-image">
                    <!-- Profile Picture -->
                    <img src="images/Default_pfp.jpg" alt="Profile Picture" id="profile-picture">
                </div>
            </div>
        </section>

        <!-- Mood Check-in Section -->
        <section class="mood-checkin">
            <h2>Mood Check-in</h2>
            <form action="submit_mood_checkin.php" method="POST">
                <div class="mood-slider">
                    <label for="mood">How are you feeling today?</label><br><br>
                    <input type="range" id="mood" name="mood" min="1" max="5" step="1" value="3">
                    <div class="mood-levels">
                        <span>Very Sad</span>
                        <span>Neutral</span>
                        <span>Very Happy</span>
                    </div>
                </div>

                <?php


// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch the user email (for display purposes)
$user_email = $_SESSION['email'];  // Use this for the profile

include 'include/db.php'; 


// Query to fetch past appointments
$query = "SELECT * FROM appointments WHERE user_id = ? AND appointment_date < NOW() ORDER BY appointment_date DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$past_appointments_result = $stmt->get_result();

// Query to fetch recent mood check-ins
$query_mood = "SELECT * FROM mood_checkins WHERE user_id = ? ORDER BY checkin_date DESC";
$stmt_mood = $conn->prepare($query_mood);
$stmt_mood->bind_param("i", $_SESSION['user_id']);
$stmt_mood->execute();
$recent_moods_result = $stmt_mood->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Together</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="sidebar">
        <h2>Welcome</h2>
        <ul>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

        <!-- Recent Mood Check-ins Section -->
        <section class="recent-moods">
            <h2>Your Recent Mood Check-ins</h2>
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Mood Level</th>
                        <th>Notes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($recent_moods_result->num_rows > 0): ?>
                        <?php while ($mood = $recent_moods_result->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($mood['checkin_date']) ?></td>
                                <td><?= htmlspecialchars($mood['mood_level']) ?></td>
                                <td><?= htmlspecialchars($mood['notes']) ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3">You have no recent mood check-ins.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>

        <!-- Past Appointments Section -->
        <section class="appointments-card">
            <h2>Your Past Appointments</h2>
            <table class="appointments-table">
                <thead>
                    <tr>
                        <th>Doctor</th>
                        <th>Appointment Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($past_appointments_result->num_rows > 0): ?>
                        <?php while ($appointment = $past_appointments_result->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($appointment['doctor_id']) ?></td>
                                <td><?= htmlspecialchars($appointment['appointment_date']) ?></td>
                                <td class="status <?= strtolower($appointment['status']) ?>"><?= ucfirst($appointment['status']) ?></td>
                                <td>
                                    <?php if ($appointment['status'] == 'completed' && empty($appointment['feedback'])): ?>
                                        <a href="feedback.php?id=<?= $appointment['id'] ?>">Leave Feedback</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">You have no past appointments.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>
    </div>

    <div class="footer">
        <p>&copy; 2025 Together. All rights reserved.</p>
    </div>


</body>
</html>


<style>
    /* Full-screen layout */

    *{
        font-family: 'Inter', sans-serif;
        font-weight: 300; /* Lighter font weight */
    }
html, body {
    margin: 0;
    padding: 0;
    height: 100%;
    font-family: Arial, sans-serif;
    background-color: #f4f7fc;
}

/* Sidebar styling */
.sidebar {
    width: 250px;
    background-color: #7A8A6A;
    color: white;
    padding: 20px;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
}

.sidebar h2 {
    font-size: 24px;
    text-align: center;
    margin-bottom: 40px;
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
    background-color: #7A8A6A;
}

/* Main content styling */
.main-content {
    margin-left: 270px;
    padding: 40px;
    min-height: 100vh;
}

header h1 {
    font-size: 28px;
    color: #2c3e50;
    text-align: center;
}

/* Profile Info Section */
.profile-info h2 {
    font-size: 22px;
    color: #34495e;
    margin-bottom: 15px;
}

.profile-details {
    font-size: 18px;
    color: #7f8c8d;
}

.profile-image {
    text-align: center;
    margin-bottom: 20px;
}

.profile-image img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    border: 2px solid #34495e;
}

.upload-input {
    display: block;
    margin: 15px auto;
}

/* Mood Check-in Section */
.mood-checkin h2 {
    font-size: 22px;
    color: #34495e;
    margin-bottom: 15px;
}

/* Mood Slider */
.mood-slider {
    text-align: center;
    margin-bottom: 20px;
}

.mood-slider input[type="range"] {
    width: 80%;
    margin: 20px 0;
    -webkit-appearance: none;
    appearance: none;
    height: 10px;
    border-radius: 5px;
    background: linear-gradient(to right, #e74c3c 0%, #f1c40f 50%, #2ecc71 100%);
    /* Add color stops for the slider track */
    transition: background 0.3s ease;
}

/* Change the thumb (slider knob) */
.mood-slider input[type="range"]::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: #fff;
    border: 2px solid #34495e;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

/* When the thumb is being dragged, change its color */
.mood-slider input[type="range"]:active::-webkit-slider-thumb {
    background-color: #3498db;
}

/* Firefox Styling */
.mood-slider input[type="range"]::-moz-range-thumb {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: #fff;
    border: 2px solid #34495e;
    cursor: pointer;
}

.mood-slider input[type="range"]::-moz-range-track {
    height: 10px;
    border-radius: 5px;
    background: linear-gradient(to right, #e74c3c 0%, #f1c40f 50%, #2ecc71 100%);
}

/* Change the color of the slider thumb when hovered or focused */
.mood-slider input[type="range"]:hover::-webkit-slider-thumb {
    background-color: #f39c12;
}

.mood-slider input[type="range"]:hover::-moz-range-thumb {
    background-color: #f39c12;
}

/* Add a smoother transition to the slider's background */
.mood-slider input[type="range"]:active {
    background: linear-gradient(to right, #c0392b 0%, #f39c12 50%, #27ae60 100%);
}

.mood-levels {
    display: flex;
    justify-content: space-between;
    font-size: 14px;
    color: #7f8c8d;
}

.mood-notes textarea {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
    resize: vertical;
    margin-top: 10px;
}

/* Button */
.submit-btn {
    display: block;
    width: 100%;
    padding: 12px;
    font-size: 16px;
    background-color: #7A8A6A;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 20px;
    transition: background-color 0.3s;
}

.submit-btn:hover {
    background-color: #27ae60;
}

/* Table for Recent Moods */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table th, table td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

table th {
    background-color: #f1f1f1;
    color: #34495e;
}

table td {
    color: #7f8c8d;
}

/* Responsive Design */
@media (max-width: 768px) {
    .sidebar {
        width: 200px;
    }
    .main-content {
        margin-left: 220px;
    }

    .submit-btn {
        padding: 10px;
        font-size: 14px;
    }
}

</style>