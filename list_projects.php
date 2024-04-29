<?php
require 'config.php'; // Database configuration file

try {
    $db = new PDO("mysql:host=localhost;dbname=aproject", "root", "wenslaus001"); // Database credentials
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch all projects from the "projects" table
    $result = $db->query("SELECT * FROM projects");
    
    $projects = [];
    
    // Collect all projects in an array
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $projects[] = $row; // Add each project to the array
    }
    
    echo json_encode($projects); // Return the list as JSON
    
} catch (PDOException $e) {
    error_log("Database error: " . htmlspecialchars($e->getMessage())); // Log database errors
    echo "An error occurred while fetching the projects.";
}
?>
