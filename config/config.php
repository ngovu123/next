<?php
// Application configuration
define('APP_NAME', 'Email Verification Registration System');
define('APP_URL', 'http://localhost');

// Email configuration
define('MAIL_HOST', 'smtp.example.com');
define('MAIL_PORT', 587);
define('MAIL_USERNAME', 'your-email@example.com');
define('MAIL_PASSWORD', 'your-email-password');
define('MAIL_FROM_ADDRESS', 'noreply@example.com');
define('MAIL_FROM_NAME', 'Registration System');

// Verification settings
define('VERIFICATION_CODE_LENGTH', 6);
define('VERIFICATION_CODE_EXPIRY', 30 * 60); // 30 minutes in seconds
define('MAX_VERIFICATION_ATTEMPTS', 5);

// Security settings
define('PASSWORD_MIN_LENGTH', 8);
define('PASSWORD_HASH_ALGO', PASSWORD_BCRYPT);
define('PASSWORD_HASH_COST', 12);

// Error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>