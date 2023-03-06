## Requisitos
* PHP >= 7.3.0

## Instalación

Pasos para instalar el proyecto por primera vez:
 1. Clonar el proyecto
 2. Copiar el archivo .env.example a .env y configurar mínimamente los parámetros: 
- 2.1 Acceso a la Base de Datos MySQL
 3. `composer install`
 4. `php artisan key:generate`
 4. `php artisan config:cache`
 5. `php artisan migrate --seed`
 6. `php artisan passport:keys`
 7. `php artisan storage:link`

 ## Postman
Importar colección y probar endpoints. 