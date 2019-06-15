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
    sudo apt-get install -y software-properties-common
    sudo add-apt-repository -y ppa:ondrej/php
    sudo apt update -y
    sudo apt-get install -y php7.3 php7.3-common php7.3-mbstring php7.3-intl php7.3-xml php7.3-mysql php-curl php7.3-zip php7.3-sqlite3
    #sudo update-alternatives --set php /usr/bin/php7.3
fi

if [ -f /usr/bin/phpunit]; then
    echo "phpunit already installed"
else
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

    sudo apt-get install -y zip unzip
fi

# xdbug ========================
if [ -L /usr/lib/php/20180731/xdbug.so ]; then
    echo "XDebug installed"
else
    wget http://xdebug.org/files/xdebug-2.7.1.tgz
    sudo apt-get install php-dev autoconf automake -y
    tar -xvzf xdebug-2.7.1.tgz
    cd xdebug-2.7.1
    phpize
    ./configure
    make
    sudo cp modules/xdebug.so /usr/lib/php/20180731

    sudo sh -c 'echo "
    zend_extension = /usr/lib/php/20180731/xdebug.so
    [XDebug]
    xdebug.remote_enable=1
    xdebug.remote_autostart=1
    xdebug.remote_host = 10.0.2.2
    xdebug.remote_connect_back = 1
    xdebug.remote_port = 9000
    xdebug.max_nesting_level = 512" >> /etc/php/7.3/cli/php.ini'

fi

sudo apt-get install tmux
sudo apt-get install htop