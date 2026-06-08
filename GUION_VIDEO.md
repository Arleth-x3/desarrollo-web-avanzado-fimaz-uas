# Guion Video Demostrativo — Proyecto Final DWA

**Duración sugerida:** 12-15 minutos (2-3 min por persona)
**Formato:** Pantalla dividida o alternada: cámara del expositor + pantalla del sistema/código

---

## INTRODUCCION GRUPAL (1-2 min) — Persona 1

- Presentar nombre del proyecto: "Tienda MVC"
- Materias: Desarrollo Web Avanzado + Sistemas Distribuidos
- Tecnologías: PHP 8, MySQL, PDO, POO, MVC, Bootstrap 5, API REST
- Objetivo del sistema: administración de productos con catálogo público

---

## DISTRIBUCION POR PERSONA

### PERSONA 1 — Estructura MVC, Enrutamiento y .htaccess

**Temas:**
1. **Estructura MVC del proyecto** — mostrar árbol de carpetas:
   - `config/` → Database, Autoload
   - `models/` → ProductoModel, UsuarioModel
   - `controllers/` → Auth, Producto, Public, Api
   - `views/` → auth, layouts, productos, public
   - `helpers/` → Security, Logger

2. **Rutas amigables con .htaccess**
   - Mostrar el archivo `.htaccess`
   - Explicar `RewriteRule` que manda todo a `index.php?route=X`
   - Demostrar: escribir `/productos` en el navegador → se ve limpio, sin `.php`

3. **Front Controller (index.php)**
   - Mostrar cómo `index.php` recibe la ruta y despacha al controller correspondiente
   - Solo instancia el controller necesario (optimización lazy-loading)

4. **Autoload (PSR-4-like)**
   - Mostrar `config/Autoload.php`
   - Explicar cómo `spl_autoload_register` mapea namespaces a carpetas

**Demo en vivo:**
- Navegar por diferentes rutas mostrando que todas pasan por index.php
- Mostrar que `/productos`, `/catalogo`, `/api/productos` funcionan con URLs limpias

---

### PERSONA 2 — CRUD de Productos + Validaciones + Imagen + Paginación

**Temas:**
1. **Crear producto (CREATE)**
   - Mostrar formulario `views/productos/create.php`
   - Llenar campos y crear un producto
   - Mostrar el código del método `store()` en `ProductoController.php`

2. **Validaciones implementadas**
   - `precio_venta >= precio_compra` → mostrar código y demo: intentar poner venta menor, sale error
   - `existencia >= 0` → intentar poner -5, sale error "No se permiten valores negativos"
   - **SKU duplicado** → crear producto con SKU que ya existe, sale error "El SKU ya existe en el sistema"
   - Campos obligatorios → intentar enviar vacío
   - Campos numéricos → intentar poner texto en precio

3. **Subida de imagen**
   - Mostrar `procesarImagen()` en el controller
   - Validación MIME con `finfo` (no confía en la extensión)
   - Límite 2 MB
   - Nombre único: `prod_` + timestamp + hex aleatorio
   - Se guarda en `uploads/productos/`
   - Demo: crear producto con imagen, mostrar que aparece en catálogo

4. **Paginación de productos**
   - Explicar el concepto: dividir en páginas de 10 productos
   - Mostrar `obtenerPaginados(limit, offset)` en el modelo
   - Mostrar `contarTodos()` para calcular total de páginas
   - Demo: panel admin con varios productos, navegar entre páginas
   - También en catálogo público (9 por página)

5. **Editar y eliminar**
   - Editar: formulario pre-llenado, cambiar imagen, validaciones
   - Eliminar: confirmación JS, borra producto + imagen del disco
   - Transacción atómica: si falla borrar imagen, se revierte todo

**Demo en vivo:**
- Crear producto con imagen, mostrar en catálogo
- Intentar violar cada validación
- Editar producto, cambiar imagen
- Eliminar producto
- Navegar paginación

---

### PERSONA 3 — Autenticación, Seguridad CSRF y Bitácora

**Temas:**
1. **Login de administrador**
   - Mostrar `controllers/AuthController.php` → `login()`
   - `password_verify()` con bcrypt (no se compara texto plano)
   - Sesión: `$_SESSION['admin']` con id, username, nombre_completo
   - Protección de rutas: `verificarSesion()` redirige si no hay sesión
   - Demo: intentar entrar a `/productos` sin login → redirige a login

2. **Protección CSRF**
   - Mostrar `helpers/Security.php` completo
   - `generarTokenCSRF()` → token aleatorio de 32 bytes en sesión
   - `campoCSRF()` → `<input type="hidden">` en cada formulario
   - `validarCSRF()` → compara con `hash_equals()` (timing-attack safe)
   - Demo: inspeccionar formulario, ver el campo oculto `_csrf_token`
   - Explicar por qué `hash_equals` y no `===`

3. **Bitácora (log) de acciones**
   - Mostrar `helpers/Logger.php` → `registrar(accion, detalles)`
   - Formato: `[2026-06-07 12:30:15] [admin] CREAR | SKU: P001`
   - `FILE_APPEND | LOCK_EX` para evitar corrupción concurrente
   - Mostrar `views/productos/logs.php` → tabla con badges de colores
   - Acciones registradas: LOGIN, LOGIN_FALLIDO, LOGOUT, CREAR, ACTUALIZAR, ELIMINAR
   - Demo: hacer login, crear producto, editar, eliminar → mostrar bitácora actualizada

**Demo en vivo:**
- Login exitoso y fallido
- Mostrar token CSRF en el HTML
- Realizar varias acciones y mostrar la bitácora reflejándolas

---

### PERSONA 4 — API REST y Catálogo Público

**Temas:**
1. **Catálogo público**
   - Mostrar `controllers/PublicController.php` → `catalogo()`
   - Búsqueda por nombre/descripción
   - Paginación de 9 productos
   - Vista `views/public/catalogo.php` → cards con Bootstrap
   - Demo: buscar producto, navegar páginas

2. **API REST**
   - Mostrar `controllers/ApiController.php` → `productos()`
   - Endpoint: `GET /api/productos`
   - Respuesta JSON: `{ success: true, data: [...], total: N }`
   - CORS: `Access-Control-Allow-Origin: *`
   - Manejo de preflight OPTIONS
   - Demo: abrir `/api/productos` en navegador → JSON formateado
   - Demo con Postman o curl si tienen

3. **Documentación con Mintlify**
   - Mostrar ejemplos de PHPDoc en el código:
     - `helpers/Security.php` → docblocks de cada método
     - `models/ProductoModel.php` → `@param`, `@return`
     - `controllers/ProductoController.php` → docblock de clase
   - Explicar que cada clase y método tiene su documentación
   - Todo en español, estilo limpio y profesional

**Demo en vivo:**
- Navegar catálogo público, buscar, paginar
- Llamar endpoint API, mostrar JSON
- Mostrar docblocks en el código fuente

---

### PERSONA 5 — Mejoras visuales, Base de datos y Cierre

**Temas:**
1. **Footer visual mejorado**
   - Mostrar `views/layouts/footer.php`
   - 4 columnas: Tienda MVC, Proyecto Final, Integrantes, Info Académica
   - Diseño con paleta de colores azul (custom properties CSS)
   - Iconos Font Awesome
   - Responsive con Bootstrap

2. **Base de datos**
   - Mostrar `database.sql`
   - Tablas: `usuarios` y `productos`
   - `usuarios`: id, username (UNIQUE), password (bcrypt), nombre_completo
   - `productos`: id, sku (UNIQUE), nombre, descripcion, precios, existencia, imagen
   - Motor InnoDB (soporta transacciones)
   - Charset utf8mb4_unicode_ci

3. **Arquitectura general**
   - Diagrama de flujo: Request → .htaccess → index.php → Controller → Model → View
   - Namespaces: `Config\`, `Models\`, `Controllers\`, `Helpers\`
   - PDO con prepared statements (anti SQL injection)
   - Transacciones en operaciones críticas

**Demo en vivo:**
- Scroll por el footer, mostrar diseño responsive
- Mostrar phpMyAdmin o similar con las tablas

---

## CIERRE GRUPAL (1 min) — Todos

- Resumen de lo aprendido: MVC, POO, PDO, seguridad, API REST
- Agradecimientos
- Preguntas del profesor

---

## ORDEN SUGERIDO DEL VIDEO

1. Persona 1 — Introducción grupal + Estructura MVC, Rutas, Autoload (3 min)
2. Persona 2 — CRUD, Validaciones, Imagen, Paginación (3 min)
3. Persona 3 — Login, CSRF, Bitácora (3 min)
4. Persona 4 — API REST, Catálogo, Documentación (2 min)
5. Persona 5 — Footer visual, Base de datos, Arquitectura, Cierre (3 min)
