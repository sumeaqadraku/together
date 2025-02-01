<?php
include 'include/db.php';  
include 'include/header.php';

// Initialize Database Connection
$db = new Database();
$conn = $db->getConnection();
?>

<head>
<link rel="stylesheet" href="assets/css/couples_counseling.css">
<link rel="stylesheet" href="assets/css/header.css">

</head>  

  <!-- Header Section -->
  <section class="video-text-section">
    <div class="video-container">
      <video class="service-video" autoplay muted loop>
        <source src="images/8135064-uhd_4096_2160_25fps.mp4" type="video/mp4">
        Your browser does not support the video tag.
      </video>
    </div>
    <div class="text-container">
      <h2>Struggling with Communication? We Can Help.</h2>
      <p>Are you feeling stuck? Struggling with communication or emotional connection in your relationship? Therapy can help you find clarity, healing, and understanding. Our professional therapists are here to guide you through the process, offering a safe and supportive environment to work through your challenges.</p>
      <br>
      <a href="contact.php" class="cta-button">Reach Out Now</a>
    </div>
  </section>
  

  <!-- Counseling Overview Section -->
   <div class="contant">
    <div class="pjesa1">
  <section class="counseling-overview">
    <h2>What is Couples Counseling?</h2>
    <p>Couples counseling offers a safe, supportive environment where you and your partner can work together with a therapist to address relationship challenges, improve communication, and deepen emotional connection. Whether you're facing conflict, trust issues, or simply seeking ways to enhance your bond, our therapists are here to help you navigate the path to a healthier, more fulfilling relationship.</p>
  </section>

  <!-- Benefits of Couples Counseling Section -->
  <section class="counseling-benefits">
    <h2>Benefits of Couples Counseling</h2>
    <ul>
      <li>Enhance communication and understanding between partners.</li>
      <li>Resolve conflicts and work through trust issues.</li>
      <li>Strengthen emotional and physical intimacy.</li>
      <li>Gain tools to manage stress and improve conflict resolution.</li>
      <li>Work together toward a shared vision for the future.</li>
    </ul>
  </section>
</div>
<div class="pjesa2">
  <!-- How It Works Section -->
  <section class="how-it-works">
    <h2>How Couples Counseling Works</h2>
    <p>Couples counseling typically begins with an initial assessment where the therapist learns about the relationship dynamics and the issues you wish to address. From there, the therapist works with both partners to create a customized approach, focusing on open communication, understanding, and problem-solving. Sessions are often weekly or bi-weekly and last 50 minutes each.</p>
  </section>
  <section class="your-journey">
    <h2>Your Journey to a Stronger Relationship Starts Here</h2>
    <p>Couples therapy is a powerful tool to help you and your partner rediscover connection, heal from past wounds, and create a stronger, more fulfilling relationship. Whether you're facing conflict, feeling disconnected, or simply want to deepen your bond, therapy provides a safe space to work through challenges together and rebuild trust and intimacy.</p>
  </section>
</div></div>
  <!-- Call to Action Section -->
  <section class="cta-section">
    <h2>Strengthen Your Relationship Today</h2><br><br>
    <p>If you're ready to take the next step toward a healthier, more fulfilling relationship, schedule a free consultation with one of our couples therapists today. Let us help you build a stronger connection with your partner.</p>
   <br><br>
    <a href="contact.php" class="cta-button">Book a Free Consultation</a>
  </section>

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 Together Mental Health Platform</p>
  </footer>
</body>
</html>
