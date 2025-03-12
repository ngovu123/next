<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// Include configuration and database connection
require_once 'config/config.php';
require_once 'config/database.php';

// Get user information
$user_id = $_SESSION['user_id'];
$full_name = $_SESSION['full_name'];
$email = $_SESSION['email'];

// Include header
include 'includes/header.php';
?>

<div class="container py-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <div class="d-inline-block rounded-circle bg-primary bg-opacity-10 p-3">
                            <i class="fas fa-user fa-3x text-primary"></i>
                        </div>
                    </div>
                    <h5 class="card-title"><?php echo htmlspecialchars($full_name); ?></h5>
                    <p class="card-text text-muted"><?php echo htmlspecialchars($email); ?></p>
                    <a href="profile.php" class="btn btn-outline-primary btn-sm">Edit Profile</a>
                </div>
            </div>
            
            <div class="list-group mb-4">
                <a href="dashboard.php" class="list-group-item list-group-item-action active">
                    <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                </a>
                <a href="profile.php" class="list-group-item list-group-item-action">
                    <i class="fas fa-user me-2"></i> Profile
                </a>
                <a href="settings.php" class="list-group-item list-group-item-action">
                    <i class="fas fa-cog me-2"></i> Settings
                </a>
                <a href="logout.php" class="list-group-item list-group-item-action text-danger">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </a>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">Welcome to Your Dashboard</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading">Successfully Logged In!</h4>
                        <p>Your account has been verified and you are now logged in. This is your dashboard where you can manage your account and access various features.</p>
                        <hr>
                        <p class="mb-0">Thank you for completing the registration and verification process.</p>
                    </div>
                    
                    <h5>Account Information</h5>
                    <table class="table">
                        <tbody>
                            <tr>
                                <th scope="row" style="width: 30%;">Full Name</th>
                                <td><?php echo htmlspecialchars($full_name); ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Email</th>
                                <td><?php echo htmlspecialchars($email); ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Account Status</th>
                                <td><span class="badge bg-success">Verified</span></td>
                            </tr>
                            <tr>
                                <th scope="row">Registration Date</th>
                                <td><?php echo date('F j, Y'); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Include footer
include 'includes/footer.php';
?>