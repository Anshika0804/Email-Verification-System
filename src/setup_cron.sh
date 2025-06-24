#!/bin/bash
DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
CRON_FILE="$DIR/cron.php"
LOG_FILE="$DIR/cron.log"

CRON_JOB="0 0 * * * php $CRON_FILE >> $LOG_FILE 2>&1"

(crontab -l 2>/dev/null | grep -F "$CRON_FILE") >/dev/null

if [ $? -eq 0 ]; then
    echo "🟡 CRON job already exists. No changes made."
else
    (crontab -l 2>/dev/null; echo "$CRON_JOB") | crontab -
    echo "✅ CRON job added successfully!"
fi
