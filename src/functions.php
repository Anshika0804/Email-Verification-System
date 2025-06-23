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
    // TODO: Implement this function
}

/**
 * Unsubscribe an email by removing it from the list.
 */
function unsubscribeEmail(string $email): bool {
  $file = __DIR__ . '/registered_emails.txt';
    // TODO: Implement this function
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
