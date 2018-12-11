# Instalación aplicación

```

$ git submodule update --init
$ npm run install

```

# Inicializar servidor Symfony

```
$ php backend/bin/console server:run

```

Si queremos cambiar el puerto por el que está escuchando (ej: 8080), en lugar del comando anterior, ejecutar:

```
$ php backend/bin/console server:start 0.0.0.0:8080
```
