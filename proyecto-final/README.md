# Tienda MVC - Proyecto Final DWA

---

## Requisitos

- PHP 8.0 o superior
- MySQL o MariaDB
- Apache con `mod_rewrite` habilitado
- Extensiones: `pdo_mysql`, `fileinfo`

---

## Instalacion

1. Copiar el proyecto en `C:\xampp\htdocs\PROYECTO_FINAL_DWA`
2. Ejecutar `database.sql` en MySQL: `mysql -u root < database.sql`
3. Verificar los datos de conexion en `config/Database.php`
4. Habilitar `mod_rewrite` en Apache y `AllowOverride All`
5. Crear un usuario administrador en la tabla `usuarios` con contrasena en bcrypt
6. Acceder en `http://localhost/PROYECTO_FINAL_DWA/`

---

## Acceso administrador

- **URL:** `http://localhost/PROYECTO_FINAL_DWA/login`
- **Usuario:** `admin`
- **Contrasena:** `admin123`

---

## Rutas principales

- Catalogo: `/catalogo`
- Login: `/login`
- Procesar login: `/auth/login`
- Cerrar sesion: `/logout`
- Panel productos: `/productos`
- Nuevo producto: `/productos/create`
- Guardar producto: `/productos/store`
- Editar producto: `/productos/edit?id=X`
- Actualizar producto: `/productos/update`
- Eliminar producto: `/productos/delete`
- Bitacora: `/productos/logs`
- API REST: `/api/productos`

## Estructura


├── config/
│   ├── Autoload.php
│   └── Database.php
├── controllers/
│   ├── AuthController.php
│   ├── ProductoController.php
│   ├── PublicController.php
│   └── ApiController.php
├── models/
│   ├── ProductoModel.php
│   └── UsuarioModel.php
├── helpers/
│   ├── Security.php
│   └── Logger.php
├── views/
│   ├── auth/login.php
│   ├── layouts/header.php, footer.php
│   ├── productos/index.php, create.php, edit.php, logs.php
│   └── public/catalogo.php
├── uploads/productos/
└── logs/admin.log

