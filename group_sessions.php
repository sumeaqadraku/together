<?php
include 'include/db.php'; 
include 'include/header.php';

$db = new Database();
$conn = $db->getConnection();
?>


  <link rel="stylesheet" href="assets/css/group_therapy.css">
  <link rel="stylesheet" href="assets/css/individual_therapy.css">

  <link rel="stylesheet" href="assets/css/header.css">

  <section class="video-text-section" >
  <div class="video-container">
    <video class="service-video" autoplay muted loop>
      <source src="images/3253970-uhd_3840_2160_25fps.mp4">
      Your browser does not support the video tag.
    </video>
  </div>
  <div class="text-container">
    <h2>Find Strength in Community</h2>
    <p>Group therapy provides an opportunity to connect with others who understand your struggles. Share, learn, and heal together in a supportive, non-judgmental environment. If you’ve been feeling isolated or overwhelmed, group therapy can help you gain valuable insights and encouragement. Come and join our community where you’re never alone.</p>
    <br>
    <a href="contact.php" class="cta-button">Reach Out Now</a>
  </div>
</section>
  <div class="contant">
     <div class="pjesa1">
    <section class="therapy-overview">
      <h2>What is Group Therapy?</h2><br>
      <p>Group therapy provides a supportive environment where individuals come together to share experiences, learn from one another, and work toward personal growth under the guidance of a trained therapist. It’s a space where you can feel heard, understood, and empowered while building connections with others facing similar challenges. Whether you’re dealing with anxiety, depression, grief, or relationship struggles, group therapy can help you realize you’re not alone in your journey.</p>
    </section>
  
    <section class="therapy-benefits">
      <h2>Benefits of Group Therapy</h2><br>
      <ul>
        <li>Gain comfort in connecting with others who can relate to your experiences.</li>
        <li>Learn from diverse viewpoints and strategies shared by group members.</li>
        <li>Build practical tools for managing stress, anxiety, and emotional challenges.</li>
        <li>Develop a sense of belonging and encouragement from others.</li>
        <li>Practice communication, empathy, and conflict resolution in a safe space.</li>
      </ul>
    </section>
  </div>
  <div class="pjesa2">
    <section class="how-it-works">
      <h2>How Group Therapy Works</h2><br>
      <p>Group therapy sessions typically consist of 6–12 members and are led by a licensed therapist who facilitates discussions and activities. Each session lasts about 60–90 minutes and may focus on specific themes, such as emotional regulation, relationship dynamics, or coping strategies. While participants share their stories and insights, the therapist provides guidance to foster a supportive and productive environment. Sessions can be held weekly or bi-weekly, depending on the group’s needs.</p>
    </section>
    <section class="your-journey">
      <h2>Your Path to Growth Through Connection</h2><br>
      <p>Group therapy is more than just a treatment—it’s a chance to grow and heal through the power of connection. In a group setting, you’ll discover that your struggles are shared by others and gain strength from mutual support. Together, you’ll learn new skills, celebrate progress, and build lasting relationships that inspire continued growth.</p>
    </section>
  </div></div>
   <section class="cta-section">
    <h2>Strengthen Your Relationship Today</h2><br><br>
    <p>If you're ready to take the first step toward healing and connection—join a group therapy session today.</p>
   <br><br>
    <a href="contact.php" class="cta-button">Book a Free Consultation</a>
  </section>

  <footer>
    <p>&copy; 2025 Together Mental Health Platform</p>
  </footer>
</body>
</html>
