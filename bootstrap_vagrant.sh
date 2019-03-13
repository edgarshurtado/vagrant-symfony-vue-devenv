#!/bin/bash

CACHE_DIR=/vagrant/cache_downloads

if [ ! -d $CACHE_DIR ]
then
    mkdir $CACHE_DIR
fi

# node.js =========================
if [ -f /usr/bin/nodejs ]
then
    echo "node.js and karma already installed"
    npm install -g npm #  update npm
else
    cd ~
    curl -sL https://deb.nodesource.com/setup_11.x -o nodesource_setup.sh
    sudo bash nodesource_setup.sh
    # instalar node.js y npm
    sudo apt-get install  nodejs

    # evitar tener que usar sudo para lanzar actualizaciones de npm
    sudo chown -R $USER:$(id -gn $USER) /home/vagrant/.config

    # instalar karma-cli
    sudo npm install -g karma-cli
fi

# php ============================
if [ -L /usr/bin/php ]; then
    echo "php already installed"
else
    echo "Installing PHP..."
    cd ~
    sudo apt-get install -y python-software-properties
    sudo add-apt-repository -y ppa:ondrej/php
    sudo apt-get update -y
    sudo apt install -y php7.2 php7.0-cli php7.2-common php7.2-mbstring php7.2-intl php7.2-xml php7.2-mysql php-curl php7.2-zip
    sudo update-alternatives --set php /usr/bin/php7.2
fi

if [ -f /usr/bin/phpunit]; then
    wget -O phpunit https://phar.phpunit.de/phpunit-8.phar
    chmod +x phpunit
    sudo mv phpunit /usr/bin/
fi

if [ -f /usr/bin/composer ]; then
    echo "Composer already installed"
else
    echo "Installing Composer"
    EXPECTED_SIGNATURE="$(wget -q -O - https://composer.github.io/installer.sig)"
    sudo php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    ACTUAL_SIGNATURE="$(php -r "echo hash_file('sha384', 'composer-setup.php');")"

    if [ "$EXPECTED_SIGNATURE" != "$ACTUAL_SIGNATURE" ]; then
        >&2 echo 'ERROR: Invalid installer signature':wget
        sudo rm composer-setup.php
        exit 1
    fi

    sudo php composer-setup.php --quiet --filename=composer 
    sudo mv composer /usr/bin/
    sudo rm composer-setup.php
fi

sudo apt-get install tmux
sudo apt-get install htop