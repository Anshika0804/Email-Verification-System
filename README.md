# 📧 Email Verification & XKCD Subscription System

A PHP-based email subscription system that allows users to register with email verification, subscribe/unsubscribe to XKCD comics, and receive daily comics via a CRON job. Built as part of an academic assignment.

---

## 🚀 Features

- ✅ User registration with email verification (6-digit OTP)
- ✅ XKCD comic subscription & unsubscription
- ✅ Email sending via PHP `mail()` function
- ✅ File-based storage (no database required)
- ✅ CRON job setup for daily XKCD email delivery
- ✅ Clean and minimal user interface

---

## 🛠️ Tech Stack

- **Language:** PHP
- **Frontend:** HTML, embedded PHP
- **Email:** PHP's `mail()` function (can be extended to SMTP)
- **Storage:** `.txt` and `.json` files
- **Automation:** CRON job using `cron.php` and `setup_cron.sh`

---

## 📂 Project Structure

Email-Verification-System/
├── .gitignore # Ignore DS_Store, log files, etc.
├── README.md # This file
├── src/
│ ├── index.php # Registration & verification form
│ ├── unsubscribe.php # Unsubscribe form
│ ├── functions.php # Core PHP logic functions
│ ├── email_log.txt # Log of sent emails
│ ├── registered_emails.txt # Stores verified email addresses
│ ├── email_verification_codes.json # Temp storage for OTP codes
│ ├── cron.php # Sends XKCD emails to all subscribers
│ ├── cron.log # Logs output from cron job
├── setup_cron.sh # Script to set up CRON job

---
## 🧪 How to Run Locally

### 1. Clone the repository
```bash
git clone https://github.com/Anshika0804/Email-Verification-System.git
cd Email-Verification-System
```

### 2. Start a PHP local server
```bash
php -S localhost:8000 -t src
```

Then open [http://localhost:8000](http://localhost:8000) in your browser.

---

### 3. (Optional) Setup CRON job for XKCD email delivery

#### Option A: Use the provided script
```bash
bash setup_cron.sh
```

#### Option B: Add manually

Open crontab:
```bash
crontab -e
```

Add this line to send XKCD comic every day at 9 AM:
```bash
0 9 * * * php /absolute/path/to/src/cron.php >> /absolute/path/to/src/cron.log 2>&1
```

> 🔁 Replace `/absolute/path/to/` with the actual full path on your system.

---

## 📝 Notes

- This project is designed for educational/demo purposes.
- No database is used — all data is stored in text and JSON files.
- Consider using [PHPMailer](https://github.com/PHPMailer/PHPMailer) or similar libraries for better email handling in production.
- Make sure `mail()` works on your local server (it may be disabled in some environments).

---

## 👩‍💻 Author

**Anshika Rai**  
[GitHub Profile](https://github.com/Anshika0804)

---

## 📄 License

This project is part of a learning assignment and is not licensed for commercial use.

---

### ✅ To Add This README (if using Git CLI)
```bash
git add README.md
git commit -m "docs: add README with setup and features"
git push origin main
```
