<?php
require_once 'functions.php';

$email = "test@example.com";
$code = generateVerificationCode();
sendVerificationEmail($email, $code);

echo "✅ Check src/email_log.txt";
