<?php
// Start session
session_start();

// Include configuration and database connection
require_once 'config/config.php';
require_once 'config/database.php';

$error_message = '';

// Process login form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate input
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($email) || empty($password)) {
        $error_message = 'Please enter both email and password.';
    } else {
        // Check if user exists and is verified
        $stmt = $conn->prepare("SELECT id, full_name, email, password, is_verified, is_locked FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            
            // Check if account is locked
            if ($user['is_locked'] == 1) {
                $error_message = 'Your account has been locked. Please contact support.';
            }
            // Check if account is verified
            elseif ($user['is_verified'] == 0) {
                $error_message = 'Please verify your email before logging in.';
                // Store user ID in session to allow verification
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
            }
            // Verify password
            elseif (password_verify($password, $user['password'])) {
                // Set session variables
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['full_name'] = $user['full_name'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['logged_in'] = true;
                
                // Redirect to dashboard or home page
                header("Location: dashboard.php");
                exit;
            } else {
                $error_message = 'Invalid email or password.';
            }
        } else {
            $error_message = 'Invalid email or password.';
        }
        
        $stmt->close();
    }
}

// Include header
include 'includes/header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="auth-card p-4">
            <h2 class="h4 text-center mb-4">Login to Your Account</h2>
            
            <?php if (!empty($error_message)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error_message; ?>
                </div>
                
                <?php if (strpos($error_message, 'verify your email') !== false): ?>
                    <div class="alert alert-info" role="alert">
                        <p>Need to verify your email?</p>
                        <a href="index.php?page=verify" class="btn btn-sm btn-primary">Go to Verification</a>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email ?? ''); ?>" required>
                </div>
                
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="position-relative">
                        <input type="password" class="form-control" id="password" name="password" required>
                        <button type="button" class="password-toggle">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>
                
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
            
            <div class="text-center mt-3">
                <p class="small">Don't have an account? <a href="index.php" class="text-decoration-none">Register</a></p>
                <p class="small"><a href="forgot-password.php" class="text-decoration-none">Forgot your password?</a></p>
            </div>
        </div>
    </div>
</div>

<?php
// Include footer
include 'includes/footer.php';
?>