<?php 
include 'include/db.php';
include 'include/header.php';

class ResourcesPage {
    private $db;
    private $resources;

    public function __construct() {
        $this->db = new Database(); // Krijo një objekt të klasës Database
        $this->loadResources();      // Ngarko burimet nga baza e të dhënave
    }

    private function loadResources() {
        $conn = $this->db->getConnection();
        $sql = "SELECT * FROM resources ORDER BY category, title";
        $result = $conn->query($sql);

        if ($result && $result->rowCount() > 0) {
            $resources = [];
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $resources[$row['category']][] = $row;
            }
            $this->resources = $resources;
        } else {
            $this->resources = [];
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
            <title>Resources</title>
            <link rel="stylesheet" href="assets/css/resources.css">
            <link rel="stylesheet" href="assets/css/header.css">

        </head>
        <body>

        <!-- Resources Section -->
        <section class="resources">
            <h1>Our Resources</h1>
            <p>Explore a range of resources designed to support your mental health journey. Whether you're looking for informative articles, self-help tools, or educational videos, you'll find what you need here.</p>

            <div class="resource-categories">
                <?php
                // Categories for display
                $categories = [
                    'Article' => 'Articles',
                    'Video' => 'Videos',
                    'Self-Help Tool' => 'Self-Help Tools'
                ];

                // Loop through each category and display resources
                foreach ($categories as $db_category => $display_name) {
                    if (!empty($this->resources[$db_category])) {
                        echo "<div class='resource-category'>";
                        echo "<h2>$display_name</h2>";
                        echo "<ul>";

                        // Loop through resources in each category
                        foreach ($this->resources[$db_category] as $resource) {
                            echo "<li>";
                            if (!empty($resource['url'])) {
                                echo "<a href='" . htmlspecialchars($resource['url']) . "' target='_blank'>";
                            }
                            echo htmlspecialchars($resource['title']);
                            if (!empty($resource['url'])) {
                                echo "</a>";
                            }
                            echo "</li>";
                        }

                        echo "</ul>";
                        echo "</div>";
                    }
                }

                if (empty($this->resources)) {
                    // Display a fallback message if there are no resources
                    echo "<p>No resources available at the moment. Please check back later or <a href='contact.php'>contact us</a> for more information.</p>";
                }
                ?>
            </div>

            <br><br>
            <a href="contact.php" class="cta-button">Contact Us for More Resources</a>
        </section>

        <!-- Footer -->
        <footer>
            <p>&copy; 2025 Together Mental Health Platform</p>
        </footer>

        </body>
        </html>
        <?php
    }
}

// Përdorimi i klasës
$resourcesPage = new ResourcesPage();
$resourcesPage->display();
?>
