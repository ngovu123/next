import React from "react";
import { Lock, AlertTriangle, Mail } from "lucide-react";
import { Button } from "../ui/button";
import { Alert, AlertTitle, AlertDescription } from "../ui/alert";

interface AccountLockedMessageProps {
  email?: string;
  onContactSupport?: () => void;
  onTryAgainLater?: () => void;
}

const AccountLockedMessage: React.FC<AccountLockedMessageProps> = ({
  email = "user@example.com",
  onContactSupport = () => console.log("Contact support clicked"),
  onTryAgainLater = () => console.log("Try again later clicked"),
}) => {
  return (
    <div className="w-[450px] h-[300px] p-6 bg-white rounded-lg shadow-md flex flex-col items-center justify-center space-y-6">
      <div className="flex items-center justify-center w-16 h-16 bg-red-100 rounded-full">
        <Lock className="w-8 h-8 text-red-600" />
      </div>

      <h2 className="text-2xl font-bold text-center text-gray-800">
        Account Locked
      </h2>

      <Alert variant="destructive" className="border-red-200 bg-red-50">
        <AlertTriangle className="h-4 w-4" />
        <AlertTitle>Verification Failed</AlertTitle>
        <AlertDescription>
          Your account has been temporarily locked due to multiple failed
          verification attempts.
        </AlertDescription>
      </Alert>

      <div className="text-center text-gray-600">
        <p className="mb-2">
          We've detected multiple unsuccessful verification attempts for:
        </p>
        <p className="font-medium flex items-center justify-center gap-1">
          <Mail className="w-4 h-4" /> {email}
        </p>
      </div>

      <div className="flex flex-col sm:flex-row gap-3 w-full">
        <Button variant="outline" className="w-full" onClick={onTryAgainLater}>
          Try Again Later
        </Button>
        <Button className="w-full" onClick={onContactSupport}>
          Contact Support
        </Button>
      </div>
    </div>
  );
};

export default AccountLockedMessage;
