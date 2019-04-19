#!/bin/bash

# localizacion
echo "lang variables"
echo LANG=en_US.UTF-8 >> /etc/environment
echo LANGUAGE=en_US.UTF-8 >> /etc/environment
echo LC_ALL=en_US.UTF-8 >> /etc/environment
echo LC_CTYPE=en_US.UTF-8 >> /etc/environment
export LANG=en_US.UTF-8
export LANGUAGE=en_US.UTF-8
export LC_ALL=en_US.UTF-8
export LC_CTYPE=en_US.UTF-8

# locale ES
locale-gen es_ES.UTF-8

echo "establece zona horaria Madrid"
ln -sf /usr/share/zoneinfo/Europe/Madrid /etc/localtime

apt-get install -y xauth xcal
apt-get install -y libxrender1 libxtst6 libxi6 x11-apps

echo "Actualiza el sistema"
unset UCF_FORCE_CONFFOLD
export UCF_FORCE_CONFFNEW=YES
ucf --purge /boot/grub/menu.lst
export DEBIAN_FRONTEND=noninteractive
apt-get update
apt-get -o Dpkg::Options::="--force-confnew" --force-yes -fuy dist-upgrade
apt-get -y autoremove


# Prevent Mysql to start at boot
sudo systemctl disable mysql

#docker
sudo apt-get install -y \
    apt-transport-https \
    ca-certificates \
    curl \
    gnupg2 \
    software-properties-common

curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -

sudo add-apt-repository \
   "deb [arch=amd64] https://download.docker.com/linux/ubuntu \
   $(lsb_release -cs) \
   stable"

sudo apt-get update
sudo apt-get install -y docker-ce docker-ce-cli containerd.io

sudo curl -L "https://github.com/docker/compose/releases/download/1.23.2/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose
