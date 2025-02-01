<?php
include 'include/db.php';  
include 'include/header.php';

// Initialize Database Connection
$db = new Database();
$conn = $db->getConnection();

// Fetch the introductory text from the service_intro table
$intro_sql = "SELECT * FROM service_intro LIMIT 1"; 
$intro_result = $conn->query($intro_sql);
$intro_text = '';

if ($intro_result && $intro_result->rowCount() > 0) {
    $row = $intro_result->fetch(PDO::FETCH_ASSOC);
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

  <!-- Header Section -->
  <section class="header-banner">
    <h1>Our Services</h1>
    <p>Support, compassion, and understanding to guide you through life's challenges.</p>
  </section>

  <!-- Dynamic Introductory Text Section -->
  <center>
    <section class="intro-text">
      <p><?php echo htmlspecialchars($intro_text); ?></p>
    </section>
  </center>

  <!-- Detailed Services Section -->
  <section class="detailed-services">
    <h2>Explore Our Services</h2>
    <br>
    <div class="service-list">
      <?php
      // Check if there are any services to display
      if ($services_result && $services_result->rowCount() > 0) {
          // Loop through each service and display it
          while ($service = $services_result->fetch(PDO::FETCH_ASSOC)) {
              echo '<div class="service-item">';
              echo '<img src="' . htmlspecialchars($service['image_path']) . '" alt="' . htmlspecialchars($service['title']) . '">'; // Use image_path
              echo '<h3>' . htmlspecialchars($service['title']) . '</h3>';
              echo '<p>' . htmlspecialchars($service['description']) . '</p>';
              echo '<a href="' . htmlspecialchars($service['link']) . '" class="cta-button">Learn More</a>'; // Use link
              echo '</div>';
          }
      } else {
          echo '<p>No services available at the moment.</p>';
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
