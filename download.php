<?php
// Script to create a downloadable ZIP file of the PHP project

// Define the files to include in the ZIP
$files = [
    'index.php',
    'login.php',
    'logout.php',
    'dashboard.php',
    'setup.php',
    'composer.json',
    'README.md',
    '.htaccess',
    'config/config.php',
    'config/database.php',
    'config/database_schema.php',
    'includes/header.php',
    'includes/footer.php',
    'includes/mailer.php',
    'pages/register.php',
    'pages/verify.php',
    'pages/success.php',
    'pages/locked.php',
    'assets/css/style.css',
    'assets/js/script.js'
];

// Create a temporary file for the ZIP archive
$zipFile = tempnam(sys_get_temp_dir(), 'zip');

// Create a new ZIP archive
$zip = new ZipArchive();
$zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE);

// Add files to the ZIP archive
foreach ($files as $file) {
    if (file_exists($file)) {
        $zip->addFile($file, $file);
    }
}

// Close the ZIP archive
$zip->close();

// Set headers for download
header('Content-Type: application/zip');
header('Content-Disposition: attachment; filename="email-verification-system.zip"');
header('Content-Length: ' . filesize($zipFile));
header('Pragma: no-cache');
header('Expires: 0');

// Output the ZIP file
readfile($zipFile);

// Delete the temporary file
unlink($zipFile);
?>