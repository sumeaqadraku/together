<?php
include 'include/db.php';  
include 'include/header.php';
?>
<head>
<link rel="stylesheet" href="assets/css/contact.css">
</head>
<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <h1>We’re Here For You</h1>
        <p>We understand that reaching out for help can be difficult. Our team is here to provide support, answer your questions, and guide you to the right resources. Feel free to contact us via the form below or through our other communication channels.</p>
    </div>
    <div class="hero-image">
        <img src="images/pexels-ivan-samkov-9630216.jpg" alt="Hero Image" />
    </div>
</section>

<!-- Contact Information Section -->
<section class="contact-info">
    <div class="contact-details">
        <div class="contact-item">
            <h3>Email Us</h3>
            <p>support@together.com</p>
        </div>
        <div class="contact-item">
            <h3>Call Us</h3>
            <p>(123) 456-7890</p>
        </div>
        <div class="contact-item">
            <h3>Visit Us</h3>
            <p>123 Mental Health St, Suite 45, City, State, ZIP</p>
        </div>
    </div>
</section>
<br>

<!-- Contact Form Section -->
<section class="contact-form-container">
    <h2>Send Us a Message</h2>
    <br>

    <?php
    // Display success or error messages
    if (isset($_GET['success'])) {
        echo "<p class='success-message'>Your message has been sent successfully!</p>";
    } elseif (isset($_GET['error'])) {
        echo "<p class='error-message'>There was an error. Please try again.</p>";
    }
    ?>

    <div class="contact-us">
        <div class="form-section">
            <form action="contact.php" method="post">
                <div class="form-group">
                    <label for="name">Your Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Your Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="message">Your Message</label>
                    <textarea id="message" name="message" rows="5" required></textarea>
                </div>
                <button type="submit" name="submit" class="cta-button">Send Message</button>
            </form>
        </div>

        <div class="video-section">
            <video class="service-video" autoplay muted loop>
                <source src="images/11025441-hd_4096_2160_30fps.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>
</section>

<!-- Footer Section -->
<footer>
    <p>&copy; 2025 Together Mental Health Platform. All rights reserved.</p>
</footer>

</body>
</html>

<?php
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Sanitize input data
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);

    // Insert data into the correct database table `contact_form`
    $sql = "INSERT INTO contact_form (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        header("Location: contact.php?success=1");
        exit();
    } else {
        header("Location: contact.php?error=1");
        exit();
    }
}

// Close DB connection
$conn->close();
?>
