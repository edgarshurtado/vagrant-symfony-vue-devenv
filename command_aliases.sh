#!/bin/bash

db_start(){
    sudo docker start plock_mysql
}

db_stop(){
    sudo docker stop plock_mysql 
}

db_regenerate(){
    php bin/console doctrine:schema:drop --force --no-interaction
    php bin/console doctrine:schema:update --force --no-interaction
    php bin/console doctrine:fixtures:load --no-interaction
}

db_migrate(){
    php bin/console make:migration
}

db_update(){
    php bin/console doctrine:migrations:migrate --no-interaction
}

server_start(){
    php bin/console server:start 0.0.0.0:8080
}

serever_stop(){
    php bin/console server:stop
}

