#!/bin/sh
set -e
#phpinfo http://localhost:8888/phpinfo.php
cp /var/www/lizmap-web-client-3.1.12/lizmap/var/config/phpinfo.php /var/www/html/

#add specific logo to lizmap web client
cp /home/qgis_projects/00_lizmap_logo/* /var/www/lizmap-web-client-3.1.12/lizmap/var/lizmap-theme-config/

#add QGIS projects directories into Lizmap
find /home/qgis_projects/ -maxdepth 1 -mindepth 1 -type d -print0 | xargs -0 ln -s -t /var/www/lizmap-web-client-3.1.12/lizmap/install/

# Apache gets grumpy about PID files pre-existing
#rm -f /usr/local/apache2/logs/httpd.pid
#rm -f /var/run/apache2/apache2.pid

#xvfb
/usr/bin/Xvfb  :99 -screen 0 1024x768x24 -ac +extension GLX +render -noreset &

service apache2 restart

# avoid containers closing and keep it open
tail -f /dev/null
