#!/usr/bin/env bash

PROJECT_NAME="identity-and-access"

# Install hollodotme/readis
if [ ! -d /var/www/readis ]; then
	git clone https://github.com/hollodotme/readis.git /var/www/readis
	cp /var/www/readis/config/app.sample.php /var/www/readis/config/app.php
	cp /var/www/readis/config/servers.sample.php /var/www/readis/config/servers.php
	composer self-update
	cd /var/www/readis
	composer update -o -v
fi

# link the uploaded nginx config to enable
echo -e "\e[0m--"
rm -rf /etc/nginx/sites-enabled/*
for name in dist pma readis; do
    # link
    ln -sf "/etc/nginx/sites-available/$name" "/etc/nginx/sites-enabled/020-$name"
    # check link
    test -L "/etc/nginx/sites-enabled/020-$name" && echo -e "\e[0mLinking nginx $name config: \e[1;32mOK\e[0m" || echo -e "Linking nginx $name config: \e[1;31mFAILED\e[0m";
done

# set correct permissions for private key
chmod 0700 /root/.ssh
chmod 0600 /root/.ssh/id_rsa
chmod 0600 /root/.ssh/config

# Set initial revision to redis DB 1
echo "SET IDA:revision 0000" | redis-cli -n 0

# restart nginx
echo -e "\e[0m--"
service nginx restart

# restart php5-fpm
service php7.0-fpm restart

# Determine the public ip address and show a message
IP_ADDR=`ifconfig eth1 | grep inet | grep -v inet6 | awk '{print $2}' | cut -c 6-`

echo -e "\e[0m--\nAdd to your /etc/hosts: \e[1;31m$IP_ADDR\twww.$PROJECT_NAME.de pma.$PROJECT_NAME.de readis.$PROJECT_NAME.de\e[0m\n--\n"


