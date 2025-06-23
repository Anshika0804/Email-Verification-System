<?php
require_once 'functions.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Phase 1: User submits email only
    if (isset($_POST['email']) && empty($_POST['verification_code'])) {
        $email = trim($_POST['email']);
        $code = generateVerificationCode();
        storeVerificationCode($email, $code);
        $success = sendVerificationEmail($email, $code);
        $message = $success ? "✅ Verification code sent to $email" : "❌ Failed to send email.";
    } elseif (isset($_POST['email']) && isset($_POST['verification_code']) && !empty($_POST['verification_code'])) {
        $email = trim($_POST['email']);
        $code = trim($_POST['verification_code']);
        if (verifyCode($email, $code)) {
            $registered = registerEmail($email);
            $message = $registered ? "✅ Email verified and registered successfully!" : "⚠️ Email is already registered.";
        } else {
            $message = "❌ Invalid verification code.";
        }
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>XKCD Email Verification</title>
</head>
<body>
    <h2>Subscribe to Daily XKCD Comic</h2>
    <form method="POST">
        <label>Email:</label><br>
        <input type="email" name="email" required>
        <button id="submit-email">Submit</button>
        <br><br>

        <label>Verification Code:</label><br>
        <input type="text" name="verification_code" maxlength="6">
        <button id="submit-verification">Verify</button>
    </form>

    <?php if ($message): ?>
        <p><strong><?= htmlspecialchars($message) ?></strong></p>
    <?php endif; ?>
</body>
</html>