# Vagrant-Symfony-Vue-devenv

Entorno de desarrollo preparado para poder trabajar con los frameworks `Symfony` y `Vue` desde una máquina virtual manejada por `Vagrant`.

La idea de este repositorio es que sirva de base para el desarrollo de aplicaciones web.

## Instalación aplicación

```bash
composer install
npm run install
```

## Inicializar servidor dev Vue

Es necesario tener instalado Vagrant y VirtualBox

```bash
vagrant up
vagrant ssh
cd plock/webpage
npm run remote-dev
```

La carpeta de la aplicación está compartida entre la máquina virtual y el ordenador huésped. Por lo que
el código se puede editar desde tu OS nativo y la máquina Vagrant se encargará de hacer la build
y refrescar el navegador automáticamente.

## Inicializar servidor Symfony 

```bash
php backend/bin/console server:run
```

Si queremos cambiar el puerto por el que está escuchando (ej: 8080), en lugar del comando anterior, ejecutar:

```bash
php backend/bin/console server:start 0.0.0.0:8080
```
> el 0.0.0.0 es para poder acceder desde el host (Vagrant en este caso)

## Base de datos

Para levantar la base de datos, dentro de la carpeta `docker`, ejecutar:

```bash
sudo docker-compose up
```

## Migraciones bases de datos
Crear una nueva migración (Se guardan en src/Migrations)
```bash
php bin/console make:migration
```

Ejecutar migraciones pendientes
```bash
php bin/console doctrine:migrations:migrate
```

## Tests

### php
```bash
php bin/phpunit tests
```

## Aliases
Para mayor comodidad en el desarrollo, en el archivo `command_aliases` hay alias para las tareas descritas anteriormente
