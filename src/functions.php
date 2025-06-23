<?php

/**
 * Generate a 6-digit numeric verification code.
 */
function generateVerificationCode(): string {
    return str_pad(strval(random_int(0, 999999)), 6, '0', STR_PAD_LEFT);
}

/**
 * Send a verification code to an email.
 */
function sendVerificationEmail(string $email, string $code): bool {
    $subject = "Your Verification Code";
    $message = "<p>Your verification code is: <strong>$code</strong></p>";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: no-reply@example.com" . "\r\n";

    return mail($email, $subject, $message, $headers);
}

/**
 * Register an email by storing it in a file.
 */
function registerEmail(string $email): bool {
    $file = __DIR__ . '/registered_emails.txt';
    $emails = file_exists($file) ? file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];

    if (in_array($email, $emails)) {
        return false;
    }

    $result = file_put_contents($file, $email . PHP_EOL, FILE_APPEND | LOCK_EX);
    return $result !== false;
}

/**
 * Unsubscribe an email by removing it from the list.
 */
function unsubscribeEmail(string $email): bool {
    $file = __DIR__ . '/registered_emails.txt';
    if (!file_exists($file)) {
          return false;
    }

    $emails = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    $filtered = array_filter($emails, fn($e) => trim($e) !== trim($email));

    if (count($filtered) === count($emails)) {
        return false;
    }

    return file_put_contents($file, implode(PHP_EOL, $filtered) . PHP_EOL, LOCK_EX) !== false;  
}

function verifyCode(string $email, string $code): bool {
    $file = __DIR__ . '/email_verification_codes.json';

    if (!file_exists($file)) {
        return false;
    }

    $data = json_decode(file_get_contents($file), true);

    if (!isset($data[$email])) {
        return false;
    }

    $isValid = $data[$email] === $code;

    // Optionally delete the code after successful verification
    if ($isValid) {
        unset($data[$email]);
        file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
    }

    return $isValid;
}

function storeVerificationCode(string $email, string $code): void {
    $file = __DIR__ . '/email_verification_codes.json';
    $data = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
    $data[$email] = $code;
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
}


/**
 * Fetch random XKCD comic and format data as HTML.
 */
function fetchAndFormatXKCDData(): string {
    // TODO: Implement this function
}

/**
 * Send the formatted XKCD updates to registered emails.
 */
function sendXKCDUpdatesToSubscribers(): void {
  $file = __DIR__ . '/registered_emails.txt';
    // TODO: Implement this function
}
