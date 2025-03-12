import React from "react";
import { Button } from "@/components/ui/button";
import { CheckCircle } from "lucide-react";

interface SuccessMessageProps {
  title?: string;
  message?: string;
  buttonText?: string;
  onButtonClick?: () => void;
}

const SuccessMessage: React.FC<SuccessMessageProps> = ({
  title = "Account Verified Successfully!",
  message = "Your account has been successfully verified. You can now log in to access your account.",
  buttonText = "Go to Login",
  onButtonClick = () => console.log("Navigate to login page"),
}) => {
  return (
    <div className="w-full max-w-md mx-auto p-6 bg-white rounded-lg shadow-md flex flex-col items-center text-center space-y-6">
      <div className="w-20 h-20 rounded-full bg-green-100 flex items-center justify-center">
        <CheckCircle className="w-12 h-12 text-green-600" />
      </div>

      <h2 className="text-2xl font-bold text-gray-800">{title}</h2>

      <p className="text-gray-600">{message}</p>

      <div className="pt-4 w-full">
        <Button className="w-full" onClick={onButtonClick}>
          {buttonText}
        </Button>
      </div>
    </div>
  );
};

export default SuccessMessage;
