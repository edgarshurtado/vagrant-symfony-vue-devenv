# Instalación aplicación

```

$ git submodule update --init
$ npm run install

```

# Inicializar servidor dev Vue
Es necesario tener instalado Vagrant y VirtualBox

```
vagrant up
vagrant ssh
cd plock/webpage
npm run remote-dev
```

La carpeta de la aplicación está compartida entre la máquina virtual y el ordenador huésped. Por lo que
el código se puede editar desde tu OS nativo y la máquina Vagrant se encargará sólo de hacer la build
y refrescar el navegador automáticamente.

# Inicializar servidor Symfony ( De momento esto nada)

```
$ php backend/bin/console server:run

```

Si queremos cambiar el puerto por el que está escuchando (ej: 8080), en lugar del comando anterior, ejecutar:

```
$ php backend/bin/console server:start 0.0.0.0:8080
```
