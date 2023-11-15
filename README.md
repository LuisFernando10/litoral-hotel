# Hotel Litoral

Sitio Web para o Hotel Litoral que fica na orla da Atalaya em Aracajú- Sergipe, Brasil.

\## 📁 Instrucciones para ejecutar el proyecto:

- **Hacer `git clone url-repo` en la ruta: `/var/www/html/` para poder ejecutar el proyecto en local**

- **Instalar Composer y ejecutar comando `composer install` para restaurar librerías**

- **Habilitar `ALL` en `/etc/apache2/apache2.conf` la opción de `AllowOverride All` para permitir URL amigables con el `.htaccess`**

- **Tener en cuenta que en `assets/img/` falta crear la carpeta `galery` que contendrá las imágenes que se crean desde el Admin, por lo que habría que crearla si el código no lo hace, debe quedar: `assets/img/galery/.......png`**

- **Asignar permisos a algunas carpetas en caso de no dejar editar/subir archivos: `chmod -R 755 nombre_de_carpeta`**

- **Para poder ver logs: `/var/log/apache2/error.log`**
