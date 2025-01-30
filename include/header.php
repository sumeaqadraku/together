<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/group_therapy.css">
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
      </ul>
    </nav>
    <a href="login.php" class="contact-button">Log In</a>
</header>
