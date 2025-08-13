# Sistema de Autenticación con Roles

Este sistema implementa autenticación completa con Laravel Sanctum y roles de usuario (admin y usuario regular).

## 🚀 **Características del Sistema**

### **Roles Disponibles:**

-   **`admin`** - Acceso completo a todas las funcionalidades
-   **`usuario`** - Acceso limitado (solo lectura en la mayoría de casos)

### **Funcionalidades por Rol:**

#### **Usuarios Autenticados (cualquier rol):**

-   ✅ Ver eventos
-   ✅ Ver equipos
-   ✅ Ver participantes
-   ✅ Ver acompañantes
-   ✅ Ver recetas
-   ✅ Ver cédulas de registro
-   ✅ Gestionar su propio perfil
-   ✅ Cerrar sesión

#### **Solo Administradores:**

-   ✅ **CRUD completo** de eventos, equipos, participantes, etc.
-   ✅ **Administración de usuarios** (crear, editar, eliminar)
-   ✅ **Cambiar roles** de otros usuarios
-   ✅ **Estadísticas** del sistema
-   ✅ **Gestión completa** de todas las entidades

## 🔐 **Endpoints de Autenticación**

### **1. Registro de Usuario**

```http
POST /api/register
```

**Body:**

```json
{
    "name": "Nombre del Usuario",
    "email": "usuario@email.com",
    "password": "contraseña123",
    "password_confirmation": "contraseña123",
    "role": "usuario" // opcional, por defecto "usuario"
}
```

**Respuesta:**

```json
{
    "success": true,
    "message": "Usuario registrado exitosamente",
    "data": {
        "user": { ... },
        "token": "1|abc123...",
        "token_type": "Bearer"
    }
}
```

### **2. Inicio de Sesión**

```http
POST /api/login
```

**Body:**

```json
{
    "email": "usuario@email.com",
    "password": "contraseña123"
}
```

**Respuesta:**

```json
{
    "success": true,
    "message": "Inicio de sesión exitoso",
    "data": {
        "user": { ... },
        "token": "1|abc123...",
        "token_type": "Bearer"
    }
}
```

### **3. Cerrar Sesión**

```http
POST /api/logout
Authorization: Bearer {token}
```

### **4. Obtener Perfil del Usuario**

```http
GET /api/me
Authorization: Bearer {token}
```

### **5. Actualizar Perfil**

```http
PUT /api/profile
Authorization: Bearer {token}
```

**Body:**

```json
{
    "name": "Nuevo Nombre",
    "email": "nuevo@email.com",
    "current_password": "contraseña_actual",
    "new_password": "nueva_contraseña",
    "new_password_confirmation": "nueva_contraseña"
}
```

## 👑 **Endpoints de Administración (Solo Admin)**

### **1. Listar Todos los Usuarios**

```http
GET /api/admin/users
Authorization: Bearer {admin_token}
```

### **2. Crear Usuario**

```http
POST /api/admin/users
Authorization: Bearer {admin_token}
```

**Body:**

```json
{
    "name": "Nuevo Usuario",
    "email": "nuevo@email.com",
    "password": "contraseña123",
    "role": "usuario"
}
```

### **3. Actualizar Usuario**

```http
PUT /api/admin/users/{id}
Authorization: Bearer {admin_token}
```

### **4. Eliminar Usuario**

```http
DELETE /api/admin/users/{id}
Authorization: Bearer {admin_token}
```

### **5. Cambiar Rol de Usuario**

```http
PUT /api/admin/users/{id}/role
Authorization: Bearer {admin_token}
```

**Body:**

```json
{
    "role": "admin"
}
```

### **6. Estadísticas de Usuarios**

```http
GET /api/admin/users-stats
Authorization: Bearer {admin_token}
```

## 🔒 **Sistema de Middleware**

### **Middleware de Autenticación:**

-   `auth:sanctum` - Verifica que el usuario esté autenticado

### **Middleware de Roles:**

-   `role:admin` - Solo permite acceso a administradores
-   `role:usuario` - Solo permite acceso a usuarios regulares
-   `role:admin,usuario` - Permite acceso a ambos roles

## 📋 **Uso del Sistema**

### **1. Instalación y Configuración**

```bash
# Ejecutar migraciones
php artisan migrate

# Ejecutar seeders (incluye usuarios de ejemplo)
php artisan db:seed
```

### **2. Usuarios de Prueba Creados**

#### **Administrador:**

-   **Email:** `admin@eventos.com`
-   **Password:** `admin123`
-   **Rol:** `admin`

#### **Usuario Regular:**

-   **Email:** `usuario@eventos.com`
-   **Password:** `usuario123`
-   **Rol:** `usuario`

### **3. Flujo de Autenticación**

1. **Registro/Login** → Obtener token
2. **Incluir token** en header: `Authorization: Bearer {token}`
3. **Acceder a rutas protegidas** según el rol del usuario

## 🛡️ **Seguridad Implementada**

-   ✅ **Contraseñas hasheadas** con bcrypt
-   ✅ **Tokens seguros** con Laravel Sanctum
-   ✅ **Validación de roles** en cada endpoint
-   ✅ **Protección CSRF** en rutas web
-   ✅ **Rate limiting** en API
-   ✅ **Validación de datos** en todos los endpoints
-   ✅ **Prevención de auto-eliminación** de administradores

## 📱 **Ejemplo de Uso con JavaScript/Fetch**

```javascript
// Login
const login = async (email, password) => {
    const response = await fetch("/api/login", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ email, password }),
    });

    const data = await response.json();
    if (data.success) {
        localStorage.setItem("token", data.data.token);
        localStorage.setItem("user", JSON.stringify(data.data.user));
    }
    return data;
};

// Acceder a ruta protegida
const getEventos = async () => {
    const token = localStorage.getItem("token");
    const response = await fetch("/api/eventos", {
        headers: {
            Authorization: `Bearer ${token}`,
            "Content-Type": "application/json",
        },
    });

    return await response.json();
};

// Acceder a ruta solo para admin
const createEvento = async (eventoData) => {
    const token = localStorage.getItem("token");
    const response = await fetch("/api/eventos", {
        method: "POST",
        headers: {
            Authorization: `Bearer ${token}`,
            "Content-Type": "application/json",
        },
        body: JSON.stringify(eventoData),
    });

    return await response.json();
};
```

## ⚠️ **Notas Importantes**

-   **Los tokens expiran** según la configuración de Sanctum
-   **Solo los administradores** pueden crear/editar/eliminar entidades
-   **Los usuarios regulares** solo pueden ver información
-   **Un admin no puede eliminarse a sí mismo**
-   **Un admin no puede cambiar su propio rol**
-   **Todas las rutas de administración** requieren rol `admin`

## 🔧 **Configuración Adicional**

### **Personalizar Expiración de Tokens:**

En `config/sanctum.php`:

```php
'expiration' => 60 * 24, // 24 horas
```

### **Agregar Nuevos Roles:**

1. Modificar la migración `add_role_to_users_table`
2. Actualizar el modelo `User`
3. Agregar validaciones en los controladores
