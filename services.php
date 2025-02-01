<?php
include 'include/db.php';  
include 'include/header.php';

class ServicePage {
    private $db;
    private $introText;
    private $services;

    public function __construct() {
        $this->db = new Database(); // Krijo një objekt të klasës Database
        $this->loadIntroText();     // Ngarko tekstin hyrës
        $this->loadServices();      // Ngarko shërbimet
    }

    private function loadIntroText() {
        $conn = $this->db->getConnection();
        $sql = "SELECT * FROM service_intro LIMIT 1"; 
        $result = $conn->query($sql);
        
        if ($result && $result->rowCount() > 0) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            $this->introText = $row['intro_text'];
        } else {
            $this->introText = 'Introductory text not available.';
        }
    }

    private function loadServices() {
        $conn = $this->db->getConnection();
        $sql = "SELECT * FROM explore_services"; 
        $result = $conn->query($sql);
        
        if ($result && $result->rowCount() > 0) {
            $this->services = $result->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $this->services = [];
        }
    }

    public function display() {
        // HTML output begins here
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="assets/css/services.css">
            <link rel="stylesheet" href="assets/css/header.css">

            <title>Our Services</title>
        </head>
        <body>

            <!-- Header Section -->
            <section class="header-banner">
                <h1>Our Services</h1>
                <p>Support, compassion, and understanding to guide you through life's challenges.</p>
            </section>

            <!-- Dynamic Introductory Text Section -->
            <center>
                <section class="intro-text">
                    <p><?php echo htmlspecialchars($this->introText); ?></p>
                </section>
            </center>

            <!-- Detailed Services Section -->
            <section class="detailed-services">
                <h2>Explore Our Services</h2>
                <br>
                <div class="service-list">
                    <?php
                    if (!empty($this->services)) {
                        foreach ($this->services as $service) {
                            echo '<div class="service-item">';
                            echo '<img src="' . htmlspecialchars($service['image_path']) . '" alt="' . htmlspecialchars($service['title']) . '">'; 
                            echo '<h3>' . htmlspecialchars($service['title']) . '</h3>';
                            echo '<p>' . htmlspecialchars($service['description']) . '</p>';
                            echo '<a href="' . htmlspecialchars($service['link']) . '" class="cta-button">Learn More</a>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>No services available at the moment.</p>';
                    }
                    ?>
                </div>
            </section>

            <!-- Footer -->
            <footer>
                <center><p>&copy; 2025 Together Mental Health Platform</p></center>
            </footer>
        </body>
        </html>
        <?php
    }
}

// Përdorimi i klasës
$servicePage = new ServicePage();
$servicePage->display();
?>
