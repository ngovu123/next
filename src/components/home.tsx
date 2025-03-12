import React, { useState } from "react";
import { motion } from "framer-motion";
import RegistrationForm from "./auth/RegistrationForm";
import VerificationForm from "./auth/VerificationForm";
import SuccessMessage from "./auth/SuccessMessage";
import AccountLockedMessage from "./auth/AccountLockedMessage";
import AuthContainer from "./auth/AuthContainer";

// Define AuthStep type locally instead of importing it
type AuthStep = "registration" | "verification" | "success" | "locked";

const Home = () => {
  const [currentStep, setCurrentStep] = useState<AuthStep>("registration");
  const [userEmail, setUserEmail] = useState<string>("");

  // Handle form submission from registration form
  const handleRegistrationSubmit = (values: any) => {
    setUserEmail(values.email);
    setCurrentStep("verification");
  };

  // Handle verification success
  const handleVerificationSuccess = () => {
    setCurrentStep("success");
  };

  // Handle max verification attempts reached
  const handleMaxAttemptsReached = () => {
    setCurrentStep("locked");
  };

  // Handle resend verification code
  const handleResendCode = () => {
    console.log("Resending verification code to:", userEmail);
    // In a real app, this would trigger an API call to resend the code
  };

  // Render the appropriate component based on the current step
  const renderAuthComponent = () => {
    switch (currentStep) {
      case "registration":
        return (
          <RegistrationForm
            onSubmit={handleRegistrationSubmit}
            isLoading={false}
          />
        );
      case "verification":
        return (
          <VerificationForm
            email={userEmail}
            onVerificationSuccess={handleVerificationSuccess}
            onMaxAttemptsReached={handleMaxAttemptsReached}
            onResendCode={handleResendCode}
          />
        );
      case "success":
        return (
          <SuccessMessage
            onButtonClick={() => console.log("Navigate to login page")}
          />
        );
      case "locked":
        return (
          <AccountLockedMessage
            email={userEmail}
            onContactSupport={() => console.log("Contact support clicked")}
            onTryAgainLater={() => setCurrentStep("registration")}
          />
        );
      default:
        return <RegistrationForm />;
    }
  };

  return (
    <div className="min-h-screen bg-gradient-to-b from-blue-50 to-white flex flex-col">
      {/* Header */}
      <header className="w-full py-6 px-4 bg-white shadow-sm">
        <div className="container mx-auto flex justify-between items-center">
          <h1 className="text-2xl font-bold text-primary">
            Account Registration
          </h1>
          <nav>
            <ul className="flex space-x-6">
              <li>
                <a href="#" className="text-gray-600 hover:text-primary">
                  Home
                </a>
              </li>
              <li>
                <a href="#" className="text-gray-600 hover:text-primary">
                  About
                </a>
              </li>
              <li>
                <a href="#" className="text-gray-600 hover:text-primary">
                  Contact
                </a>
              </li>
              <li>
                <a href="#" className="text-primary font-medium">
                  Sign In
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </header>

      {/* Main Content */}
      <main className="flex-1 container mx-auto px-4 py-12">
        <div className="flex flex-col lg:flex-row gap-12 items-center justify-center">
          {/* Left side - Information */}
          <motion.div
            initial={{ opacity: 0, x: -20 }}
            animate={{ opacity: 1, x: 0 }}
            transition={{ duration: 0.5 }}
            className="lg:w-1/2 max-w-lg"
          >
            <h2 className="text-3xl font-bold text-gray-800 mb-6">
              Join Our Community Today
            </h2>
            <p className="text-lg text-gray-600 mb-8">
              Create an account to access exclusive features and connect with
              other members. Our secure registration process ensures your
              information is protected.
            </p>

            <div className="space-y-6">
              <div className="flex items-start space-x-4">
                <div className="bg-primary/10 p-2 rounded-full">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    className="h-6 w-6 text-primary"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      strokeLinecap="round"
                      strokeLinejoin="round"
                      strokeWidth={2}
                      d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"
                    />
                  </svg>
                </div>
                <div>
                  <h3 className="font-medium text-gray-800">
                    Secure Registration
                  </h3>
                  <p className="text-gray-600">
                    Your data is encrypted and protected with industry-standard
                    security measures.
                  </p>
                </div>
              </div>

              <div className="flex items-start space-x-4">
                <div className="bg-primary/10 p-2 rounded-full">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    className="h-6 w-6 text-primary"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      strokeLinecap="round"
                      strokeLinejoin="round"
                      strokeWidth={2}
                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                    />
                  </svg>
                </div>
                <div>
                  <h3 className="font-medium text-gray-800">
                    Email Verification
                  </h3>
                  <p className="text-gray-600">
                    We verify your email to ensure account security and prevent
                    unauthorized access.
                  </p>
                </div>
              </div>

              <div className="flex items-start space-x-4">
                <div className="bg-primary/10 p-2 rounded-full">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    className="h-6 w-6 text-primary"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      strokeLinecap="round"
                      strokeLinejoin="round"
                      strokeWidth={2}
                      d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                    />
                  </svg>
                </div>
                <div>
                  <h3 className="font-medium text-gray-800">Easy Process</h3>
                  <p className="text-gray-600">
                    Simple three-step registration: fill the form, verify your
                    email, and start using your account.
                  </p>
                </div>
              </div>
            </div>
          </motion.div>

          {/* Right side - Auth Component */}
          <motion.div
            initial={{ opacity: 0, x: 20 }}
            animate={{ opacity: 1, x: 0 }}
            transition={{ duration: 0.5, delay: 0.2 }}
            className="lg:w-1/2"
          >
            {/* Option 1: Using individual components based on state */}
            <div className="bg-white rounded-lg shadow-lg p-1">
              {renderAuthComponent()}
            </div>

            {/* Option 2: Using the AuthContainer component (commented out) */}
            {/* <AuthContainer 
              initialStep={currentStep}
              onStepChange={setCurrentStep}
              email={userEmail}
              onEmailChange={setUserEmail}
            /> */}
          </motion.div>
        </div>
      </main>

      {/* Footer */}
      <footer className="bg-gray-50 py-8 border-t border-gray-200">
        <div className="container mx-auto px-4">
          <div className="text-center text-gray-500 text-sm">
            <p>© 2023 Account Registration System. All rights reserved.</p>
            <div className="mt-2">
              <a href="#" className="text-gray-600 hover:text-primary mx-2">
                Privacy Policy
              </a>
              <a href="#" className="text-gray-600 hover:text-primary mx-2">
                Terms of Service
              </a>
              <a href="#" className="text-gray-600 hover:text-primary mx-2">
                Contact Us
              </a>
            </div>
          </div>
        </div>
      </footer>
    </div>
  );
};

export default Home;
