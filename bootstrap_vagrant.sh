#!/bin/bash

CACHE_DIR=/vagrant/cache_downloads

if [ ! -d $CACHE_DIR ]
then
    mkdir $CACHE_DIR
fi

# node.js =========================
if [ -f usr/bin/nodejs ]
then
    echo "node.js y karma ya instalados"
else
    cd ~
    curl -sL https://deb.nodesource.com/setup_11.x -o nodesource_setup.sh
    sudo bash nodesource_setup.sh
    # instalar node.js y npm
    sudo apt-get install  nodejs
    # instalar karma-cli
    sudo npm install -g karma-cli
fi