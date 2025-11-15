# 🚀 Instalación Rápida en CDMon

## 📋 Pasos Específicos para CDMon

### 1️⃣ Preparar el Hosting

1. **Accede a tu Panel CDMon**
   - URL: https://www.cdmon.com/es/login
   - Usuario: 278011167
   - Contraseña: [tu contraseña CDMon]

2. **Verifica la Base de Datos**
   - Ve a "Bases de Datos MySQL"
   - Confirma que existe: `278011167wordpress20251105112549`
   - Host: `mysql5.cdmon.net`
   - Usuario: `278011167`

### 2️⃣ Instalar WordPress + ReparandoYa

**Opción A: Via FTP (Más Fácil)**

1. **Descarga los archivos**
   ```bash
   # En tu ordenador local:
   git clone https://github.com/00Fenris/reparandoya-wordpress.git
   
   # O descarga el ZIP desde:
   # https://github.com/00Fenris/reparandoya-wordpress/archive/refs/heads/main.zip
   ```

2. **Descarga WordPress Core**
   - Ve a: https://es.wordpress.org/download/
   - Descarga WordPress 6.8.3 en español
   - Extrae el archivo ZIP

3. **Combina los archivos**
   - Copia TODOS los archivos de WordPress a la carpeta del proyecto
   - **MANTÉN** el archivo `wp-config.php` del proyecto (¡NO lo sobrescribas!)
   - **MANTÉN** la carpeta `wp-content` del proyecto

4. **Sube a CDMon**
   - Usa FileZilla o el File Manager de CDMon
   - Servidor FTP: `ftp.tudominio.com` (o el que te proporcione CDMon)
   - Sube TODOS los archivos a la carpeta `public_html`

**Opción B: Directamente en CDMon (Si tienes acceso SSH)**

```bash
# Conecta por SSH a tu hosting
ssh 278011167@servidor.cdmon.net

# Ve a la carpeta web
cd public_html

# Clona el proyecto
git clone https://github.com/00Fenris/reparandoya-wordpress.git .

# Descarga WordPress
wget https://es.wordpress.org/latest-es_ES.zip
unzip latest-es_ES.zip
cp -r wordpress/* .
rm -rf wordpress latest-es_ES.zip

# Los archivos del proyecto ya están configurados
```

### 3️⃣ Configuración Automática

El proyecto ya incluye:
- ✅ `wp-config.php` configurado para CDMon
- ✅ Base de datos: `278011167wordpress20251105112549`
- ✅ Credenciales CDMon incluidas
- ✅ Tema personalizado listo
- ✅ Plugin ReparandoYa Core

### 4️⃣ Completar la Instalación

1. **Accede a tu dominio**
   - Ve a: `http://tudominio.com`
   - Deberías ver el asistente de instalación de WordPress

2. **Configuración WordPress**
   - Título del sitio: `ReparandoYa`
   - Usuario administrador: `admin`
   - Contraseña: `[elige una segura]`
   - Email: `tu@email.com`

3. **Activar Tema y Plugin**
   ```
   Panel Admin → Apariencia → Temas → Activar "ReparandoYa"
   Panel Admin → Plugins → Activar "ReparandoYa Core"
   ```

### 5️⃣ Configuración Final

1. **Menús**
   - Ve a `Apariencia → Menús`
   - Crea menú "Principal" con las páginas auto-creadas
   - Añade submenú en "Servicios" (Fontanería, Electricidad, Cerrajería)

2. **Página de Inicio**
   - `Ajustes → Lectura → Página estática`
   - Selecciona "Inicio" como página frontal

3. **Permalinks**
   - `Ajustes → Enlaces permanentes`
   - Selecciona "Nombre de la entrada"

## 🛠️ Resolución de Problemas

### ❌ Error: "Error estableciendo conexión con la base de datos"

**Solución:**
```php
// Verifica en wp-config.php que tengas:
define('DB_NAME', '278011167wordpress20251105112549');
define('DB_USER', '278011167');
define('DB_PASSWORD', 'pAb5UIS0ypNY4ZA2Cv0qaYcyy7teYrGT');
define('DB_HOST', 'mysql5.cdmon.net');
```

### ❌ Error: "No se pueden escribir archivos"

**Solución:**
```bash
# Ajustar permisos (si tienes SSH)
chmod 755 wp-content/
chmod 755 wp-content/themes/
chmod 755 wp-content/plugins/
chmod 644 wp-config.php
```

### ❌ El tema no aparece

**Solución:**
- Verifica que la carpeta `wp-content/themes/reparandoya/` existe
- Verifica que `functions.php` y `style.css` están presentes
- Recarga la página de temas en el admin

## 📞 Contacto CDMon

Si tienes problemas técnicos con el hosting:
- **Teléfono**: 902 200 991
- **Email**: soporte@cdmon.com
- **Panel**: https://www.cdmon.com/es/login

## 🎯 URLs Importantes

Después de la instalación:
- **Sitio web**: `http://tudominio.com`
- **Admin WordPress**: `http://tudominio.com/wp-admin`
- **File Manager CDMon**: Panel CDMon → Gestión de archivos
- **PHPMyAdmin**: Panel CDMon → Bases de datos

---

**💡 Tip**: Guarda este archivo para futuras referencias. Todo está configurado para funcionar perfectamente con tu hosting CDMon.