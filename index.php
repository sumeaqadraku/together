<?php
include 'include/db.php';  
include 'include/header.php';

$db = new Database();
$conn = $db->getConnection(); // Correctly using the Database class

// Fetch services
$services_sql = "SELECT * FROM services";
$services_result = $conn->query($services_sql);

// Fetch testimonials
$testimonials_sql = "SELECT * FROM testimonials";
$testimonials_result = $conn->query($testimonials_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Together</title>
  <link rel="stylesheet" href="assets/css/main.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

  <main> <!-- Fixed missing <main> tag -->
  <section class="hero">
    <div class="hero-content">
      <h1>Building brighter tomorrows, together</h1>
      <p>Join us in making a difference. Start your journey today.</p>
      <a href="contact.php" class="button">Get Started</a>
    </div>
  </section>

  <section id="services-overview" class="services-overview">
    <h2>Our Services</h2>
    <div class="service-cards">
        <?php
        if ($services_result->num_rows > 0) {
            while ($service = $services_result->fetch_assoc()) {
                echo "<div class='service-card'>";

                // Securely display the image or a placeholder
                if (!empty($service['image_url'])) {
                    echo "<img src='" . htmlspecialchars($service['image_url']) . "' alt='" . htmlspecialchars($service['name']) . "' class='service-icon'>";
                } else {
                    echo "<img src='assets/images/placeholder.png' alt='No image available' class='service-icon'>";
                }

                echo "<h3>" . htmlspecialchars($service['name']) . "</h3>";
                echo "<p>" . htmlspecialchars($service['description']) . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No services available</p>";
        }
        ?>
    </div>
  </section>

  <section id="testimonials" class="testimonials">
    <h2>What Our Clients Say</h2>
    <div class="testimonial-slider">
      <?php
      if ($testimonials_result->num_rows > 0) {
          while ($testimonial = $testimonials_result->fetch_assoc()) {
              echo "<div class='testimonial'>";
              echo "<p>\"" . htmlspecialchars($testimonial['quote']) . "\" – <strong>" . htmlspecialchars($testimonial['author']) . "</strong></p>";
              echo "</div>";
          }
      } else {
          echo "<p>No testimonials available at the moment.</p>";
      }
      ?>
    </div>
  </section>

  <footer>
    <center> <p>&copy; 2025 Together. All rights reserved.</p> </center>
  </footer>
  </main> <!-- Closing main tag -->

<script src="js/main.js"></script>
</body>
</html>

