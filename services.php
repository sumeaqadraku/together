<?php
include 'include/db.php';  

// Fetch the introductory text from the service_intro table
$intro_sql = "SELECT * FROM service_intro LIMIT 1"; 
$intro_result = $conn->query($intro_sql);
$intro_text = '';
if ($intro_result->num_rows > 0) {
  $row = $intro_result->fetch_assoc();
  $intro_text = $row['intro_text'];
}

// Fetch all services from the 'explore_services' table
$services_sql = "SELECT * FROM explore_services"; 
$services_result = $conn->query($services_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/services.css">
  <title>Our Services</title>
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
        <li><a href="#testimonials">Testimonials</a></li>
        <li><a href="resources.php">Resources</a></li>
        <li><a href="contact.php">Contact Us</a></li>
      </ul>
    </nav>
    <a href="login.php" class="contact-button">Log In</a>
  </header>

  <!-- Header Section -->
  <section class="header-banner">
    <h1>Our Services</h1>
    <p>Support, compassion, and understanding to guide you through life's challenges.</p>
  </section>

  <!-- Dynamic Introductory Text Section -->
 <center> <section class="intro-text">
    <p><?php echo $intro_text; ?></p>
  </section>
</center>

  <!-- Detailed Services Section -->
  <section class="detailed-services">
    <h2>Explore Our Services</h2>
    <br>
    <div class="service-list">
      <?php
      // Loop through each service and display it
      while ($service = $services_result->fetch_assoc()) {
        echo '<div class="service-item">';
        echo '<img src="' . $service['image_path'] . '" alt="' . $service['title'] . '">'; // Use image_path
        echo '<h3>' . $service['title'] . '</h3>';
        echo '<p>' . $service['description'] . '</p>';
        echo '<a href="' . $service['link'] . '" class="cta-button">Learn More</a>'; // Use link
        echo '</div>';
      }
      ?>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <center><p>&copy; 2025 Together Mental Health Platform</p></center>
  </footer>
</body>
</html>
