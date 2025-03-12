<?php
// Process registration form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate input
    $errors = [];
    
    // Validate full name
    $full_name = trim($_POST['full_name'] ?? '');
    if (empty($full_name) || strlen($full_name) < 2) {
        $errors['full_name'] = 'Full name must be at least 2 characters.';
    }
    
    // Validate email
    $email = trim($_POST['email'] ?? '');
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address.';
    } else {
        // Check if email already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $errors['email'] = 'This email is already registered.';
        }
        
        $stmt->close();
    }
    
    // Validate password
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    
    if (empty($password) || strlen($password) < PASSWORD_MIN_LENGTH) {
        $errors['password'] = 'Password must be at least ' . PASSWORD_MIN_LENGTH . ' characters.';
    } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password)) {
        $errors['password'] = 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.';
    }
    
    if ($password !== $confirm_password) {
        $errors['confirm_password'] = 'Passwords do not match.';
    }
    
    // Validate phone number
    $phone_number = trim($_POST['phone_number'] ?? '');
    if (empty($phone_number) || !preg_match('/^\+?[0-9]{10,15}$/', $phone_number)) {
        $errors['phone_number'] = 'Please enter a valid phone number.';
    }
    
    // If no errors, proceed with registration
    if (empty($errors)) {
        // Hash password
        $hashed_password = password_hash($password, PASSWORD_HASH_ALGO, ['cost' => PASSWORD_HASH_COST]);
        
        // Begin transaction
        $conn->begin_transaction();
        
        try {
            // Insert user
            $stmt = $conn->prepare("INSERT INTO users (full_name, email, password, phone_number) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $full_name, $email, $hashed_password, $phone_number);
            $stmt->execute();
            $user_id = $stmt->insert_id;
            $stmt->close();
            
            // Generate verification code
            $verification_code = '';
            for ($i = 0; $i < VERIFICATION_CODE_LENGTH; $i++) {
                $verification_code .= mt_rand(0, 9);
            }
            
            // Calculate expiry time
            $expiry_time = date('Y-m-d H:i:s', time() + VERIFICATION_CODE_EXPIRY);
            
            // Insert verification code
            $stmt = $conn->prepare("INSERT INTO verification_codes (user_id, code, expires_at) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $user_id, $verification_code, $expiry_time);
            $stmt->execute();
            $stmt->close();
            
            // Commit transaction
            $conn->commit();
            
            // Send verification email (in a real app, you would use PHPMailer here)
            // For now, we'll just store the code in session for demo purposes
            $_SESSION['user_id'] = $user_id;
            $_SESSION['email'] = $email;
            $_SESSION['verification_code'] = $verification_code; // In a real app, don't store this in session
            $_SESSION['expiry_time'] = time() + VERIFICATION_CODE_EXPIRY;
            
            // Redirect to verification page
            header("Location: index.php?page=verify");
            exit;
            
        } catch (Exception $e) {
            // Rollback transaction on error
            $conn->rollback();
            $error_message = "Registration failed: " . $e->getMessage();
        }
    }
}
?>

<div class="row">
    <div class="col-lg-6">
        <div class="mb-5">
            <h2 class="h3 fw-bold mb-4">Join Our Community Today</h2>
            <p class="lead mb-4">Create an account to access exclusive features and connect with other members. Our secure registration process ensures your information is protected.</p>
            
            <div class="d-flex mb-3">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <div>
                    <h3 class="h5 fw-bold">Secure Registration</h3>
                    <p>Your data is encrypted and protected with industry-standard security measures.</p>
                </div>
            </div>
            
            <div class="d-flex mb-3">
                <div class="feature-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <div>
                    <h3 class="h5 fw-bold">Email Verification</h3>
                    <p>We verify your email to ensure account security and prevent unauthorized access.</p>
                </div>
            </div>
            
            <div class="d-flex mb-3">
                <div class="feature-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div>
                    <h3 class="h5 fw-bold">Easy Process</h3>
                    <p>Simple three-step registration: fill the form, verify your email, and start using your account.</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-6">
        <div class="auth-card p-4">
            <h2 class="h4 text-center mb-4">Create an Account</h2>
            
            <?php if (isset($error_message)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>
            
            <form id="registration-form" method="POST" action="">
                <div class="mb-3">
                    <label for="full_name" class="form-label">Full Name</label>
                    <input type="text" class="form-control <?php echo isset($errors['full_name']) ? 'is-invalid' : ''; ?>" id="full_name" name="full_name" value="<?php echo htmlspecialchars($full_name ?? ''); ?>" required>
                    <?php if (isset($errors['full_name'])): ?>
                        <div class="invalid-feedback"><?php echo $errors['full_name']; ?></div>
                    <?php endif; ?>
                </div>
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?php echo htmlspecialchars($email ?? ''); ?>" required>
                    <?php if (isset($errors['email'])): ?>
                        <div class="invalid-feedback"><?php echo $errors['email']; ?></div>
                    <?php endif; ?>
                </div>
                
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="position-relative">
                        <input type="password" class="form-control <?php echo isset($errors['password']) ? 'is-invalid' : ''; ?>" id="password" name="password" required>
                        <button type="button" class="password-toggle">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="form-text">Password must be at least 8 characters with uppercase, lowercase, number and special character.</div>
                    <?php if (isset($errors['password'])): ?>
                        <div class="invalid-feedback"><?php echo $errors['password']; ?></div>
                    <?php endif; ?>
                </div>
                
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <div class="position-relative">
                        <input type="password" class="form-control <?php echo isset($errors['confirm_password']) ? 'is-invalid' : ''; ?>" id="confirm_password" name="confirm_password" required>
                        <button type="button" class="password-toggle">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <?php if (isset($errors['confirm_password'])): ?>
                        <div class="invalid-feedback"><?php echo $errors['confirm_password']; ?></div>
                    <?php endif; ?>
                </div>
                
                <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="tel" class="form-control <?php echo isset($errors['phone_number']) ? 'is-invalid' : ''; ?>" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars($phone_number ?? ''); ?>" placeholder="+1234567890" required>
                    <?php if (isset($errors['phone_number'])): ?>
                        <div class="invalid-feedback"><?php echo $errors['phone_number']; ?></div>
                    <?php endif; ?>
                </div>
                
                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>
            
            <div class="text-center mt-3">
                <p class="small">Already have an account? <a href="#" class="text-decoration-none">Sign in</a></p>
            </div>
        </div>
    </div>
</div>