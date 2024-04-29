<?php
require 'config.php'; // Database configuration file

if (isset($_GET['pid'])) {
    $pid = intval($_GET['pid']); // Get the project ID

    try {
        $db = new PDO("mysql:host=localhost;dbname=aproject", "root", "wenslaus001"); // Database credentials
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare the SQL query with a parameterized placeholder
        $stmt = $db->prepare("SELECT * FROM projects WHERE pid = ?");
        $stmt->bindParam(1, $pid, PDO::PARAM_INT); // Bind the project ID
        
        $stmt->execute(); // Execute the query
        
        $project = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the project details
        
        if ($project) {
            echo "<h2>Project Details</h2>";
            echo "<p><strong>Title:</strong> " . htmlspecialchars($project['title']) . "</p>";
            echo "<p><strong>Description:</strong> " . htmlspecialchars($project['description']) . "</p>";
            echo "<p><strong>Start Date:</strong> " . htmlspecialchars($project['start_date']) . "</p>";
            echo "<p><strong>End Date:</strong> " . htmlspecialchars($project['end_date']) . "</p>";
            echo "<p><strong>Phase:</strong> " . htmlspecialchars($project['phase']) . "</p>";
        } else {
            echo "Project not found.";
        }
        
    } catch (PDOException $e) {
        error_log("Database error: " . htmlspecialchars($e->getMessage())); // Log errors
        echo "An error occurred while fetching project details.";
    }
} else {
    echo "No project ID provided.";
}
?>
