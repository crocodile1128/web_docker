#!/bin/bash

# Start apache
/etc/init.d/apache2 restart

# sleep 3
# Start our fake smtp server
python -m smtpd -n -c DebuggingServer localhost:25

tail -f /dev/null
