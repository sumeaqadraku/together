<?php
include 'include/db.php';  
include 'include/hearder.php';

// Fetch About Us content from the database
$about_sql = "SELECT * FROM about_us WHERE id = 1";  // assuming we have only one record for "About Us"
$about_result = $conn->query($about_sql);
$about = $about_result->fetch_assoc();  // Fetching the content as an associative array
?>
  
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
            <img src="images/Screenshot 2025-01-02 004537.png" alt="Therapist 1">
            <div class="caption">Dr. Emily Parker</div>
        </div>
        <div class="slide">
            <img src="images/Screenshot 2025-01-02 004626.png" alt="Therapist 1">
            <div class="caption">Dr. James Anderson</div>
        </div>
        <div class="slide">
            <img src="images/Screenshot 2025-01-02 004720.png" alt="Therapist 1">
            <div class="caption">Dr. Olivia Benett</div>
        </div>
        <div class="slide">
            <img src="images/Screenshot 2025-01-02 134940.png" alt="Therapist 1">
            <div class="caption">Dr. Daniel Williams</div>
        </div>
        <div class="slide">
          <img src="images/Screenshot 2025-01-02 134940.png" alt="Therapist 1">
          <div class="caption">Dr. Daniel Williams</div>
      </div>
      <div class="slide">
        <img src="images/Screenshot 2025-01-02 004720.png" alt="Therapist 1">
        <div class="caption">Dr. Daniel Williams</div>
    </div>
    <div class="slide">
      <img src="images/Screenshot 2025-01-02 004537.png" alt="Therapist 1">
      <div class="caption">Dr. Daniel Williams</div>
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
    <p>Ready to start your journey? <a href="services.html">Learn more about our services</a> or <a href="contact.html">contact us</a> to take the first step.</p>
  </section>

  <script src="js/main.js"></script>
</body>
</html>
