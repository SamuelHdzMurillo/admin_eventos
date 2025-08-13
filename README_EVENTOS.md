# Sistema de Administración de Eventos

Este sistema permite gestionar eventos gastronómicos, equipos participantes, participantes, acompañantes, recetas y cédulas de registro.

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

### Eventos

-   `GET /api/eventos` - Listar todos los eventos
-   `POST /api/eventos` - Crear un nuevo evento
-   `GET /api/eventos/{id}` - Obtener un evento específico
-   `PUT /api/eventos/{id}` - Actualizar un evento
-   `DELETE /api/eventos/{id}` - Eliminar un evento

### Equipos

-   `GET /api/equipos` - Listar todos los equipos
-   `POST /api/equipos` - Crear un nuevo equipo
-   `GET /api/equipos/{id}` - Obtener un equipo específico
-   `PUT /api/equipos/{id}` - Actualizar un equipo
-   `DELETE /api/equipos/{id}` - Eliminar un equipo
-   `GET /api/equipos/{id}/completo` - Obtener equipo con toda la información relacionada

### Participantes

-   `GET /api/participantes` - Listar todos los participantes
-   `POST /api/participantes` - Crear un nuevo participante
-   `GET /api/participantes/{id}` - Obtener un participante específico
-   `PUT /api/participantes/{id}` - Actualizar un participante
-   `DELETE /api/participantes/{id}` - Eliminar un participante

### Acompañantes

-   `GET /api/acompanantes` - Listar todos los acompañantes
-   `POST /api/acompanantes` - Crear un nuevo acompañante
-   `GET /api/acompanantes/{id}` - Obtener un acompañante específico
-   `PUT /api/acompanantes/{id}` - Actualizar un acompañante
-   `DELETE /api/acompanantes/{id}` - Eliminar un acompañante

### Recetas

-   `GET /api/recetas` - Listar todas las recetas
-   `POST /api/recetas` - Crear una nueva receta
-   `GET /api/recetas/{id}` - Obtener una receta específica
-   `PUT /api/recetas/{id}` - Actualizar una receta
-   `DELETE /api/recetas/{id}` - Eliminar una receta

### Cédulas de Registro

-   `GET /api/cedulas-registro` - Listar todas las cédulas
-   `POST /api/cedulas-registro` - Crear una nueva cédula
-   `GET /api/cedulas-registro/{id}` - Obtener una cédula específica
-   `PUT /api/cedulas-registro/{id}` - Actualizar una cédula
-   `DELETE /api/cedulas-registro/{id}` - Eliminar una cédula

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

### Crear un Evento

```json
POST /api/eventos
{
    "nombre_evento": "Concurso Regional de Cocina",
    "inicio_evento": "2024-09-15 09:00:00",
    "fin_evento": "2024-09-17 18:00:00",
    "sede_evento": "Auditorio Principal",
    "lim_de_participantes_evento": 100,
    "estatus_evento": "activo"
}
```

### Crear un Equipo

```json
POST /api/equipos
{
    "nombre_equipo": "Los Sabores del Norte",
    "evento_id": 1,
    "entidad_federativa": "Nuevo León",
    "estatus_del_equipo": "activo",
    "nombre_anfitrion": "María González",
    "telefono_anfitrion": "8181234567",
    "correo_anfitrion": "maria.gonzalez@email.com"
}
```

### Crear un Participante

```json
POST /api/participantes
{
    "equipo_id": 1,
    "nombre_participante": "Juan Pérez",
    "rol_participante": "Chef Principal",
    "talla_participante": "M",
    "telefono_participante": "8181111111",
    "matricula_participante": "2024001",
    "correo_participante": "juan.perez@email.com",
    "plantel_participante": "Instituto Culinario",
    "plantelcct": "19DCT0001A",
    "semestre_participante": "6to",
    "especialidad_participante": "Cocina Internacional",
    "seguro_facultativo": true,
    "tipo_sangre_participante": "O+",
    "alergico": false
}
```

## Validaciones

El sistema incluye validaciones para:

-   Campos obligatorios
-   Formato de correos electrónicos
-   Existencia de IDs relacionados
-   Tipos de datos correctos
-   Estados válidos para enums

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

-   Las migraciones deben ejecutarse en el orden correcto debido a las dependencias de claves foráneas
-   Los seeders incluyen datos de ejemplo para probar el sistema
-   El sistema maneja eliminación en cascada para mantener la integridad referencial
-   Las fechas se manejan en formato datetime de MySQL
