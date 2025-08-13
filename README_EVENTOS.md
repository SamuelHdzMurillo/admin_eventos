# Sistema de Administración de Eventos

Este sistema permite gestionar eventos gastronómicos, equipos participantes, participantes, acompañantes, recetas y cédulas de registro.

## 🔐 **Sistema de Autenticación**

El sistema incluye autenticación completa con roles de usuario:

-   **`admin`** - Acceso completo a todas las funcionalidades
-   **`usuario`** - Acceso limitado (solo lectura)

### **Usuarios de Prueba:**

-   **Admin:** `admin@eventos.com` / `admin123`
-   **Usuario:** `usuario@eventos.com` / `usuario123`

### **Endpoints de Autenticación:**

-   `POST /api/register` - Registro de usuario
-   `POST /api/login` - Inicio de sesión
-   `POST /api/logout` - Cerrar sesión
-   `GET /api/me` - Perfil del usuario
-   `PUT /api/profile` - Actualizar perfil

**Ver documentación completa en:** [README_AUTH.md](README_AUTH.md)

## Estructura de la Base de Datos

### Tablas Principales

1. **eventos** - Información general de los eventos
2. **equipos** - Equipos participantes en los eventos
3. **participantes** - Miembros de los equipos
4. **acompanantes** - Asesores y coordinadores de los equipos
5. **recetas** - Recetas presentadas por los equipos
6. **cedulas_registro** - Cédulas de registro de los equipos

## Instalación y Configuración

### 1. Ejecutar Migraciones

```bash
php artisan migrate
```

### 2. Ejecutar Seeders

```bash
php artisan db:seed
```

## API Endpoints

### **⚠️ IMPORTANTE:** Todas las rutas requieren autenticación

### Eventos

-   `GET /api/eventos` - Listar todos los eventos
-   `POST /api/eventos` - Crear un nuevo evento (solo admin)
-   `GET /api/eventos/{id}` - Obtener un evento específico
-   `PUT /api/eventos/{id}` - Actualizar un evento (solo admin)
-   `DELETE /api/eventos/{id}` - Eliminar un evento (solo admin)

### Equipos

-   `GET /api/equipos` - Listar todos los equipos
-   `POST /api/equipos` - Crear un nuevo equipo (solo admin)
-   `GET /api/equipos/{id}` - Obtener un equipo específico
-   `PUT /api/equipos/{id}` - Actualizar un equipo (solo admin)
-   `DELETE /api/equipos/{id}` - Eliminar un equipo (solo admin)
-   `GET /api/equipos/{id}/completo` - Obtener equipo con toda la información relacionada

### Participantes

-   `GET /api/participantes` - Listar todos los participantes
-   `POST /api/participantes` - Crear un nuevo participante (solo admin)
-   `GET /api/participantes/{id}` - Obtener un participante específico
-   `PUT /api/participantes/{id}` - Actualizar un participante (solo admin)
-   `DELETE /api/participantes/{id}` - Eliminar un participante (solo admin)

### Acompañantes

-   `GET /api/acompanantes` - Listar todos los acompañantes
-   `POST /api/acompanantes` - Crear un nuevo acompañante (solo admin)
-   `GET /api/acompanantes/{id}` - Obtener un acompañante específico
-   `PUT /api/acompanantes/{id}` - Actualizar un acompañante (solo admin)
-   `DELETE /api/acompanantes/{id}` - Eliminar un acompañante (solo admin)

### Recetas

-   `GET /api/recetas` - Listar todas las recetas
-   `POST /api/recetas` - Crear una nueva receta (solo admin)
-   `GET /api/recetas/{id}` - Obtener una receta específica
-   `PUT /api/recetas/{id}` - Actualizar una receta (solo admin)
-   `DELETE /api/recetas/{id}` - Eliminar una receta (solo admin)

### Cédulas de Registro

-   `GET /api/cedulas-registro` - Listar todas las cédulas
-   `POST /api/cedulas-registro` - Crear una nueva cédula (solo admin)
-   `GET /api/cedulas-registro/{id}` - Obtener una cédula específica
-   `PUT /api/cedulas-registro/{id}` - Actualizar una cédula (solo admin)
-   `DELETE /api/cedulas-registro/{id}` - Eliminar una cédula (solo admin)

## Características Principales

### Relaciones entre Entidades

-   **Evento** → **Equipos** (1:N)
-   **Equipo** → **Participantes** (1:N)
-   **Equipo** → **Acompañantes** (1:N)
-   **Equipo** → **Recetas** (1:N)
-   **Equipo** → **Cédulas de Registro** (1:N)

### Endpoint Especial: Equipo Completo

El endpoint `GET /api/equipos/{id}/completo` devuelve un equipo con toda la información relacionada:

-   Datos del equipo
-   Información del evento
-   Lista de participantes
-   Lista de acompañantes
-   Lista de recetas
-   Cédulas de registro

## Ejemplos de Uso

### **1. Autenticación (requerido para todas las operaciones)**

```bash
# Login para obtener token
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email": "admin@eventos.com", "password": "admin123"}'

# Usar el token en las siguientes peticiones
curl -H "Authorization: Bearer {TOKEN}" \
  -H "Content-Type: application/json" \
  http://localhost:8000/api/eventos
```

### **2. Crear un Evento (solo admin)**

```bash
curl -X POST http://localhost:8000/api/eventos \
  -H "Authorization: Bearer {ADMIN_TOKEN}" \
  -H "Content-Type: application/json" \
  -d '{
    "nombre_evento": "Concurso Regional de Cocina",
    "inicio_evento": "2024-09-15 09:00:00",
    "fin_evento": "2024-09-17 18:00:00",
    "sede_evento": "Auditorio Principal",
    "lim_de_participantes_evento": 100,
    "estatus_evento": "activo"
  }'
```

### **3. Crear un Equipo (solo admin)**

```bash
curl -X POST http://localhost:8000/api/equipos \
  -H "Authorization: Bearer {ADMIN_TOKEN}" \
  -H "Content-Type: application/json" \
  -d '{
    "nombre_equipo": "Los Sabores del Norte",
    "evento_id": 1,
    "entidad_federativa": "Nuevo León",
    "estatus_del_equipo": "activo",
    "nombre_anfitrion": "María González",
    "telefono_anfitrion": "8181234567",
    "correo_anfitrion": "maria.gonzalez@email.com"
  }'
```

### **4. Obtener Equipo Completo (cualquier usuario autenticado)**

```bash
curl -H "Authorization: Bearer {TOKEN}" \
  -H "Content-Type: application/json" \
  http://localhost:8000/api/equipos/1/completo
```

## Validaciones

El sistema incluye validaciones para:

-   Campos obligatorios
-   Formato de correos electrónicos
-   Existencia de IDs relacionados
-   Tipos de datos correctos
-   Estados válidos para enums
-   **Autenticación y autorización por roles**

## Respuestas de la API

Todas las respuestas siguen el formato:

```json
{
    "success": true,
    "message": "Mensaje descriptivo",
    "data": { ... }
}
```

## Notas Importantes

-   **Todas las rutas requieren autenticación** con token Bearer
-   **Solo los administradores** pueden crear/editar/eliminar entidades
-   **Los usuarios regulares** solo pueden ver información
-   Las migraciones deben ejecutarse en el orden correcto debido a las dependencias de claves foráneas
-   Los seeders incluyen datos de ejemplo para probar el sistema
-   El sistema maneja eliminación en cascada para mantener la integridad referencial
-   Las fechas se manejan en formato datetime de MySQL
