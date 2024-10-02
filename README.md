<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Sobre el Proyecto

Este proyecto es una API de bienes raíces construida con Laravel. Permite gestionar propiedades, clientes y visitas, ofreciendo una forma sencilla de realizar operaciones CRUD a través de endpoints RESTful.

## Configuración del Entorno de Desarrollo

1. **Clona el repositorio:**

   ```bash
   git clone https://github.com/Rodrigo-DG/laravel-real-estate-api.git
   cd laravel-real-estate-api
   ```

2. **Instala las dependencias de Composer:**

   ```bash
   composer install
   ```

3. **Instala las dependencias de NPM:**

   ```bash
   npm install
   ```

4. **Configura el archivo `.env`:**

   - Crea una copia del archivo de ejemplo:

   ```bash
   cp .env.example .env
   ```

   - Edita el archivo `.env` y configura tus credenciales de base de datos.

5. **Genera la clave de la aplicación:**

   ```bash
   php artisan key:generate
   ```

6. **Ejecuta las migraciones y los seeders:**

   ```bash
   php artisan migrate --seed
   ```
7. **Ejecuta el comando para almacenar en caché las rutas:**

   ```bash
   php artisan route:cache
   ```

8. **Inicia el servidor de desarrollo:**

   ```bash
   php artisan serve
   ```

9. **Inicia sesión en el sistema:**

   Usa las siguientes credenciales:

   - **Email:** demo@demo.com
   - **Password:** demo1234

## Endpoints de la API

### Propiedades

- **Obtener todas las propiedades:**  
  `GET /api/properties/index`

- **Obtener una propiedad por ID:**  
  `GET /api/properties/manage/{id}`
  Muestra el formulario para crear una nueva propiedad o editar una existente.

- **Crear una nueva propiedad:**  
  `POST /api/properties/create-property`

- **Actualizar una propiedad:**  
  `POST /api/properties/update-property/{id}`

- **Eliminar una propiedad:**  
  `DELETE /api/properties/delete-property/{id}`

### Clientes

- **Obtener todos los clientes:**  
  `GET /api/clients/index`

- **Obtener un cliente por ID:**  
  `GET /api/clients/manage/{id}`
  Muestra el formulario para crear un nuevo cliente o editar uno existente.

- **Crear un nuevo cliente:**  
  `POST /api/clients/create-client`

- **Actualizar un cliente:**  
  `POST /api/clients/update-client/{id}`

- **Eliminar un cliente:**  
  `DELETE /api/clients/delete-client/{id}`

### Visitas

- **Obtener todas las visitas:**  
  `GET /api/visits/index`

- **Obtener una visita por ID:**  
  `GET /api/visits/manage/{id}`
  Muestra el formulario para crear una nueva visita o editar una existente.

- **Crear una nueva visita:**  
  `POST /api/visits/create-visit`

- **Actualizar una visita:**  
  `POST /api/visits/update-visit/{id}`

- **Eliminar una visita:**  
  `DELETE /api/visits/delete-visit/{id}`

## Contribuciones

Si deseas contribuir al proyecto, no dudes en enviar un pull request o abrir un issue.

## Licencia

Este proyecto está licenciado bajo la [MIT License](https://opensource.org/licenses/MIT).
