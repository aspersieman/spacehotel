#!/usr/bin/env bash

apt-get update
apt-get upgrade
apt-get install -y apache2 php5 php-pear php5-mysql php5-suhosin php5-gd make
pecl install zendopcache-beta
rm -rf /var/www
ln -fs /vagrant /var/www
echo 
a2enmod rewrite
# /usr/lib/php5/20090626/opcache.so
apt-get install -y mysql-server mysql-client phpmyadmin
cp /vagrant/mss/vagrant/spacehotel.com.vagrant /etc/apache2/sites-available/
a2ensite spacehotel.com.vagrant
service apache2 restart
