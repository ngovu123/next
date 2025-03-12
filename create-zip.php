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
    'README-DOWNLOAD.txt',
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
$zipname = 'email-verification-system.zip';

// Create a new ZIP archive
$zip = new ZipArchive();

if ($zip->open($zipname, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
    exit("Cannot open <$zipname>\n");
}

// Add files to the ZIP archive
foreach ($files as $file) {
    if (file_exists($file)) {
        if (is_dir($file)) {
            // Add directory recursively
            $dir = opendir($file);
            while ($filename = readdir($dir)) {
                if ($filename != '.' && $filename != '..') {
                    $zip->addFile($file . '/' . $filename, $file . '/' . $filename);
                }
            }
            closedir($dir);
        } else {
            // Add file
            $zip->addFile($file, $file);
        }
    } else {
        echo "Warning: File $file does not exist and was not added to the ZIP\n";
    }
}

// Close the ZIP archive
$zip->close();

echo "ZIP file created successfully: $zipname\n";
echo "<a href='$zipname' download>Download ZIP File</a>";
?>