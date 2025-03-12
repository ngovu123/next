// Main JavaScript file for the registration system

document.addEventListener("DOMContentLoaded", function () {
  // Password visibility toggle
  const passwordToggles = document.querySelectorAll(".password-toggle");

  passwordToggles.forEach((toggle) => {
    toggle.addEventListener("click", function () {
      const input = this.previousElementSibling;
      const icon = this.querySelector("i");

      if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
      } else {
        input.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
      }
    });
  });

  // Verification code input handling
  const verificationInputs = document.querySelectorAll(".verification-input");

  verificationInputs.forEach((input, index) => {
    // Auto-focus next input when a digit is entered
    input.addEventListener("input", function () {
      if (this.value.length === 1) {
        if (index < verificationInputs.length - 1) {
          verificationInputs[index + 1].focus();
        }
      }
    });

    // Handle backspace to go to previous input
    input.addEventListener("keydown", function (e) {
      if (e.key === "Backspace" && this.value.length === 0 && index > 0) {
        verificationInputs[index - 1].focus();
      }
    });
  });

  // Timer for verification code expiration
  const timerElement = document.getElementById("verification-timer");

  if (timerElement) {
    const expiryTime = parseInt(timerElement.getAttribute("data-expiry-time"));
    let timeLeft = expiryTime;

    const timerInterval = setInterval(function () {
      if (timeLeft <= 0) {
        clearInterval(timerInterval);
        timerElement.textContent = "Code expired";
        timerElement.classList.add("text-danger");

        // Disable verification inputs and submit button
        verificationInputs.forEach((input) => {
          input.disabled = true;
        });

        const submitButton = document.querySelector(
          '#verification-form button[type="submit"]',
        );
        if (submitButton) {
          submitButton.disabled = true;
        }

        return;
      }

      const minutes = Math.floor(timeLeft / 60);
      const seconds = timeLeft % 60;

      timerElement.textContent = `${minutes.toString().padStart(2, "0")}:${seconds.toString().padStart(2, "0")}`;
      timeLeft--;
    }, 1000);
  }

  // Form validation
  const registrationForm = document.getElementById("registration-form");

  if (registrationForm) {
    registrationForm.addEventListener("submit", function (e) {
      let isValid = true;

      // Validate full name
      const fullName = document.getElementById("full_name");
      if (fullName.value.trim().length < 2) {
        showError(fullName, "Full name must be at least 2 characters");
        isValid = false;
      } else {
        clearError(fullName);
      }

      // Validate email
      const email = document.getElementById("email");
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(email.value.trim())) {
        showError(email, "Please enter a valid email address");
        isValid = false;
      } else {
        clearError(email);
      }

      // Validate password
      const password = document.getElementById("password");
      const passwordRegex =
        /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
      if (!passwordRegex.test(password.value)) {
        showError(
          password,
          "Password must be at least 8 characters with uppercase, lowercase, number and special character",
        );
        isValid = false;
      } else {
        clearError(password);
      }

      // Validate confirm password
      const confirmPassword = document.getElementById("confirm_password");
      if (confirmPassword.value !== password.value) {
        showError(confirmPassword, "Passwords do not match");
        isValid = false;
      } else {
        clearError(confirmPassword);
      }

      // Validate phone number
      const phoneNumber = document.getElementById("phone_number");
      const phoneRegex = /^\+?[0-9]{10,15}$/;
      if (!phoneRegex.test(phoneNumber.value.trim())) {
        showError(phoneNumber, "Please enter a valid phone number");
        isValid = false;
      } else {
        clearError(phoneNumber);
      }

      if (!isValid) {
        e.preventDefault();
      }
    });
  }

  // Helper functions for form validation
  function showError(input, message) {
    const formGroup = input.closest(".mb-3");
    const errorElement =
      formGroup.querySelector(".invalid-feedback") ||
      document.createElement("div");

    if (!formGroup.querySelector(".invalid-feedback")) {
      errorElement.className = "invalid-feedback";
      formGroup.appendChild(errorElement);
    }

    errorElement.textContent = message;
    input.classList.add("is-invalid");
  }

  function clearError(input) {
    input.classList.remove("is-invalid");
    input.classList.add("is-valid");
  }
});
