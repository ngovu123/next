<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo APP_NAME; ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header class="bg-light shadow-sm py-3 mb-4">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h4 mb-0 text-primary"><?php echo APP_NAME; ?></h1>
                <nav>
                    <ul class="nav">
                        <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">About</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">Contact</a></li>
                        <li class="nav-item"><a href="#" class="nav-link text-primary fw-medium">Sign In</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    
    <main class="container py-4">