# VI WordPress Meetup Córdoba

Demo de la charla: "WordPress Rest API: Haciendo aplicaciones con WordPress"

## Instrucciones

### Backend: WordPress

Requisitos:

* Docker

Arrancar la máquina virtual con `docker-compose up -d`:

```bash
cd wordpress
docker-compose up -d
```

La web estará disponible en [http://localhost](http://localhost). En la instalación
hay que crear el usuario `demo` con contraseña `demo`. Si se cambia la url o los
datos de autenticación hay que actualizar luego la aplicación del frontend.

Después hay que activar los plugins `basic-auth` y `wp-statuses` y activar la plantilla hija `Twenty Seventeen Child`.

### Frontend: VueJS

Requisitos: node + npm + yarn

Instalar las dependencias y arrancar la aplicación:

```bash
cd wptasks
yarn install # o npm si no se usa yarn
yarn start
```
