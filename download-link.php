<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download Source Code</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 50px 0;
        }
        .download-card {
            max-width: 600px;
            margin: 0 auto;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        .file-list {
            max-height: 300px;
            overflow-y: auto;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="download-card p-4">
            <div class="text-center mb-4">
                <h2 class="h3 mb-3">Email Verification Registration System</h2>
                <p class="text-muted">PHP & MySQL Source Code</p>
            </div>
            
            <div class="alert alert-info">
                <h5>Included Files:</h5>
                <div class="file-list">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">index.php</li>
                        <li class="list-group-item">login.php</li>
                        <li class="list-group-item">logout.php</li>
                        <li class="list-group-item">dashboard.php</li>
                        <li class="list-group-item">setup.php</li>
                        <li class="list-group-item">composer.json</li>
                        <li class="list-group-item">README.md</li>
                        <li class="list-group-item">.htaccess</li>
                        <li class="list-group-item">config/config.php</li>
                        <li class="list-group-item">config/database.php</li>
                        <li class="list-group-item">config/database_schema.php</li>
                        <li class="list-group-item">includes/header.php</li>
                        <li class="list-group-item">includes/footer.php</li>
                        <li class="list-group-item">includes/mailer.php</li>
                        <li class="list-group-item">pages/register.php</li>
                        <li class="list-group-item">pages/verify.php</li>
                        <li class="list-group-item">pages/success.php</li>
                        <li class="list-group-item">pages/locked.php</li>
                        <li class="list-group-item">assets/css/style.css</li>
                        <li class="list-group-item">assets/js/script.js</li>
                    </ul>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <a href="download.php" class="btn btn-primary btn-lg">
                    <i class="fas fa-download me-2"></i> Download Source Code
                </a>
            </div>
            
            <div class="mt-4">
                <h5>Installation Instructions:</h5>
                <ol>
                    <li>Extract the ZIP file to your web server directory</li>
                    <li>Configure database settings in <code>config/config.php</code></li>
                    <li>Run <code>setup.php</code> to create the database and tables</li>
                    <li>Install dependencies using Composer: <code>composer install</code></li>
                    <li>Access the application through your web browser</li>
                </ol>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>
</html>