<?php
require_once 'functions.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['unsubscribe_email'] ?? '');
    $code = trim($_POST['verification_code'] ?? '');

    //Send Code
    if (isset($_POST['submit-unsubscribe']) && !empty($email)) {
        $generatedCode = generateVerificationCode();
        storeVerificationCode($email, $generatedCode);
        $success = sendUnsubscribeConfirmationEmail($email, $generatedCode);
        $message = $success
            ? "✅ Verification code sent to <strong>$email</strong>."
            : "❌ Failed to send verification email.";
    }

    //Verify Code
    elseif (isset($_POST['submit-verification']) && !empty($email) && !empty($code)) {
        if (verifyCode($email, $code)) {
            $unsubscribed = unsubscribeEmail($email);
            $message = $unsubscribed
                ? "✅ Successfully unsubscribed <strong>$email</strong>."
                : "⚠️ Email was not subscribed.";
        } else {
            $message = "❌ Invalid verification code.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Unsubscribe from XKCD Comic</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        form {
            max-width: 600px;
        }
        .form-row {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .form-row label {
            width: 150px;
            font-weight: bold;
        }
        .form-row input {
            flex: 1;
            padding: 6px;
        }
        .form-row button {
            margin-left: 10px;
            padding: 6px 12px;
        }
        .message {
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h2>Unsubscribe from XKCD Comic</h2>

    <form method="POST">
        <div class="form-row">
            <label for="unsubscribe-email">Email:</label>
             <input type="email" name="unsubscribe_email" id="unsubscribe-email" required
            value="<?= isset($_POST['unsubscribe_email']) ? htmlspecialchars($_POST['unsubscribe_email']) : '' ?>">
            <button type="submit" id="submit-unsubscribe" name="submit-unsubscribe">Unsubscribe</button>
        </div>

        <div class="form-row">
            <label for="verification-code">Verification Code:</label>
            <input type="text" name="verification_code" id="verification-code" maxlength="6">
            <button type="submit" id="submit-verification" name="submit-verification">Verify</button>
        </div>
    </form>

    <?php if (!empty($message)): ?>
        <p class="message"><?= $message ?></p>
    <?php endif; ?>
</body>
</html>
