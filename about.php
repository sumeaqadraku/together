<?php
include 'include/db.php'; 
include 'include/header.php'; 


// Fetch About Us content from the database
$about_sql = "SELECT * FROM about_us WHERE id = 4";  // assuming we have only one record for "About Us"
$about_result = $conn->query($about_sql);
$about = $about_result->fetch_assoc();  // Fetching the content as an associative array
?>
<center>
  <br>

  <h1><?php echo $about['title']; ?></h1>
  <p><?php echo $about['description']; ?></p>
  <p><?php echo $about['our_story']; ?></p>
  <p><?php echo $about['team_message']; ?></p>
 <br>

  <!-- Video Section -->
  <div class="video-container">
    <video autoplay muted loop width="600">
      <source src="<?php echo $about['video_url']; ?>" type="video/mp4">
      Your browser does not support the video tag.
    </video>
  </div>
<br>

    <head>
    <link rel="stylesheet" href="assets/css/about.css">
    </head>
    <section class="our-story">
      <h2>Our Story</h2>
      <p><?php echo $about['our_story']; ?></p>
    </section>

    <!-- Meet Our Team Section (Slider) -->
    <div class="slider">
      <center><h3><?php echo $about['team_message']; ?></h3></center>
      <br>
      <div class="carousel">
        <div class="slide">
            <img src="images/66e07c26223c0345b2705eb7-66e08f9fc5edea00ff7a9c9b-thumbnail.jpg" alt="Therapist 1">
            <div class="caption">Dr. Emily Parker</div>
          </div>
          <div class="slide">
              <img src="images/66ddf4376745c476c5c794ef-66de06815eaa4a2a0d6ce7e2-thumbnail.jpg" alt="Therapist 1">
              <div class="caption">Dr. Oliver Benett</div>
          </div>
        <div class="slide">
            <img src="images/66df00c7af792f4f099d4641-66df0ddb949d822c43bf9c01-thumbnail.jpg" alt="Therapist 1">
            <div class="caption">Dr. Anna Anderson</div>
        </div>
        <div class="slide">
            <img src="images/66e0393b9ffcf0b7467bd9bb-66e078c69b00ce6cdd63f2d6-thumbnail.jpg" alt="Therapist 1">
            <div class="caption">Dr. Daniel Williams</div>
        </div>
      <div class="slide">
        <img src="images/66dfd8fbf73532bdd918f7fd-66dfe79958f426b7cd7d7288-thumbnail.jpg" alt="Therapist 1">
        <div class="caption">Dr. Dana James</div>
    </div>
  <div class="slide">
      <img src="images/66ddb4a724feda18e1731e8a-66ddc2f94b01c76d93729c68-thumbnail.jpg" alt="Therapist 1">
      <div class="caption">Dr. Joey Henderson</div>
  </div>
      
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
    <p>Ready to start your journey? <a href="services.php">Learn more about our services</a> or <a href="contact.php">contact us</a> to take the first step.</p>
  </section>

  <script src="js/main.js"></script>
</body>
</html>
