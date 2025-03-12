<?php
// Check if user is in session
if (!isset($_SESSION['user_id']) || !isset($_SESSION['email'])) {
    header("Location: index.php?page=register");
    exit;
}

$email = $_SESSION['email'];
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="auth-card p-5 text-center">
            <div class="status-icon success mb-4">
                <i class="fas fa-check-circle fa-2x"></i>
            </div>
            
            <h2 class="h4 mb-3">Account Verified Successfully!</h2>
            
            <p class="mb-4">Your account has been successfully verified. You can now log in to access your account.</p>
            
            <div class="d-grid">
                <a href="#" class="btn btn-primary">Go to Login</a>
            </div>
        </div>
    </div>
</div>