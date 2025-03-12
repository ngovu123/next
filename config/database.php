<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'registration_system');

// Create database connection
try {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    
    // Set charset to utf8mb4
    $conn->set_charset("utf8mb4");
    
} catch (Exception $e) {
    // If database doesn't exist, create it
    if (strpos($e->getMessage(), "Unknown database") !== false) {
        $temp_conn = new mysqli(DB_HOST, DB_USER, DB_PASS);
        
        // Create database
        $sql = "CREATE DATABASE IF NOT EXISTS " . DB_NAME . " CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
        if ($temp_conn->query($sql) === TRUE) {
            // Connect to the newly created database
            $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $conn->set_charset("utf8mb4");
            
            // Create tables
            require_once 'database_schema.php';
            createDatabaseSchema($conn);
        } else {
            die("Error creating database: " . $temp_conn->error);
        }
        
        $temp_conn->close();
    } else {
        die("Database connection failed: " . $e->getMessage());
    }
}
?>