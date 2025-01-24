# Sistema de Alquiler de San Lorenzo

Este proyecto es un sistema de alquiler desarrollado en Laravel. A continuación, se describen los pasos necesarios para instalar y configurar el sistema en un entorno de desarrollo utilizando XAMPP.

## Requisitos

Antes de comenzar, asegúrate de tener lo siguiente instalado y configurado:

1. **XAMPP**: Con Apache y MySQL activados.
2. **PHP**: Versión 8.2.12 o superior. Asegúrate de modificar el archivo `php.ini` y habilitar la extensión de zip eliminando el `;` al inicio de la línea:
   ```ini
   ;extension=zip
   ```
   Debería quedar como:
   ```ini
   extension=zip
   ```
3. **Composer**: Instalado y configurado para gestionar las dependencias de PHP.
4. **Git**: Para clonar el repositorio del proyecto (opcional si descargas el código manualmente).

## Instalación

Sigue los pasos a continuación para instalar y ejecutar el proyecto:

### 1. Clonar el Repositorio

Abre una terminal y ejecuta el siguiente comando para clonar el repositorio del proyecto:

```bash
git clone [URL_DEL_REPOSITORIO]
```

Reemplaza `[URL_DEL_REPOSITORIO]` con la URL del repositorio de Git.

### 2. Configurar el Entorno

1. Navega al directorio del proyecto:

   ```bash
   cd nombre_del_proyecto
   ```

2. Copia el archivo de configuración de entorno:

   ```bash
   cp .env.example .env
   ```

3. Abre el archivo `.env` y configura las credenciales de la base de datos:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nombre_base_de_datos
   DB_USERNAME=nombre_usuario
   DB_PASSWORD=contraseña
   ```

   Reemplaza `nombre_base_de_datos`, `nombre_usuario` y `contraseña` con los datos correspondientes a tu entorno.

### 3. Instalar Dependencias

Ejecuta el siguiente comando para instalar las dependencias del proyecto utilizando Composer:

```bash
composer install
```

### 4. Generar la Clave de la Aplicación

Ejecuta el siguiente comando para generar la clave única de la aplicación:

```bash
php artisan key:generate
```

### 5. Crear la Base de Datos

Accede a MySQL utilizando phpMyAdmin o cualquier cliente de tu preferencia y crea una base de datos con el nombre que hayas especificado en el archivo `.env` en la variable `DB_DATABASE`.

### 6. Migrar la Base de Datos y Sembrar Datos de Prueba

1. Asegúrate de que el servicio de MySQL esté corriendo desde XAMPP.
2. Ejecuta el siguiente comando para realizar las migraciones y sembrar los datos iniciales:
   ```bash
   php artisan migrate:refresh --seed
   ```

### 7. Iniciar el Servidor de Desarrollo

Inicia el servidor de desarrollo de Laravel ejecutando:

```bash
php artisan serve
```

Esto pondrá la aplicación en marcha en `http://127.0.0.1:8000`.

## Acceso al Sistema

Una vez que hayas seguido los pasos anteriores, podrás iniciar sesión en el sistema utilizando las siguientes credenciales:

- **Usuario:** admin@gmail.com
- **Contraseña:** admin

## Herramientas Recomendadas

Puedes abrir y editar el proyecto utilizando:
- **Visual Studio Code**: Para una mejor experiencia de desarrollo.
- **Cualquier terminal o consola**: Para ejecutar los comandos necesarios.

## Notas Adicionales

- Si encuentras algún problema durante la instalación o ejecución, verifica los logs en `storage/logs/`.
- Asegúrate de que los servicios de Apache y MySQL estén activos desde el panel de XAMPP.

---

¡Listo! El sistema está configurado para ser utilizado en un entorno de desarrollo. 


