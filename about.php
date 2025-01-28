<?php
include 'include/db.php';  

// Fetch About Us content from the database
$about_sql = "SELECT * FROM about_us WHERE id = 1";  // assuming we have only one record for "About Us"
$about_result = $conn->query($about_sql);
$about = $about_result->fetch_assoc();  // Fetching the content as an associative array
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us - Together</title>
  <link rel="stylesheet" href="assets/css/about.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
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
  <section class="about-us">
    <!-- Hero Image Section -->
    <header class="hero">
      <div class="hero-container">
        <div class="hero-content">
          <h1><?php echo $about['title']; ?></h1>
          <p><?php echo $about['description']; ?></p>
        </div>
        <div class="hero-image">
          <video autoplay muted loop playsinline>
            <source src="images/3253970-uhd_3840_2160_25fps.mp4" type="video/mp4">
            Your browser does not support the video tag.
          </video>
        </div>
      </div>
    </header>

    <!-- Our Story Section -->
    <section class="our-story">
      <h2>Our Story</h2>
      <p><?php echo $about['our_story']; ?></p>
    </section>

    <!-- Meet Our Team Section (Slider) -->
    <div class="slider">
      <center><h3><?php echo $about['team_message']; ?></h3></center>
      <br>
      <div class="carousel">
        <!-- Add your team member images and captions here -->
        <!-- This can also be dynamically fetched from a database table if needed -->
        <div class="slide">
            <img src="images/Screenshot 2025-01-02 004537.png" alt="Therapist 1">
            <div class="caption">Dr. Emily Parker</div>
        </div>
        <!-- Additional team members can be added in similar slides -->
      </div>
    </div>
  </section>

  <!-- Our Values Section -->
  <section class="our-values">
    <div class="values-container">
      <div class="values-video">
        <video autoplay muted loop playsinline>
          <source src="images/8530343-uhd_3840_2160_25fps.mp4" type="video/mp4" />
          Your browser does not support the video tag.
        </video>
      </div>
      <div class="values-text">
        <h2>Our Values</h2>
        <ul>
          <li><strong>Empathy:</strong> We listen with understanding and compassion.</li>
          <li><strong>Growth:</strong> We help you grow emotionally, mentally, and spiritually.</li>
          <li><strong>Trust:</strong> We create a safe and trusting space for healing.</li>
          <li><strong>Community:</strong> We believe in the power of community and connection.</li>
          <li><strong>Inclusivity:</strong> We welcome everyone, regardless of background or identity.</li>
        </ul>
      </div>
    </div>
  </section>

  <!-- Call to Action Section -->
  <section class="cta">
    <p>Ready to start your journey? <a href="services.html">Learn more about our services</a> or <a href="contact.html">contact us</a> to take the first step.</p>
  </section>

  <script src="js/main.js"></script>
</body>
</html>
