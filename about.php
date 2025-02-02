<?php
include 'include/db.php';  
include 'include/header.php';


class AboutUs {
    private $conn;
    private $about;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    
    public function fetchContent($id) {
        $sql = "SELECT * FROM about_us WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $this->about = $stmt->fetch(PDO::FETCH_ASSOC); 
    }

    public function getAbout() {
        return $this->about;
    }

    public function getVideoUrl() {
        return !empty($this->about['video_url']) ? $this->about['video_url'] : 'default-video.mp4';
    }
}

$db = new Database();
$conn = $db->getConnection();
$aboutUs = new AboutUs($conn);

$aboutUs->fetchContent(4);
$about = $aboutUs->getAbout();
$video_url = $aboutUs->getVideoUrl();

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
        <br><br>
        <h1><?php echo htmlspecialchars($about['title']); ?></h1><br>
        <p><?php echo htmlspecialchars($about['description']); ?></p><br>
        <p><?php echo htmlspecialchars($about['our_story']); ?></p><br>
        <p><?php echo htmlspecialchars($about['team_message']); ?></p>
        <br><br>

        <div class="video-container">
            <video autoplay muted loop width="600">
                <source src="<?php echo htmlspecialchars($video_url); ?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <br>

        <section class="our-story">
            <h2>Our Story</h2>
            <center><p><?php echo htmlspecialchars($about['our_story']); ?></p></center>
        </section>

        <div class="slider">
            <center><h3><?php echo htmlspecialchars($about['team_message']); ?></h3></center>
            <br>
            <div class="carousel">
                <div class="slide">
                    <img src="images/66e07c26223c0345b2705eb7-66e08f9fc5edea00ff7a9c9b-thumbnail.jpg" alt="Dr. Emily Parker">
                    <div class="caption">Dr. Emily Parker</div>
                </div>
                <div class="slide">
                    <img src="images/66ddf4376745c476c5c794ef-66de06815eaa4a2a0d6ce7e2-thumbnail.jpg" alt="Dr. Oliver Benett">
                    <div class="caption">Dr. Oliver Benett</div>
                </div>
                <div class="slide">
                    <img src="images/66df00c7af792f4f099d4641-66df0ddb949d822c43bf9c01-thumbnail.jpg" alt="Dr. Anna Anderson">
                    <div class="caption">Dr. Anna Anderson</div>
                </div>
                <div class="slide">
                    <img src="images/66e0393b9ffcf0b7467bd9bb-66e078c69b00ce6cdd63f2d6-thumbnail.jpg" alt="Dr. Anna Anderson">
                    <div class="caption">Dr. James Thompson</div>
                </div>
                <div class="slide">
                    <img src="images/674feb9ae4bbb8c6416767ea-674ff769eba7a54dcff4d432-thumbnail.jpg" alt="Dr. Anna Anderson">
                    <div class="caption">Dr. Olivia Martinez</div>
                </div>
                <div class="slide">
                    <img src="images/66ddb4a724feda18e1731e8a-66ddc2f94b01c76d93729c68-thumbnail.jpg" alt="Dr. Anna Anderson">
                    <div class="caption">Dr. Thomas Collins</div>
                </div>
                
            </div>
        </div>

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

        <section class="cta">
            <p>Ready to start your journey? <a href="services.php">Learn more about our services</a> or <a href="contact.php">contact us</a> to take the first step.</p>
        </section>
    </center>

    <script src="js/main.js"></script>
</body>
</html>
