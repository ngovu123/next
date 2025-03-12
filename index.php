<?php
// Start session
session_start();

// Include configuration and database connection
require_once 'config/config.php';
require_once 'config/database.php';

// Default page is registration
$page = isset($_GET['page']) ? $_GET['page'] : 'register';

// Header
include 'includes/header.php';

// Main content
switch ($page) {
    case 'register':
        include 'pages/register.php';
        break;
    case 'verify':
        include 'pages/verify.php';
        break;
    case 'success':
        include 'pages/success.php';
        break;
    case 'locked':
        include 'pages/locked.php';
        break;
    default:
        include 'pages/register.php';
        break;
}

// Footer
include 'includes/footer.php';
?>