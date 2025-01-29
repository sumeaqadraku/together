<?php
include 'include/db.php';  
include 'include/header.php';

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

  <section class="hero">
    <div class="hero-content">
      <h1>Building brighter tomorrows, together</h1>
      <p>Join us in making a difference. Start your journey today.</p>
      <a href="#get-started" class="button">Get Started</a>
    </div>
  </section>

  <section id="about-us">
    <div class="our-story">
      <h2>Our Story</h2>
      <p>At Together, we understand that life can be difficult, and everyone’s journey is unique. We started this business to help people heal, grow, and thrive in a safe, compassionate space.</p>
    </div>
    <div class="mission-vision">
      <div class="mission">
        <h2>Our Mission</h2>
        <p>Our mission is to provide compassionate, holistic care that empowers individuals to break free from life's challenges and rediscover their true potential.</p>
      </div>
      <div class="vision">
        <h2>Our Vision</h2>
        <p>Our vision is to foster a world where mental health is prioritized, where communities thrive through connection and support.</p>
      </div>
    </div>
    <div class="cta">
      <a href="#services" class="cta-button">Learn More About Our Story</a>
    </div>
  </section>

  
<section id="services-overview" class="services-overview">
    <h2>Our Services</h2>
    <div class="service-cards">
        <?php
        if ($services_result->num_rows > 0) {
            while ($service = $services_result->fetch_assoc()) {
                echo "<div class='service-card'>";
                
               

                // Display the image from the image_url field
                if (isset($service['image_url']) && !empty($service['image_url'])) {
                    echo "<img src='" . $service['image_url'] . "' alt='" . $service['name'] . "' class='service-icon'>";
                } else {
                    echo "' alt='No image available' class='service-icon'>";
                }

                echo "<h3>" . $service['name'] . "</h3>";
                echo "<p>" . $service['description'] . "</p>";
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
              echo "<p>\"{$testimonial['quote']}\" – <strong>{$testimonial['author']}</strong></p>";
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
</main>

<script src="js/main.js"></script>
</body>
</html>

<?php $conn->close(); ?>
