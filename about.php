<?php
include 'include/db.php';  // Përfshini klasën e databazës
include 'include/header.php';

class AboutUs {
    private $db;
    private $aboutContent;

    public function __construct() {
        $this->db = new Database();  // Krijimi i një objekti të klasës Database
        $this->aboutContent = $this->db->fetchAboutUsContent(4);  // Thirra metodën për të marrë të dhënat
    }

    public function displayContent() {
        if ($this->aboutContent) {
            $about = $this->aboutContent;
            $video_url = !empty($about['video_url']) ? $about['video_url'] : 'default-video.mp4';
        } else {
            $about = [
                'title' => 'About Us',
                'description' => 'Description not available.',
                'team_message' => 'Our team is dedicated to helping you.',
                'our_story' => 'Our story is currently unavailable.',
                'video_url' => 'default-video.mp4'
            ];
            $video_url = $about['video_url'];
        }

        // HTML output starts here
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo htmlspecialchars($about['title']); ?></title>
            <link rel="stylesheet" href="assets/css/about.css">
            <link rel="stylesheet" href="assets/css/header.css">

        </head>
        <body>
        <center>
            <br><br><br>
            <h1><?php echo htmlspecialchars($about['title']); ?></h1><br>
            <p><?php echo htmlspecialchars($about['description']); ?></p><br>
            <p><?php echo htmlspecialchars($about['team_message']); ?></p>
            <br>

            <!-- Video Section -->
            <div class="video-container">
                <video autoplay muted loop width="600">
                    <source src="<?php echo htmlspecialchars($video_url); ?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
            <br>
        </center>

        <section class="our-story">
            <h2>Our Story</h2>
           <center><p><?php echo htmlspecialchars($about['our_story']); ?></p></center>
        </section>

        <!-- Meet Our Team Section (Slider) -->
        <div class="slider">
            <center><h3><?php echo htmlspecialchars($about['team_message']); ?></h3></center>
            <br>
            <div class="carousel">
                <!-- Carousel items -->
            </div>
        </div>

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
        <?php
    }
}

// Përdorimi i klasës
$aboutPage = new AboutUs();
$aboutPage->displayContent();
?>
