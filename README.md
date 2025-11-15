# ReparandoYa - Plataforma WordPress de Servicios

## 🔧 Descripción del Proyecto

ReparandoYa es una plataforma WordPress completa para conectar usuarios con profesionales cualificados en servicios del hogar como fontanería, electricidad, cerrajería, limpieza y más.

### ✨ Características Principales

- 📋 **Custom Post Types**: Servicios, Profesionales y Reservas
- 🏷️ **Taxonomías**: Categorías de Servicio y Ubicaciones
- 🚀 **AJAX**: Búsqueda dinámica y formularios interactivos
- 🔗 **Integración CDMon**: API completa para hosting y dominios
- 🎨 **Tema Responsivo**: Diseño Bootstrap 5 mobile-first
- 📧 **Sistema de Reservas**: Completo con notificaciones por email
- 🌟 **Sistema de Testimonios**: Reseñas y valoraciones
- 🔍 **Búsqueda Avanzada**: Por categoría, ubicación y texto libre

## 📚 Requisitos WordPress Cumplidos

✅ **Tema personalizado** con todos los archivos necesarios  
✅ **Menú de navegación de 2 niveles** con dropdown  
✅ **Formulario de contacto** personalizado funcional  
✅ **6 páginas** creadas automáticamente  
✅ **5 categorías de blog** y entradas de ejemplo  
✅ **3 Custom Post Types** (Servicios, Profesionales, Reservas)  
✅ **Enlace a sitio externo** en el menú  
✅ **Shortcodes** para contenido dinámico  
✅ **Taxonomías personalizadas** para organización  

## 🔧 Instalación en CDMon

### Opción 1: Clonado desde GitHub (Recomendado)

1. **Accede a tu panel de CDMon**
   - Ve a tu hosting en CDMon
   - Abre el File Manager o conecta por FTP

2. **Clona el repositorio**
   ```bash
   git clone https://github.com/00Fenris/reparandoya-wordpress.git
   cd reparandoya-wordpress
   ```

3. **Descarga WordPress Core**
   - Descarga WordPress 6.8.3 en español desde wordpress.org
   - Extrae todos los archivos WordPress en la raíz del proyecto
   - Mantén el wp-config.php del repositorio

4. **Sube los archivos**
   - Sube todo el contenido a la carpeta public_html de tu dominio
   - Asegúrate de que wp-config.php tiene la configuración correcta

### Opción 2: Descarga Directa

1. **Descarga el proyecto**
   - Ve a: https://github.com/00Fenris/reparandoya-wordpress
   - Haz clic en "Code" → "Download ZIP"
   - Extrae el archivo

2. **Prepara WordPress**
   - Descarga WordPress 6.8.3 completo
   - Combina los archivos del proyecto con WordPress
   - Usa el wp-config.php del proyecto

3. **Sube por FTP**
   - Conecta a tu FTP de CDMon
   - Sube todos los archivos a public_html

## ⚙️ Configuración de Base de Datos

El archivo `wp-config.php` ya está configurado para CDMon:

```php
// Configuración CDMon
define('DB_NAME', '278011167wordpress20251105112549');
define('DB_USER', '278011167');
define('DB_PASSWORD', 'pAb5UIS0ypNY4ZA2Cv0qaYcyy7teYrGT');
define('DB_HOST', 'mysql5.cdmon.net');
```

**⚠️ Importante**: Asegúrate de que la base de datos MySQL esté creada en tu panel CDMon.

## 📦 Estructura del Proyecto

```
reparandoya-wordpress/
├── wp-config.php              # Configuración CDMon
├── index.php                   # Index principal WordPress
├── wp-content/
│   ├── themes/
│   │   └── reparandoya/        # Tema personalizado
│   │       ├── functions.php       # Funciones del tema
│   │       ├── header.php          # Cabecera con menú
│   │       ├── footer.php          # Pie con testimonios
│   │       ├── index.php           # Plantilla principal
│   │       ├── single.php          # Entradas individuales
│   │       ├── archive.php         # Archivo de entradas
│   │       └── style.css           # Estilos CSS
│   └── plugins/
│       └── reparandoya-core/   # Plugin principal
│           ├── reparandoya-core.php    # Archivo principal
│           └── includes/
│               └── cdmon-api.php       # Integración CDMon
└── README.md                   # Esta documentación
```

## 🚀 Configuración Post-Instalación

### 1. Activar el Tema y Plugin

1. Ve al **Panel de Administración WordPress**
2. Ve a **Apariencia → Temas**
3. Activa el tema **ReparandoYa**
4. Ve a **Plugins → Plugins Instalados**
5. Activa **ReparandoYa Core**

### 2. Configurar Menús

1. Ve a **Apariencia → Menús**
2. Crea un nuevo menú llamado "Principal"
3. Añade las páginas creadas automáticamente:
   - Inicio
   - Servicios (con submenú: Fontanería, Electricidad, Cerrajería)
   - Profesionales
   - Cómo Funciona
   - Contacto
   - Enlace Externo (Google)
4. Asigna el menú a "Menú Principal"

### 3. Configurar Página de Inicio

1. Ve a **Ajustes → Lectura**
2. Selecciona "Una página estática"
3. Elige "Inicio" como página principal

## 📝 Uso de Shortcodes

El tema incluye varios shortcodes personalizados:

- `[reparandoya_hero_section]` - Sección hero de la portada
- `[reparandoya_contact_form]` - Formulario de contacto funcional
- `[reparandoya_testimonials]` - Sección de testimonios
- `[reparandoya_services_grid]` - Cuadrícula de servicios

## 🎯 Funcionalidades Avanzadas

### Custom Post Types

- **Servicios**: Gestiona todos los servicios disponibles
- **Profesionales**: Perfiles de profesionales verificados
- **Reservas**: Sistema completo de reservas con notificaciones

### Taxonomías

- **Categorías de Servicio**: Fontanería, Electricidad, Cerrajería, etc.
- **Ubicaciones**: Madrid, Barcelona, Valencia, Sevilla

### AJAX y Interactividad

- Búsqueda de servicios en tiempo real
- Formulario de reservas dinámico
- Filtrado por categoría y ubicación

## 📞 Soporte y Contacto

### Desarrolladores
- **Daniel Guerrero Galán**
- **Ignacio Molina**

### Información Técnica
- **WordPress Version**: 6.8.3
- **PHP**: 7.4+
- **Bootstrap**: 5.1.3
- **CDMon API Key**: pAb5UIS0ypNY4ZA2Cv0qaYcyy7teYrGT

### Enlaces Útiles
- 🔗 **Repositorio**: https://github.com/00Fenris/reparandoya-wordpress
- 🌐 **Demo**: (Configurar después de la instalación)
- 📚 **Documentación WordPress**: https://wordpress.org/documentation/
- 🏠 **Hosting CDMon**: https://www.cdmon.com

## 📝 Licencia

Este proyecto está licenciado bajo GPL v2 o posterior, compatible con WordPress.

---

**🎆 ¡Gracias por usar ReparandoYa! Esperamos que esta plataforma sea útil para conectar usuarios con profesionales de calidad.**