<?php
include 'include/db.php';  

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
<?php
    
    $query = "SELECT * FROM services";  
    $result = $conn->query($query);


    if ($result->num_rows > 0) {
    
        while ($row = $result->fetch_assoc()) {
            echo "<h3>" . $row['name'] . "</h3>"; 
            echo "<p>" . $row['description'] . "</p>";  
        }
    } else {
        echo "No services available.";
    }

    // Close the connection
    $conn->close();
    ?>
  <header class="navbar">
    <a href="index.html" class="logo">together</a>
    <nav>
      <ul class="nav-links">
        <li><a href="about.html">About Us</a></li>
        <li class="dropdown">
          <a href="services.html" class="dropbtn">Services</a>
          <ul class="dropdown-content">
            <li><a href="individual_therapy.html">Individual Therapy</a></li>
            <li><a href="couples_counseling.html">Couples Counseling</a></li>
            <li><a href="group_sessions.html">Group Sessions</a></li>
          </ul>
        </li>
        <li><a href="#testimonials">Testimonials</a></li>
        <li><a href="resources.html">Resources</a></li>
        <li><a href="contact.html">Contact Us</a></li>
      </ul>
    </nav>
    <a href="login.html" class="contact-button">Log In</a>
  </header>
  
  

  <!-- Header Section -->
  <section class="header-banner">
    <h1>Our Services</h1>
    <p>Support, compassion, and understanding to guide you through life's challenges.</p>
    <img src="images/pexels-cottonbro-4101140.jpg" alt="Our Services" class="header-image">
  </section>

  <!-- Service Overview Section -->
  <section class="service-overview">
    <h2>What We Offer</h2>
    <p>At Together, we offer a range of mental health services designed to guide you through life’s challenges with support, compassion, and understanding.</p>
  </section>

  <!-- Detailed Services Section -->
  <section class="detailed-services">
    <h2>Explore Our Services</h2>
    <br>
    <div class="service-list">
      <div class="service-item">
        <img src="images/pexels-cottonbro-4100663.jpg" alt="Individual Therapy">
        <h3>Individual Therapy</h3>
        <p>Personalized one-on-one sessions to help you navigate life’s challenges.</p>
        <a href="individual_therapy.html" class="cta-button">Learn More</a>
      </div>
      <div class="service-item">
        <img src="images/pexels-cottonbro-4098223.jpg" alt="Couples Counseling">
        <h3>Couples Counseling</h3>
        <p>Strengthen relationships and improve communication with professional guidance.</p>
        <a href="couples_counseling.html" class="cta-button">Learn More</a>
      </div>
      <div class="service-item">
        <img src="images/pexels-shvets-production-7176305.jpg" alt="Group Sessions">
        <h3>Group Sessions</h3>
        <p>Join a supportive group environment to share and grow together.</p>
        <a href="group_sessions.html" class="cta-button">Learn More</a>
      </div>
    </div>
  </section>

  <!-- Telehealth Section -->
  <section class="telehealth-option">
    <h2>Telehealth Services</h2>
    <p>Prefer remote sessions? Our online therapy options bring expert care to the comfort of your home. Accessible, secure, and tailored to your needs.</p>
    <a href="contact.html" class="cta-button">Book a Free Consultation</a>
  </section>

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 Together Mental Health Platform</p>
  </footer>
</body>
</html>
