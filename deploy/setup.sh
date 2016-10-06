#!/bin/bash
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[0;33m'
NC='\033[0m' # No Color

SYMFONYPATH='/var/www/SymfonyZero'
BRANCH='master'


# Apache
if ! type apache2 > /dev/null 2>&1; then
        sudo printf "${GREEN}Installing apache2:${NC} "
        /bin/bash -c "apt-get install -y apache2;\
                           a2enmod rewrite;\
                           service apache2 restart"
else
        /bin/bash -c "a2enmod rewrite && service apache2 reload"
fi

# PHP and Curl
if ! type php -v > /dev/null 2>&1; then
	printf "${GREEN}Installing php:${NC}\n"
	sudo apt-get update -y
    sudo add-apt-repository ppa:ondrej/php
    sudo apt-get update -y
    sudo apt-get install -y php5 php5-mcrypt libapache2-mod-php5 php5-curl php5-cli php5-mysql php5-gd php5-intl php5-xsl memcached php5-memcache curl
    # If you prefer to install php 7, comment previous line and uncomment next line
    #sudo apt-get install php7.0 php7.0-fpm php7.0-mysql -y
fi

# Git
if ! type git > /dev/null 2>&1; then
	printf "${GREEN}Installing git:${NC} "
	sudo apt-get install -y git
fi



# Check MySQL
if ! type mysql > /dev/null 2>&1; then
    printf "${GREEN}Installing MySQL:${NC} "
    sudo apt-get install -y mysql-server
fi

# Composer
if ! type composer > /dev/null 2>&1; then
    printf "${GREEN}Installing composer:${NC} "
    curl -sS https://getcomposer.org/installer | php
    sudo mv composer.phar /usr/local/bin/composer
fi

# Downloads SymfonyZero web folder
if [ ! -d "$SYMFONYPATH" ]; then
  git clone https://github.com/Emergya/SymfonyZero $SYMFONYPATH
fi
# Update repo and Symfony deploy
cd $SYMFONYPATH
printf "${GREEN}Installing vendors:${NC} "
composer install

php bin/console doctrine:database:create
php bin/console doctrine:schema:update --force
php bin/console doctrine:fixtures:load
php bin/console assetic:dump --env=prod --no-debug
php bin/console cache:clear
sudo chmod -R 777 var/cache/
sud ochmod -R 777 var/logs/



printf "${GREEN}Configuring Apache and restarting:${NC} "
# Update and enable Apache2 config
#rm /etc/apache2/sites-enabled/000-default.conf
#rm /etc/apache2/sites-available/000-default.conf 
cp $SYMFONYPATH/deploy/symfonyzero.conf /etc/apache2/sites-available/symfonyzero.conf 

ln -s /etc/apache2/sites-available/symfonyzero.conf /etc/apache2/sites-enabled
service apache2 restart

#Add entry in /etc/hosts
printf "\n127.0.0.1\tsymfonyzero\n" >> /etc/hosts







