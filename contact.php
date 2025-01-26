<?php
include 'include/db.php';  

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/contact.css">
  <title>Contact Us - Together Mental Health</title>
</head>
<body>
  <!-- Header Section -->
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
  <!-- Hero Section -->
  <section class="hero">
    <div class="hero-content">
      <h1>We’re Here For You</h1><br><br>

      <p>We understand that reaching out for help can be difficult. Our team is here to provide support, answer your questions, and guide you to the right resources. Feel free to contact us via the form below or through our other communication channels.</p>
    </div>
  </section>

  <!-- Contact Information Section -->
  <section class="contact-info">
   
    
    <div class="contact-details">
      <div class="contact-item">
        <h3>Email Us</h3><br>
        <p>support@together.com</p>
      </div>
      <div class="contact-item" style="background-color: #e6e6e6a8;">
        <h3>Call Us</h3><br>
        <p>(123) 456-7890</p>
      </div>
      <div class="contact-item" style="background-color: #f5f5f5;">
        <h3>Visit Us</h3><br>
        <p>123 Mental Health St, Suite 45, City, State, ZIP</p>
      </div>
    </div>
  </section>

  <!-- Contact Form Section -->
   <div class="contact-us">
  <section class="contact-form">
    <h2>Send Us a Message</h2>
    <form action="submit_contact_form.php" method="post">
      <div class="form-group">
        <label for="name">Your Name</label><br><br>
        <input type="text" id="name" name="name" required>
      </div>
      <div class="form-group">
        <label for="email">Your Email</label><br><br>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="message">Your Message</label><br><br>
        <textarea id="message" name="message" rows="5" required></textarea>
      </div>
      <button type="submit" class="cta-button">Send Message</button>
    </form>
  </section>
  <div class="video">
    <video class="service-video" autoplay muted loop>
      <source src="images/11025441-hd_4096_2160_30fps.mp4" type="video/mp4">
      Your browser does not support the video tag.
    </video>
  </div>
</div>
  <!-- Footer Section -->
  <footer>
    <p>&copy; 2025 Together Mental Health Platform. All rights reserved.</p>
  </footer>
</body>
</html>
