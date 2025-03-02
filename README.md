# # Sistema de Gestión de Restaurante - El Rincón del Pato

## Requisitos del Sistema

- PHP >= 8.2
- Composer
- MySQL >= 8.0
- Node.js >= 16.x
- NPM >= 8.x

## Instalación

1. Clonar el repositorio
```bash
git clone <url-repositorio>
cd <nombre-proyecto>
```

2. Instalar dependencias
```bash
composer install
npm install
```

3. Configurar entorno
```bash
cp .env.example .env
php artisan key:generate
```

4. Configurar base de datos en 

.env


```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=restaurante_db
DB_USERNAME=root
DB_PASSWORD=
```

5. Ejecutar migraciones y seeders
```bash 
php artisan migrate --seed
```

6. Compilar assets
```bash
npm run build
```

7. Iniciar servidor
```bash
php artisan serve
```

## Módulos del Sistema

### 1. Gestión de Personal
- Roles y permisos
- Usuarios del sistema
- Empleados
- Control de accesos

### 2. Sistema de Restaurante
- Gestión de mesas
- Reservaciones 
- Configuraciones generales

### 3. Inventario
- Unidades de medida
- Items de inventario
- Proveedores
- Movimientos de stock
- Registro de suministros
- Historial de movimientos

### 4. Menú y Productos
- Categorías
- Tamaños de productos
- Gestión de menú
- Precios y variaciones

### 5. Operaciones
- Gestión de clientes
- Sistema de órdenes
- Comandas
- Pre-cuentas
- Cambios de mesa
- Proceso de pago
- Facturación

### 6. Reportes y Analytics
- Dashboard con métricas clave
- Reporte de ventas
- Estado de inventario
- Rendimiento de empleados
- Exportación de datos
- Análisis de operaciones

## Tecnologías Principales

- Laravel 11
- AdminLTE 3
- Tailwind CSS
- MySQL
- JavaScript/Node.js

## Características

- Interfaz responsiva
- Sistema de roles y permisos
- Gestión de inventario en tiempo real
- Sistema de facturación
- Reportes exportables
- API REST para integraciones

## Configuración Adicional

### AdminLTE

El sistema utiliza AdminLTE 3 para la interfaz administrativa. La configuración se encuentra en:
```php
config/adminlte.php
```

### Tailwind CSS

La configuración de Tailwind está en:
```javascript
tailwind.config.js
```

## Mantenimiento

Para mantener el sistema actualizado:

```bash
composer update
npm update
php artisan migrate
```

## Seguridad

- Autenticación robusta
- Protección CSRF
- Validación de datos
- Sanitización de entradas
- Logs de actividad

## Soporte

Para reportar problemas o sugerencias, por favor crear un issue en el repositorio.

## Licencia

Este proyecto está bajo la Licencia MIT.# Sistema de Gestión de Restaurante - El Rincón del Pato

## Requisitos del Sistema

- PHP >= 8.2
- Composer
- MySQL >= 8.0
- Node.js >= 16.x
- NPM >= 8.x

## Instalación

1. Clonar el repositorio
```bash
git clone <url-repositorio>
cd <nombre-proyecto>
```

2. Instalar dependencias
```bash
composer install
npm install
```

3. Configurar entorno
```bash
cp .env.example .env
php artisan key:generate
```

4. Configurar base de datos en 

.env


```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=restaurante_db
DB_USERNAME=root
DB_PASSWORD=
```

5. Ejecutar migraciones y seeders
```bash 
php artisan migrate --seed
```

6. Compilar assets
```bash
npm run build
```

7. Iniciar servidor
```bash
php artisan serve
```

## Módulos del Sistema

### 1. Gestión de Personal
- Roles y permisos
- Usuarios del sistema
- Empleados
- Control de accesos

### 2. Sistema de Restaurante
- Gestión de mesas
- Reservaciones 
- Configuraciones generales

### 3. Inventario
- Unidades de medida
- Items de inventario
- Proveedores
- Movimientos de stock
- Registro de suministros
- Historial de movimientos

### 4. Menú y Productos
- Categorías
- Tamaños de productos
- Gestión de menú
- Precios y variaciones

### 5. Operaciones
- Gestión de clientes
- Sistema de órdenes
- Comandas
- Pre-cuentas
- Cambios de mesa
- Proceso de pago
- Facturación

### 6. Reportes y Analytics
- Dashboard con métricas clave
- Reporte de ventas
- Estado de inventario
- Rendimiento de empleados
- Exportación de datos
- Análisis de operaciones

## Tecnologías Principales

- Laravel 11
- AdminLTE 3
- Tailwind CSS
- MySQL
- JavaScript/Node.js

## Características

- Interfaz responsiva
- Sistema de roles y permisos
- Gestión de inventario en tiempo real
- Sistema de facturación
- Reportes exportables
- API REST para integraciones

## Configuración Adicional

### AdminLTE

El sistema utiliza AdminLTE 3 para la interfaz administrativa. La configuración se encuentra en:
```php
config/adminlte.php
```

### Tailwind CSS

La configuración de Tailwind está en:
```javascript
tailwind.config.js
```

## Mantenimiento

Para mantener el sistema actualizado:

```bash
composer update
npm update
php artisan migrate
```

## Seguridad

- Autenticación robusta
- Protección CSRF
- Validación de datos
- Sanitización de entradas
- Logs de actividad

## Soporte

Para reportar problemas o sugerencias, por favor crear un issue en el repositorio.

## Licencia

Este proyecto está bajo la Licencia MIT.

Sistema web desarrollado con Laravel 11, AdminLTE y Tailwind CSS para la gestión integral de restaurantes.

## Requisitos Previos

- PHP >= 8.2
- Composer
- Node.js y NPM
- MySQL
- Git

## Instalación

1. Clonar el repositorio

## Módulos del Sistema

### 1. Gestión de Personal
- Roles y permisos
- Usuarios del sistema
- Empleados
- Control de accesos

### 2. Sistema de Restaurante
- Gestión de mesas
- Reservaciones
- Configuraciones generales

### 3. Inventario
- Unidades de medida
- Items de inventario
- Proveedores
- Movimientos de stock
- Registro de suministros
- Historial de movimientos

### 4. Menú y Productos
- Categorías
- Tamaños de productos
- Gestión de menú
- Precios y variaciones

### 5. Operaciones
- Gestión de clientes
- Sistema de órdenes
- Comandas
- Pre-cuentas
- Cambios de mesa
- Proceso de pago
- Facturación

### 6. Reportes y Analytics
- Dashboard con métricas clave
- Reporte de ventas
- Estado de inventario
- Rendimiento de empleados
- Exportación de datos
- Análisis de operaciones

## APIs y Servicios

### Consulta de Documentos
- Validación de documentos de identidad
- Consultas en tiempo real
- Verificación de datos

## Rutas y Endpoints del Sistema

### Autenticación

