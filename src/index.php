<?php
require_once 'functions.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $code = trim($_POST['verification_code'] ?? '');

    //Send verification code
    if (isset($_POST['submit-email']) && !empty($email)) {
        $generatedCode = generateVerificationCode();
        storeVerificationCode($email, $generatedCode);
        $success = sendVerificationEmail($email, $generatedCode);
        $message = $success
            ? "✅ Verification code sent to <strong>$email</strong>."
            : "❌ Failed to send verification email.";
    }

    //Verify and register
    elseif (isset($_POST['submit-verification']) && !empty($email) && !empty($code)) {
        if (verifyCode($email, $code)) {
            $registered = registerEmail($email);
            $message = $registered
                ? "✅ Successfully subscribed <strong>$email</strong>."
                : "⚠️ Email is already subscribed.";
        } else {
            $message = "❌ Invalid verification code.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Subscribe to XKCD Comic</title>
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
    <h2>Subscribe to XKCD Comic</h2>

    <form method="POST">
        <div class="form-row">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required
                value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
            <button type="submit" id="submit-email" name="submit-email">Submit</button>
        </div>

        <div class="form-row">
            <label for="verification_code">Verification Code:</label>
            <input type="text" name="verification_code" id="verification_code" maxlength="6"
                value="<?= isset($_POST['verification_code']) ? htmlspecialchars($_POST['verification_code']) : '' ?>">
            <button type="submit" id="submit-verification" name="submit-verification">Verify</button>
        </div>
    </form>

    <?php if (!empty($message)): ?>
        <p class="message"><?= $message ?></p>
    <?php endif; ?>
</body>
</html>
