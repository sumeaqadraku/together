<?php
include 'include/db.php';  
include 'include/header.php';

$db = new Database();
$conn = $db->getConnection();

?>

<link rel="stylesheet" href="assets/css/individual_therapy.css">
<link rel="stylesheet" href="assets/css/header.css">

<section class="video-text-section" >
  <div class="video-container">
    <video class="service-video" autoplay muted loop>
      <source src="images/7199185-uhd_3840_2160_25fps.mp4" type="video/mp4">
      Your browser does not support the video tag.
    </video>
  </div>
  <div class="text-container">
    <h2>Feeling Stuck? Therapy Can Help You Move Forward</h2>
    <p>Are you feeling overwhelmed, uncertain, or disconnected from yourself? Struggling with self-confidence, anxiety, or emotional clarity? Individual therapy offers a supportive space to explore your challenges, heal, and grow. Our compassionate therapists are here to help you find understanding, strength, and a path toward a more fulfilling life.</p>
    <br>
    <a href="contact.php" class="cta-button">Reach Out Now</a>
  </div>
</section>

<div class="contant">
  <div class="pjesa1">
    <section class="therapy-overview">
      <h2>What is Individual Therapy?</h2>
      <p>Individual therapy offers a safe, confidential space where you can work with a licensed therapist to explore your thoughts, feelings, and behaviors. Whether you're facing anxiety, depression, trauma, or simply looking to improve your mental well-being, our therapists are here to guide you through your personal growth journey.</p>
    </section>

   
    <section class="therapy-benefits">
      <h2>Benefits of Individual Therapy</h2>
      <ul>
        <li>Gain deeper self-understanding and emotional clarity.</li>
        <li>Develop coping strategies for stress, anxiety, and depression.</li>
        <li>Build self-confidence and resilience.</li>
        <li>Work through unresolved emotional issues or trauma.</li>
        <li>Achieve greater personal growth and fulfillment.</li>
      </ul>
    </section>
  </div>
  <div class="pjesa2">
 
    <section class="how-it-works">
      <h2>How Individual Therapy Works</h2>
      <p>Our individual therapy sessions are tailored to your unique needs. After an initial consultation, you and your therapist will work together to set goals and create a personalized treatment plan. Sessions typically last 50 minutes and are held on a weekly or bi-weekly basis.</p>
    </section>
    <section class="your-journey">
      <h2>Your Journey to Healing Starts Here</h2>
      <p>Every journey begins with a single step—and seeking therapy is a courageous one. Individual therapy is more than just a place to talk; it’s a transformative process where you can discover your inner strength, heal past wounds, and create a life aligned with your values and aspirations..</p>
    </section>
  </div>
</div>


<section class="cta-section">
  <h2>Ready to Start Your Therapy Journey?</h2><br><br>
  <p>If you're ready to begin therapy or want to learn more about how it can help you, schedule a free consultation with one of our therapists today. Together, we can help you navigate life's challenges with support, compassion, and understanding.</p>
  <br><br>
  <a href="contact.php" class="cta-button">Book a Free Consultation</a>
</section>

<footer>
  <p>&copy; 2025 Together Mental Health Platform</p>
</footer>
</body>
</html>
