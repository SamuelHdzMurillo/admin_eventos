# Administración de Usuarios - Asignación a Eventos

## Descripción

Este documento describe las funcionalidades agregadas al `AdminController` para la gestión de usuarios y su asignación a eventos específicos.

## Funcionalidades Agregadas

### 1. Crear Usuario con Evento Asignado

**Endpoint:** `POST /api/admin/users`

**Body:**
```json
{
    "name": "Nombre del Usuario",
    "email": "usuario@ejemplo.com",
    "password": "contraseña123",
    "role": "usuario",
    "evento_id": 1
}
```

**Validaciones:**
- `name`: Requerido, string, máximo 255 caracteres
- `email`: Requerido, email válido, único en la tabla users
- `password`: Requerido, mínimo 8 caracteres
- `role`: Requerido, debe ser 'admin' o 'usuario'
- `evento_id`: Opcional, debe existir en la tabla eventos

### 2. Actualizar Usuario con Evento

**Endpoint:** `PUT /api/admin/users/{user}`

**Body:**
```json
{
    "evento_id": 2
}
```

**Validaciones:**
- `evento_id`: Opcional, debe existir en la tabla eventos

### 3. Asignar Usuario a Evento

**Endpoint:** `PUT /api/admin/users/{user}/assign-event`

**Body:**
```json
{
    "evento_id": 1
}
```

**Validaciones:**
- `evento_id`: Requerido, debe existir en la tabla eventos

**Respuesta:**
```json
{
    "success": true,
    "message": "Usuario asignado al evento exitosamente",
    "data": {
        "id": 1,
        "name": "Nombre del Usuario",
        "email": "usuario@ejemplo.com",
        "role": "usuario",
        "evento_id": 1,
        "evento": {
            "id": 1,
            "nombre_evento": "Nombre del Evento",
            "inicio_evento": "2024-01-01T00:00:00.000000Z",
            "fin_evento": "2024-01-02T00:00:00.000000Z",
            "sede_evento": "Sede del Evento",
            "lim_de_participantes_evento": 100,
            "estatus_evento": "activo"
        }
    }
}
```

### 4. Remover Usuario de Evento

**Endpoint:** `PUT /api/admin/users/{user}/remove-event`

**Body:** No requiere body

**Respuesta:**
```json
{
    "success": true,
    "message": "Usuario removido del evento exitosamente",
    "data": {
        "id": 1,
        "name": "Nombre del Usuario",
        "email": "usuario@ejemplo.com",
        "role": "usuario",
        "evento_id": null
    }
}
```

## Estructura de Base de Datos

### Tabla `users`
- `id` - ID único del usuario
- `name` - Nombre del usuario
- `email` - Email del usuario (único)
- `password` - Contraseña hasheada
- `role` - Rol del usuario ('admin' o 'usuario')
- `evento_id` - ID del evento asignado (nullable, foreign key)

### Relaciones
- Un usuario puede estar asignado a un solo evento
- Un evento puede tener múltiples usuarios
- Si se elimina un evento, el `evento_id` del usuario se establece como `null`

## Ejemplos de Uso

### Crear un usuario y asignarlo a un evento
```bash
curl -X POST http://localhost:8000/api/admin/users \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer {token}" \
  -d '{
    "name": "Juan Pérez",
    "email": "juan@ejemplo.com",
    "password": "password123",
    "role": "usuario",
    "evento_id": 1
  }'
```

### Asignar un usuario existente a un evento
```bash
curl -X PUT http://localhost:8000/api/admin/users/1/assign-event \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer {token}" \
  -d '{
    "evento_id": 2
  }'
```

### Remover un usuario de un evento
```bash
curl -X PUT http://localhost:8000/api/admin/users/1/remove-event \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer {token}"
```

## Notas Importantes

1. **Autenticación**: Todas las rutas requieren autenticación con token Bearer
2. **Autorización**: Solo usuarios con rol 'admin' pueden acceder a estas funcionalidades
3. **Validación**: El `evento_id` debe existir en la tabla `eventos`
4. **Integridad**: Si se elimina un evento, los usuarios asignados mantienen su `evento_id` como `null`
5. **Relaciones**: Los usuarios se cargan automáticamente con su evento asociado cuando se asigna

## Migraciones

La funcionalidad utiliza la migración existente:
- `2024_01_01_000008_add_evento_id_to_users_table.php`

Esta migración agrega el campo `evento_id` a la tabla `users` con las siguientes características:
- Nullable (permite usuarios sin evento asignado)
- Foreign key a la tabla `eventos`
- Se establece como `null` si se elimina el evento referenciado
