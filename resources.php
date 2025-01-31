<?php
include 'include/db.php';
include 'include/header.php';

// Include the necessary styles
echo '<link rel="stylesheet" href="assets/css/resources.css">';

// Create a new database connection object
$db = new Database();
$conn = $db->getConnection();  // Get the connection

?>

<!-- Resources Section -->
<section class="resources">
    <h1>Our Resources</h1>
    <p>Explore a range of resources designed to support your mental health journey. Whether you're looking for informative articles, self-help tools, or educational videos, you'll find what you need here.</p>

    <div class="resource-categories">
        <?php
        // Fetch resources grouped by category
        $resources_sql = "SELECT * FROM resources ORDER BY category, title";
        $resources_result = $conn->query($resources_sql);

        // Categories for display
        $categories = [
            'Article' => 'Articles',
            'Video' => 'Videos',
            'Self-Help Tool' => 'Self-Help Tools'
        ];

        // Organize the resources by category
        $resources = [];
        while ($row = $resources_result->fetch_assoc()) {
            $resources[$row['category']][] = $row;
        }

        // Loop through each category and display resources
        foreach ($categories as $db_category => $display_name) {
            if (!empty($resources[$db_category])) {
                echo "<div class='resource-category'>";
                echo "<h2>$display_name</h2>";
                echo "<ul>";

                // Loop through resources in each category
                foreach ($resources[$db_category] as $resource) {
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
