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
