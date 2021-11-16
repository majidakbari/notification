#!/usr/bin/env bash

cd /var/www && composer install

/usr/bin/supervisord -c /etc/supervisor/supervisord.conf -n
