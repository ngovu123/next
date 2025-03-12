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
        <div class="auth-card p-5">
            <div class="text-center">
                <div class="status-icon error mb-4">
                    <i class="fas fa-lock fa-2x"></i>
                </div>
                
                <h2 class="h4 mb-3">Account Locked</h2>
            </div>
            
            <div class="alert alert-danger mb-4">
                <div class="d-flex">
                    <i class="fas fa-exclamation-triangle me-2 mt-1"></i>
                    <div>
                        <strong>Verification Failed</strong>
                        <p class="mb-0">Your account has been temporarily locked due to multiple failed verification attempts.</p>
                    </div>
                </div>
            </div>
            
            <div class="text-center mb-4">
                <p>We've detected multiple unsuccessful verification attempts for:</p>
                <p class="fw-medium">
                    <i class="fas fa-envelope me-1"></i> <?php echo htmlspecialchars($email); ?>
                </p>
            </div>
            
            <div class="d-grid gap-2">
                <a href="index.php?page=register" class="btn btn-outline-secondary">Try Again Later</a>
                <a href="#" class="btn btn-primary">Contact Support</a>
            </div>
        </div>
    </div>
</div>