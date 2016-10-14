#!/bin/bash

if ! type apt-get > /dev/null 2>&1; then
    echo "This script only runs on an apt-get package manager available system"
    exit
fi


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

# Downloads/Update SymfonyZero 
GIT_ACTION="clone https://github.com/rcarballoc/SymfonyZero $SYMFONYPATH"
COMPOSER_ACTION="install"

if [ -d "$SYMFONYPATH" ]; then
  cd $SYMFONYPATH
  GIT_ACTION="pull origin"  
  COMPOSER_ACTION="update"  
fi

# Update repo and Symfony deploy
git $GIT_ACTION

cd $SYMFONYPATH

printf "${GREEN}Install/Updating vendors:${NC} "
composer $COMPOSER_ACTION

#Create database only if we're on installing 
if [ "$COMPOSER_ACTION" = "install" ]; then
    php bin/console doctrine:database:create
else
   printf "${YELLOW}Skipping Database creation${NC} "    
fi

php bin/console doctrine:schema:update --force
php bin/console doctrine:fixtures:load
php bin/console assetic:dump --env=prod --no-debug
php bin/console cache:clear
sudo chmod -R 777 $SYMFONYPATH/var/cache/
sudo chmod -R 777 $SYMFONYPATH/var/logs/



printf "${GREEN}Configuring Apache Virtualhost and restarting:${NC} "
# Update and enable Apache2 config
cp $SYMFONYPATH/deploy/symfonyzero.conf /etc/apache2/sites-available/symfonyzero.conf 
ln -s /etc/apache2/sites-available/symfonyzero.conf /etc/apache2/sites-enabled
service apache2 restart

#Add entry in /etc/hosts
printf "\n127.0.0.1\tsymfonyzero\n" >> /etc/hosts

#EOP
printf "\n${GREEN}Install completed."
printf "\n--------------------------"
printf "\nIMPORTANT: Developer environment is default enabled so if your"
printf "\ndeployment has been in an LXC container or an external server you "
printf "\nhave to configure the proper values for Production or enable remote "
printf "\naccess to your IP in the app_dev.php file\n\${NC}".
printf "\n${GREEN}For further information, please refer to http://www.symfony.com\n\n${NC}".
