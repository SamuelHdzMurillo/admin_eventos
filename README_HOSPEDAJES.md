# Sistema de Hospedajes - API Documentation

## Descripción

El sistema de hospedajes permite gestionar información de diferentes tipos de alojamiento como hoteles, resorts, hostales, etc.

## Estructura de la Base de Datos

### Tabla: `hospedajes`

-   `id` - Identificador único (auto-incremento)
-   `nombre` - Nombre del establecimiento de hospedaje
-   `direccion` - Dirección completa del establecimiento
-   `numero_telefonico` - Número de teléfono de contacto
-   `correo` - Correo electrónico de contacto
-   `img` - URL o ruta de la imagen del establecimiento (opcional)
-   `created_at` - Fecha de creación del registro
-   `updated_at` - Fecha de última actualización

## Endpoints de la API

### 1. Obtener todos los hospedajes

```
GET /api/hospedajes
```

**Respuesta:**

```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "nombre": "Hotel Plaza Central",
            "direccion": "Av. Principal 123, Centro Histórico",
            "numero_telefonico": "+52 555-123-4567",
            "correo": "reservas@plazacentral.com",
            "img": "hotel-plaza-central.jpg",
            "created_at": "2024-01-01T00:00:00.000000Z",
            "updated_at": "2024-01-01T00:00:00.000000Z"
        }
    ]
}
```

### 2. Obtener un hospedaje específico

```
GET /api/hospedajes/{id}
```

**Respuesta:**

```json
{
    "success": true,
    "data": {
        "id": 1,
        "nombre": "Hotel Plaza Central",
        "direccion": "Av. Principal 123, Centro Histórico",
        "numero_telefonico": "+52 555-123-4567",
        "correo": "reservas@plazacentral.com",
        "img": "hotel-plaza-central.jpg",
        "created_at": "2024-01-01T00:00:00.000000Z",
        "updated_at": "2024-01-01T00:00:00.000000Z"
    }
}
```

### 3. Crear un nuevo hospedaje

```
POST /api/hospedajes
```

**Body:**

```json
{
    "nombre": "Nuevo Hotel",
    "direccion": "Nueva Dirección 456",
    "numero_telefonico": "+52 555-999-8888",
    "correo": "info@nuevohotel.com",
    "img": "nuevo-hotel.jpg"
}
```

**Respuesta:**

```json
{
    "success": true,
    "message": "Hospedaje creado exitosamente",
    "data": {
        "id": 6,
        "nombre": "Nuevo Hotel",
        "direccion": "Nueva Dirección 456",
        "numero_telefonico": "+52 555-999-8888",
        "correo": "info@nuevohotel.com",
        "img": "nuevo-hotel.jpg",
        "created_at": "2024-01-01T00:00:00.000000Z",
        "updated_at": "2024-01-01T00:00:00.000000Z"
    }
}
```

### 4. Actualizar un hospedaje existente

```
PUT /api/hospedajes/{id}
```

**Body:**

```json
{
    "nombre": "Hotel Actualizado",
    "direccion": "Dirección Actualizada 789"
}
```

**Respuesta:**

```json
{
    "success": true,
    "message": "Hospedaje actualizado exitosamente",
    "data": {
        "id": 1,
        "nombre": "Hotel Actualizado",
        "direccion": "Dirección Actualizada 789",
        "numero_telefonico": "+52 555-123-4567",
        "correo": "reservas@plazacentral.com",
        "img": "hotel-plaza-central.jpg",
        "created_at": "2024-01-01T00:00:00.000000Z",
        "updated_at": "2024-01-01T00:00:00.000000Z"
    }
}
```

### 5. Eliminar un hospedaje

```
DELETE /api/hospedajes/{id}
```

**Respuesta:**

```json
{
    "success": true,
    "message": "Hospedaje eliminado exitosamente"
}
```

## Validaciones

### Crear/Actualizar Hospedaje

-   `nombre`: Requerido, máximo 255 caracteres
-   `direccion`: Requerido
-   `numero_telefonico`: Requerido, máximo 20 caracteres
-   `correo`: Requerido, debe ser un email válido, máximo 255 caracteres
-   `img`: Opcional, máximo 255 caracteres

## Archivos del Sistema

### Modelo

-   `app/Models/Hospedaje.php` - Modelo Eloquent con relaciones y configuración

### Controlador

-   `app/Http/Controllers/HospedajeController.php` - Controlador con métodos CRUD completos

### Migración

-   `database/migrations/2024_01_01_000009_create_hospedajes_table.php` - Estructura de la base de datos

### Seeder

-   `database/seeders/HospedajeSeeder.php` - Datos de ejemplo para la tabla

### Factory

-   `database/factories/HospedajeFactory.php` - Generación de datos de prueba

### Rutas

-   `routes/api.php` - Endpoints de la API (ya configurados)

## Uso del Sistema

### 1. Instalación

```bash
# Ejecutar migraciones
php artisan migrate

# Ejecutar seeders (opcional)
php artisan db:seed --class=HospedajeSeeder
```

### 2. Testing

```bash
# Crear datos de prueba usando la factory
php artisan tinker
>>> App\Models\Hospedaje::factory()->create();
```

### 3. Relaciones Futuras

El modelo está preparado para futuras relaciones con eventos:

```php
// En el modelo Evento
public function hospedajes()
{
    return $this->belongsToMany(Hospedaje::class, 'evento_hospedaje');
}

// En el modelo Hospedaje
public function eventos()
{
    return $this->belongsToMany(Evento::class, 'evento_hospedaje');
}
```

## Notas Importantes

-   Todos los endpoints devuelven respuestas JSON consistentes
-   Las validaciones están implementadas tanto en el frontend como en el backend
-   El campo `img` es opcional y puede contener URLs o rutas de archivos
-   El sistema está preparado para futuras expansiones y relaciones
-   Los datos de ejemplo incluyen diferentes tipos de establecimientos de hospedaje
