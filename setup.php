<?php
// Database setup script
require_once "config/config.php";

// Create database connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS " . DB_NAME . " CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

// Connect to the newly created database
$conn->select_db(DB_NAME);

// Create tables
require_once "config/database_schema.php";
createDatabaseSchema($conn);

echo "Database setup completed successfully!";
?>
