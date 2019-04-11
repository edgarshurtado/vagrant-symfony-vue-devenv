#!/bin/bash

start_db(){
    sudo docker start plock_mysql
}

stop_db(){
    sudo docker stop plock_mysql 
}

run_server(){
    php bin/console server:start 0.0.0.0:8080
}

stop_server(){
    php bin/console server:stop
}

regenerate_db(){
    php bin/console doctrine:schema:drop --force --no-interaction
    php bin/console doctrine:schema:update --force --no-interaction
    php bin/console doctrine:fixtures:load --no-interaction
}

migrate_db(){
    php bin/console make:migration
}

update_db(){
    php bin/console doctrine:migrations:migrate --no-interaction
}