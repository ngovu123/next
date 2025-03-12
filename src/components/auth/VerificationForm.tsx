import React, { useState, useEffect } from "react";
import { Input } from "../ui/input";
import { Button } from "../ui/button";
import { useToast } from "../ui/use-toast";
import { Clock, RefreshCw } from "lucide-react";

interface VerificationFormProps {
  email?: string;
  onVerificationSuccess?: () => void;
  onMaxAttemptsReached?: () => void;
  onResendCode?: () => void;
}

const VerificationForm = ({
  email = "user@example.com",
  onVerificationSuccess = () => {},
  onMaxAttemptsReached = () => {},
  onResendCode = () => {},
}: VerificationFormProps) => {
  const [verificationCode, setVerificationCode] = useState<string>("");
  const [attempts, setAttempts] = useState<number>(0);
  const [timeLeft, setTimeLeft] = useState<number>(30 * 60); // 30 minutes in seconds
  const [isSubmitting, setIsSubmitting] = useState<boolean>(false);
  const { toast } = useToast();

  // Timer countdown effect
  useEffect(() => {
    if (timeLeft <= 0) return;

    const timer = setInterval(() => {
      setTimeLeft((prevTime) => prevTime - 1);
    }, 1000);

    return () => clearInterval(timer);
  }, [timeLeft]);

  // Format time as MM:SS
  const formatTime = (seconds: number): string => {
    const mins = Math.floor(seconds / 60);
    const secs = seconds % 60;
    return `${mins.toString().padStart(2, "0")}:${secs.toString().padStart(2, "0")}`;
  };

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    setIsSubmitting(true);

    // Simulate verification process
    setTimeout(() => {
      // Mock verification - in a real app, this would be an API call
      const isCodeValid = verificationCode === "123456"; // Mock valid code

      if (isCodeValid) {
        toast({
          title: "Verification successful",
          description: "Your account has been verified successfully.",
        });
        onVerificationSuccess();
      } else {
        const newAttempts = attempts + 1;
        setAttempts(newAttempts);

        if (newAttempts >= 5) {
          toast({
            variant: "destructive",
            title: "Account locked",
            description:
              "Too many failed attempts. Your account has been locked.",
          });
          onMaxAttemptsReached();
        } else {
          toast({
            variant: "destructive",
            title: "Invalid code",
            description: `Verification failed. ${5 - newAttempts} attempts remaining.`,
          });
          setVerificationCode("");
        }
      }

      setIsSubmitting(false);
    }, 1000);
  };

  const handleResendCode = () => {
    setTimeLeft(30 * 60); // Reset timer to 30 minutes
    setVerificationCode("");

    toast({
      title: "Code resent",
      description: `A new verification code has been sent to ${email}.`,
    });

    onResendCode();
  };

  const isCodeExpired = timeLeft <= 0;

  return (
    <div className="w-full max-w-md p-6 bg-white rounded-lg shadow-md border border-gray-200">
      <div className="text-center mb-6">
        <h2 className="text-2xl font-bold text-gray-800">Verify Your Email</h2>
        <p className="text-gray-600 mt-2">
          We've sent a verification code to{" "}
          <span className="font-medium">{email}</span>
        </p>
      </div>

      <form onSubmit={handleSubmit} className="space-y-4">
        <div>
          <label
            htmlFor="verification-code"
            className="block text-sm font-medium text-gray-700 mb-1"
          >
            Verification Code
          </label>
          <Input
            id="verification-code"
            type="text"
            placeholder="Enter 6-digit code"
            value={verificationCode}
            onChange={(e) => setVerificationCode(e.target.value)}
            className="w-full"
            maxLength={6}
            disabled={isSubmitting || isCodeExpired}
          />
        </div>

        <div className="flex items-center justify-between text-sm">
          <div className="flex items-center text-amber-600">
            <Clock className="h-4 w-4 mr-1" />
            <span>
              {isCodeExpired
                ? "Code expired"
                : `Expires in ${formatTime(timeLeft)}`}
            </span>
          </div>
          <button
            type="button"
            onClick={handleResendCode}
            className="text-blue-600 hover:text-blue-800 font-medium"
          >
            Resend Code
          </button>
        </div>

        {attempts > 0 && (
          <div className="text-sm text-red-600">
            {`Failed attempts: ${attempts}/5`}
          </div>
        )}

        <Button
          type="submit"
          className="w-full"
          disabled={
            verificationCode.length !== 6 || isSubmitting || isCodeExpired
          }
        >
          {isSubmitting ? (
            <>
              <RefreshCw className="mr-2 h-4 w-4 animate-spin" />
              Verifying...
            </>
          ) : (
            "Verify Account"
          )}
        </Button>
      </form>

      <div className="mt-4 text-center text-sm text-gray-500">
        <p>
          Didn't receive the code? Check your spam folder or click "Resend Code"
        </p>
      </div>
    </div>
  );
};

export default VerificationForm;
