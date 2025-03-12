import React, { useState } from "react";
import {
  Card,
  CardContent,
  CardDescription,
  CardFooter,
  CardHeader,
  CardTitle,
} from "../ui/card";
import { motion } from "framer-motion";
import { Mail } from "lucide-react";

export type AuthStep = "registration" | "verification" | "success" | "locked";

interface AuthContainerProps {
  initialStep?: AuthStep;
  onStepChange?: (step: AuthStep) => void;
  email?: string;
  onEmailChange?: (email: string) => void;
}

const AuthContainer = ({
  initialStep = "registration",
  onStepChange = () => {},
  email = "",
  onEmailChange = () => {},
}: AuthContainerProps) => {
  const [currentStep, setCurrentStep] = useState<AuthStep>(initialStep);
  const [userEmail, setUserEmail] = useState<string>(email);

  const handleStepChange = (step: AuthStep) => {
    setCurrentStep(step);
    onStepChange(step);
  };

  const handleEmailChange = (newEmail: string) => {
    setUserEmail(newEmail);
    onEmailChange(newEmail);
  };

  const renderStep = () => {
    switch (currentStep) {
      case "registration":
        return (
          <div className="space-y-4 py-2">
            {/* This is a placeholder for the RegistrationForm component */}
            <div className="space-y-4">
              <div className="space-y-2">
                <div className="h-10 bg-gray-100 rounded animate-pulse"></div>
                <div className="h-10 bg-gray-100 rounded animate-pulse"></div>
                <div className="h-10 bg-gray-100 rounded animate-pulse"></div>
                <div className="h-10 bg-gray-100 rounded animate-pulse"></div>
              </div>
              <button
                className="w-full py-2 px-4 bg-primary text-white rounded-md hover:bg-primary/90 transition-colors"
                onClick={() => {
                  handleEmailChange("user@example.com");
                  handleStepChange("verification");
                }}
              >
                Register
              </button>
            </div>
          </div>
        );
      case "verification":
        return (
          <div className="space-y-4 py-2">
            {/* This is a placeholder for the VerificationForm component */}
            <div className="text-center mb-4">
              <p className="text-sm text-gray-600">
                We've sent a verification code to
              </p>
              <p className="font-medium">{userEmail}</p>
            </div>
            <div className="flex justify-center gap-2 mb-4">
              {[1, 2, 3, 4, 5, 6].map((_, i) => (
                <div
                  key={i}
                  className="w-10 h-12 border-2 rounded-md flex items-center justify-center"
                >
                  <span className="text-lg font-bold">0</span>
                </div>
              ))}
            </div>
            <div className="flex flex-col gap-2">
              <button
                className="w-full py-2 px-4 bg-primary text-white rounded-md hover:bg-primary/90 transition-colors"
                onClick={() => handleStepChange("success")}
              >
                Verify
              </button>
              <button
                className="w-full py-2 px-4 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition-colors"
                onClick={() => handleStepChange("registration")}
              >
                Back to Registration
              </button>
            </div>
          </div>
        );
      case "success":
        return (
          <div className="space-y-4 py-2 text-center">
            {/* This is a placeholder for the SuccessMessage component */}
            <div className="flex justify-center">
              <div className="h-16 w-16 rounded-full bg-green-100 flex items-center justify-center">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  className="h-8 w-8 text-green-600"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    strokeWidth={2}
                    d="M5 13l4 4L19 7"
                  />
                </svg>
              </div>
            </div>
            <h3 className="text-lg font-medium">Account Verified!</h3>
            <p className="text-sm text-gray-600">
              Your account has been successfully verified. You can now log in.
            </p>
            <button
              className="w-full py-2 px-4 bg-primary text-white rounded-md hover:bg-primary/90 transition-colors"
              onClick={() => console.log("Navigate to login page")}
            >
              Go to Login
            </button>
          </div>
        );
      case "locked":
        return (
          <div className="space-y-4 py-2 text-center">
            {/* This is a placeholder for the AccountLockedMessage component */}
            <div className="flex justify-center">
              <div className="h-16 w-16 rounded-full bg-red-100 flex items-center justify-center">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  className="h-8 w-8 text-red-600"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    strokeWidth={2}
                    d="M12 15v2m0 0v2m0-2h2m-2 0H9m3-4V8a3 3 0 00-3-3H9a3 3 0 00-3 3v1"
                  />
                  <path
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    strokeWidth={2}
                    d="M9 11h6a2 2 0 012 2v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6a2 2 0 012-2z"
                  />
                </svg>
              </div>
            </div>
            <h3 className="text-lg font-medium">Account Locked</h3>
            <p className="text-sm text-gray-600">
              Too many failed verification attempts. Please contact support for
              assistance.
            </p>
            <button
              className="w-full py-2 px-4 bg-primary text-white rounded-md hover:bg-primary/90 transition-colors"
              onClick={() => console.log("Contact support clicked")}
            >
              Contact Support
            </button>
          </div>
        );
      default:
        return (
          <div className="space-y-4 py-2">
            {/* Default fallback */}
            <div className="h-60 bg-gray-100 rounded animate-pulse"></div>
            <button
              className="w-full py-2 px-4 bg-primary text-white rounded-md hover:bg-primary/90 transition-colors"
              onClick={() => handleStepChange("verification")}
            >
              Continue
            </button>
          </div>
        );
    }
  };

  return (
    <div className="flex justify-center items-center min-h-screen w-full bg-gray-50">
      <motion.div
        initial={{ opacity: 0, y: 20 }}
        animate={{ opacity: 1, y: 0 }}
        transition={{ duration: 0.5 }}
        className="w-full max-w-md px-4"
      >
        <Card className="w-full shadow-lg border-gray-200">
          <CardHeader className="space-y-1">
            <div className="flex justify-center mb-4">
              <div className="h-12 w-12 rounded-full bg-primary/10 flex items-center justify-center">
                <Mail className="h-6 w-6 text-primary" />
              </div>
            </div>
            <CardTitle className="text-2xl font-bold text-center">
              {currentStep === "registration" && "Create an Account"}
              {currentStep === "verification" && "Verify Your Email"}
              {currentStep === "success" && "Registration Complete"}
              {currentStep === "locked" && "Account Locked"}
            </CardTitle>
            <CardDescription className="text-center">
              {currentStep === "registration" &&
                "Enter your details to create your account"}
              {currentStep === "verification" &&
                "Enter the verification code sent to your email"}
              {currentStep === "success" &&
                "Your account has been successfully verified"}
              {currentStep === "locked" &&
                "Too many failed verification attempts"}
            </CardDescription>
          </CardHeader>
          <CardContent>{renderStep()}</CardContent>
          <CardFooter className="flex flex-col space-y-2">
            <div className="text-xs text-center text-gray-500 mt-4">
              {currentStep === "registration" &&
                "By creating an account, you agree to our Terms of Service and Privacy Policy"}
              {currentStep === "verification" &&
                "Didn't receive the code? Check your spam folder"}
            </div>
          </CardFooter>
        </Card>
      </motion.div>
    </div>
  );
};

export default AuthContainer;
