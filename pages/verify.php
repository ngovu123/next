<?php
// Check if user is in session
if (!isset($_SESSION['user_id']) || !isset($_SESSION['email']) || !isset($_SESSION['verification_code'])) {
    header("Location: index.php?page=register");
    exit;
}

$user_id = $_SESSION['user_id'];
$email = $_SESSION['email'];
$verification_code = $_SESSION['verification_code'];
$expiry_time = $_SESSION['expiry_time'];
$time_left = max(0, $expiry_time - time());

// Get verification attempts from database
$stmt = $conn->prepare("SELECT attempts FROM verification_codes WHERE user_id = ? ORDER BY id DESC LIMIT 1");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$attempts = 0;

if ($row = $result->fetch_assoc()) {
    $attempts = $row['attempts'];
}

$stmt->close();

// Process verification form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if code is expired
    if (time() > $expiry_time) {
        $error_message = "Verification code has expired. Please request a new code.";
    } else {
        // Get submitted code
        $submitted_code = '';
        for ($i = 1; $i <= VERIFICATION_CODE_LENGTH; $i++) {
            $submitted_code .= $_POST["code_{$i}"] ?? '';
        }
        
        // Validate code
        if ($submitted_code === $verification_code) {
            // Update user as verified
            $stmt = $conn->prepare("UPDATE users SET is_verified = 1 WHERE id = ?");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $stmt->close();
            
            // Clear verification session data
            unset($_SESSION['verification_code']);
            unset($_SESSION['expiry_time']);
            
            // Redirect to success page
            header("Location: index.php?page=success");
            exit;
        } else {
            // Increment attempts
            $attempts++;
            
            // Update attempts in database
            $stmt = $conn->prepare("UPDATE verification_codes SET attempts = ? WHERE user_id = ? AND code = ?");
            $stmt->bind_param("iis", $attempts, $user_id, $verification_code);
            $stmt->execute();
            $stmt->close();
            
            // Check if max attempts reached
            if ($attempts >= MAX_VERIFICATION_ATTEMPTS) {
                // Lock account
                $stmt = $conn->prepare("UPDATE users SET is_locked = 1 WHERE id = ?");
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $stmt->close();
                
                // Clear verification session data
                unset($_SESSION['verification_code']);
                unset($_SESSION['expiry_time']);
                
                // Redirect to locked page
                header("Location: index.php?page=locked");
                exit;
            } else {
                $error_message = "Invalid verification code. " . (MAX_VERIFICATION_ATTEMPTS - $attempts) . " attempts remaining.";
            }
        }
    }
}

// Handle resend code
if (isset($_GET['resend']) && $_GET['resend'] === 'true') {
    // Generate new verification code
    $verification_code = '';
    for ($i = 0; $i < VERIFICATION_CODE_LENGTH; $i++) {
        $verification_code .= mt_rand(0, 9);
    }
    
    // Calculate new expiry time
    $expiry_time = time() + VERIFICATION_CODE_EXPIRY;
    $expiry_time_db = date('Y-m-d H:i:s', $expiry_time);
    
    // Insert new verification code
    $stmt = $conn->prepare("INSERT INTO verification_codes (user_id, code, expires_at) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $verification_code, $expiry_time_db);
    $stmt->execute();
    $stmt->close();
    
    // Update session data
    $_SESSION['verification_code'] = $verification_code;
    $_SESSION['expiry_time'] = $expiry_time;
    
    // Reset attempts
    $attempts = 0;
    
    $success_message = "A new verification code has been sent to your email.";
    
    // In a real app, you would send the email here
    // For demo purposes, we're just storing it in session
}
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="auth-card p-4">
            <h2 class="h4 text-center mb-4">Verify Your Email</h2>
            
            <div class="text-center mb-4">
                <p>We've sent a verification code to</p>
                <p class="fw-bold"><?php echo htmlspecialchars($email); ?></p>
            </div>
            
            <?php if (isset($error_message)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>
            
            <?php if (isset($success_message)): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $success_message; ?>
                </div>
            <?php endif; ?>
            
            <form id="verification-form" method="POST" action="">
                <div class="mb-4">
                    <label class="form-label text-center d-block">Enter Verification Code</label>
                    <div class="verification-inputs">
                        <?php for ($i = 1; $i <= VERIFICATION_CODE_LENGTH; $i++): ?>
                            <input type="text" class="form-control verification-input" name="code_<?php echo $i; ?>" maxlength="1" pattern="[0-9]" inputmode="numeric" required <?php echo $time_left <= 0 ? 'disabled' : ''; ?>>
                        <?php endfor; ?>
                    </div>
                </div>
                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="timer">
                        <i class="fas fa-clock me-1"></i>
                        <span id="verification-timer" data-expiry-time="<?php echo $time_left; ?>">
                            <?php echo $time_left > 0 ? sprintf('%02d:%02d', floor($time_left / 60), $time_left % 60) : 'Code expired'; ?>
                        </span>
                    </div>
                    <a href="index.php?page=verify&resend=true" class="text-decoration-none">Resend Code</a>
                </div>
                
                <?php if ($attempts > 0): ?>
                    <div class="text-danger small mb-3">
                        Failed attempts: <?php echo $attempts; ?>/<?php echo MAX_VERIFICATION_ATTEMPTS; ?>
                    </div>
                <?php endif; ?>
                
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary" <?php echo $time_left <= 0 ? 'disabled' : ''; ?>>
                        Verify Account
                    </button>
                    <a href="index.php?page=register" class="btn btn-outline-secondary">Back to Registration</a>
                </div>
            </form>
            
            <div class="text-center mt-4">
                <p class="small text-muted">Didn't receive the code? Check your spam folder or click "Resend Code"</p>
            </div>
        </div>
    </div>
</div>