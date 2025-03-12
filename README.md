# Email Verification Registration System

A secure PHP-MySQL registration system that validates user inputs, sends verification emails, and manages account activation with a clean, user-friendly interface.

## Features

- **Registration Form:** Responsive form with fields for full name, email, password (with confirmation), and phone number, implementing client and server-side validation.
- **Email Verification:** Implementation of PHPMailer to send verification codes that expire after 30 minutes, with a verification input screen.
- **Security Features:** Account locking after 5 failed verification attempts, password strength requirements, and secure database storage.
- **User Experience:** Clean interface with clear error messages, loading indicators, and intuitive navigation between registration and verification screens.
- **Database Structure:** Tables for users (with verification status) and verification codes (with timestamps and attempt counters).

## Installation

1. Clone the repository to your web server directory:
   ```
   git clone https://github.com/yourusername/email-verification-system.git
   ```

2. Create a MySQL database named `registration_system` (or update the database name in `config/database.php`).

3. Install dependencies using Composer:
   ```
   composer install
   ```

4. Configure your email settings in `config/config.php`.

5. Access the application through your web browser.

## Configuration

Update the following configuration files according to your environment:

- `config/config.php`: Application settings, email configuration, and security parameters.
- `config/database.php`: Database connection details.

## Usage

1. Users fill out the registration form with their details.
2. The system validates the input and creates a new user account.
3. A verification code is sent to the user's email.
4. Users enter the verification code to activate their account.
5. After successful verification, users can log in to their account.

## Security Features

- Password hashing using bcrypt
- Input validation and sanitization
- Account locking after multiple failed verification attempts
- Verification code expiration
- CSRF protection

## Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Composer
- PHPMailer

## License

This project is licensed under the MIT License - see the LICENSE file for details.
