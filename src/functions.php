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
    // TODO: Implement this function
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
