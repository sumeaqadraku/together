<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/header.css">
  
  <title>Together</title>
</head>
<body>

<header class="navbar">
    <a href="index.php" class="logo">together</a>
    <nav>
        <ul class="nav-links">
            <li><a href="about.php">About Us</a></li>
            <li class="dropdown">
                <a href="services.php" class="dropbtn">Services</a>
                <ul class="dropdown-content">
                    <li><a href="individual_therapy.php">Individual Therapy</a></li>
                    <li><a href="couples_counseling.php">Couples Counseling</a></li>
                    <li><a href="group_sessions.php">Group Sessions</a></li>
                </ul>
            </li>
            <li><a href="resources.php">Resources</a></li>
            <li><a href="contact.php">Contact Us</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="booking.php">Booking</a></li>
        </ul>
    </nav>

   
    <div class="hamburger" onclick="toggleMenu()">
        <div></div>
        <div></div>
        <div></div>
    </div>

    <div class="auth-button">
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="logout.php" class="contact-button">Log Out</a>
        <?php else: ?>
            <a href="login.php" class="contact-button">Log In</a>
        <?php endif; ?>
    </div>
</header>

<script>
    function toggleMenu() {
        const navLinks = document.querySelector('.nav-links');
        navLinks.classList.toggle('active');
    }
</script>

</body>
</html>
