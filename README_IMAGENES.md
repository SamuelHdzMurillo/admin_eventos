# Manejo de Imágenes en Participantes

Este documento explica cómo funciona el sistema de subida y gestión de imágenes de credencial para los participantes.

## 🖼️ **Funcionalidades Implementadas**

### **✅ Subida de Imágenes:**

-   **Formato:** JPEG, PNG, JPG, GIF
-   **Tamaño máximo:** 2MB
-   **Ubicación:** `storage/app/public/credenciales/`
-   **Nombres únicos:** Generados automáticamente con timestamp

### **✅ Gestión de Imágenes:**

-   **Crear participante** con imagen
-   **Actualizar participante** con nueva imagen (elimina la anterior)
-   **Eliminar participante** (elimina la imagen asociada)
-   **Obtener URL** de la imagen

## 🔧 **Configuración Requerida**

### **1. Enlace Simbólico (ya creado):**

```bash
php artisan storage:link
```

### **2. Carpeta de Almacenamiento:**

```bash
mkdir -p storage/app/public/credenciales
```

### **3. Permisos de Escritura:**

```bash
chmod -R 775 storage/app/public/credenciales
```

## 📡 **Endpoints de Imágenes**

### **1. Crear Participante con Imagen**

```http
POST /api/participantes
Authorization: Bearer {admin_token}
Content-Type: multipart/form-data
```

**Form Data:**

```
equipo_id: 1
nombre_participante: "Juan Pérez"
rol_participante: "Chef Principal"
talla_participante: "M"
telefono_participante: "8181111111"
matricula_participante: "2024001"
correo_participante: "juan.perez@email.com"
plantel_participante: "Instituto Culinario"
plantelcct: "19DCT0001A"
semestre_participante: "6to"
especialidad_participante: "Cocina Internacional"
seguro_facultativo: true
tipo_sangre_participante: "O+"
alergico: false
foto_credencial: [archivo de imagen]
```

### **2. Actualizar Participante con Nueva Imagen**

```http
PUT /api/participantes/{id}
Authorization: Bearer {admin_token}
Content-Type: multipart/form-data
```

**Form Data:**

```
foto_credencial: [nuevo archivo de imagen]
```

**Nota:** La imagen anterior se elimina automáticamente.

### **3. Obtener URL de la Imagen**

```http
GET /api/participantes/{id}/credencial
Authorization: Bearer {token}
```

**Respuesta:**

```json
{
    "success": true,
    "data": {
        "image_url": "http://localhost:8000/storage/credenciales/credencial_abc123_1234567890.jpg",
        "filename": "credenciales/credencial_abc123_1234567890.jpg"
    }
}
```

## 💻 **Ejemplos de Uso**

### **JavaScript/Fetch - Crear Participante con Imagen**

```javascript
const createParticipanteWithImage = async (participanteData, imageFile) => {
    const formData = new FormData();

    // Agregar todos los campos del participante
    Object.keys(participanteData).forEach((key) => {
        formData.append(key, participanteData[key]);
    });

    // Agregar la imagen
    if (imageFile) {
        formData.append("foto_credencial", imageFile);
    }

    const token = localStorage.getItem("token");
    const response = await fetch("/api/participantes", {
        method: "POST",
        headers: {
            Authorization: `Bearer ${token}`,
        },
        body: formData,
    });

    return await response.json();
};

// Uso
const participanteData = {
    equipo_id: 1,
    nombre_participante: "Juan Pérez",
    rol_participante: "Chef Principal",
    // ... otros campos
};

const imageFile = document.getElementById("imageInput").files[0];
const result = await createParticipanteWithImage(participanteData, imageFile);
```

### **JavaScript/Fetch - Actualizar Imagen**

```javascript
const updateParticipanteImage = async (participanteId, newImageFile) => {
    const formData = new FormData();
    formData.append("foto_credencial", newImageFile);

    const token = localStorage.getItem("token");
    const response = await fetch(`/api/participantes/${participanteId}`, {
        method: "PUT",
        headers: {
            Authorization: `Bearer ${token}`,
        },
        body: formData,
    });

    return await response.json();
};
```

### **JavaScript/Fetch - Obtener URL de Imagen**

```javascript
const getCredencialImage = async (participanteId) => {
    const token = localStorage.getItem("token");
    const response = await fetch(
        `/api/participantes/${participanteId}/credencial`,
        {
            headers: {
                Authorization: `Bearer ${token}`,
            },
        }
    );

    const data = await response.json();
    if (data.success) {
        return data.data.image_url;
    }
    return null;
};

// Mostrar imagen en HTML
const imageUrl = await getCredencialImage(1);
if (imageUrl) {
    document.getElementById("credencialImage").src = imageUrl;
}
```

## 🖥️ **HTML - Formulario de Subida**

```html
<form id="participanteForm" enctype="multipart/form-data">
    <div class="form-group">
        <label for="nombre_participante">Nombre del Participante</label>
        <input
            type="text"
            id="nombre_participante"
            name="nombre_participante"
            required
        />
    </div>

    <div class="form-group">
        <label for="foto_credencial">Foto de Credencial</label>
        <input
            type="file"
            id="foto_credencial"
            name="foto_credencial"
            accept="image/jpeg,image/png,image/jpg,image/gif"
            required
        />
        <small class="form-text text-muted">
            Formatos permitidos: JPEG, PNG, JPG, GIF. Tamaño máximo: 2MB
        </small>
    </div>

    <!-- Otros campos del formulario -->

    <button type="submit">Crear Participante</button>
</form>

<div id="imagePreview" style="display: none;">
    <h4>Vista Previa:</h4>
    <img id="previewImage" style="max-width: 200px; max-height: 200px;" />
</div>
```

## 🔍 **Validaciones Implementadas**

### **Validación de Archivo:**

-   ✅ **Tipo:** Solo imágenes (jpeg, png, jpg, gif)
-   ✅ **Tamaño:** Máximo 2MB
-   ✅ **Requerido:** No (nullable)

### **Validación de Seguridad:**

-   ✅ **Nombres únicos:** Evita conflictos
-   ✅ **Eliminación automática:** Imágenes anteriores
-   ✅ **Limpieza:** Al eliminar participante

## 📁 **Estructura de Archivos**

```
storage/
├── app/
│   └── public/
│       └── credenciales/
│           ├── credencial_abc123_1234567890.jpg
│           ├── credencial_def456_1234567891.png
│           └── ...
└── public/ (enlace simbólico)
    └── credenciales/
        ├── credencial_abc123_1234567890.jpg
        ├── credencial_def456_1234567891.png
        └── ...
```

## ⚠️ **Notas Importantes**

-   **Solo administradores** pueden subir/actualizar imágenes
-   **Cualquier usuario autenticado** puede ver las imágenes
-   **Las imágenes se almacenan** en `storage/app/public/credenciales/`
-   **Los nombres de archivo** incluyen timestamp para evitar conflictos
-   **La eliminación es automática** al actualizar o eliminar participante
-   **El enlace simbólico** debe existir para acceder a las imágenes

## 🚀 **Próximas Mejoras Sugeridas**

-   **Compresión automática** de imágenes
-   **Redimensionamiento** a tamaños estándar
-   **Validación de dimensiones** mínimas/máximas
-   **Backup automático** de imágenes
-   **CDN** para mejor rendimiento
-   **Watermark** automático en las imágenes
