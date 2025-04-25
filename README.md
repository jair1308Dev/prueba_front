
# 📋 Proyecto de Gestión de Cocteles

Plataforma desarrollada en **Laravel** para la gestión de usuarios y sus cocteles favoritos. Incluye funcionalidades de registro/login de usuarios, listado de cocteles favoritos, filtros avanzados y un sistema visual atractivo.

## 🚀 Requisitos del sistema

Antes de iniciar, asegúrate de tener instalado:

- PHP >= 8.3
- Composer
- Node.js y npm
- MySQL o cualquier base de datos compatible
- Extensiones PHP necesarias:
  - OpenSSL
  - PDO
  - Mbstring
  - Tokenizer
  - XML
  - Ctype
  - JSON
  - BCMath

## ⚙️ Instalación

1. **Clonar el repositorio**
   ```bash
   git clone https://github.com/jair1308Dev/prueba_front.git
   ```

2. **Instalar dependencias PHP**
   ```bash
   composer install
   ```

3. **Instalar dependencias JavaScript**
   ```bash
   npm install
   ```

4. **Configurar archivo `.env`**
   - Copia el archivo de ejemplo:
     ```bash
     cp .env.example .env
     ```
   - Configura tu base de datos y otros parámetros necesarios dentro del `.env`.

5. **Generar la clave de la aplicación**
   ```bash
   php artisan key:generate
   ```

6. **Ejecutar migraciones**
   ```bash
   php artisan migrate
   ```

7. **Compilar los assets (CSS y JS)**
   ```bash
   npm run dev
   ```

## ▶️ Ejecución del proyecto

Levanta el servidor local con:

```bash
php artisan serve
```

Luego accede desde tu navegador a:

```
http://127.0.0.1:8000
```

## 🛠️ Funcionalidades implementadas

### 24 de abril, 2025

- **Login y registro validados**
  - Implementación de validaciones tanto en frontend como en backend para formularios de autenticación.
  - Manejo de errores de entrada y mejora en la seguridad de credenciales.

### 25 de abril, 2025

- **Agregar tabla de cocteles favoritos y listado con filtros con estilos**
  - Tabla para mostrar cocteles favoritos de los usuarios.
  - Sistema de filtrado dinámico.
  - Estilos mejorados para una mejor presentación.

- **Commit final para el guardado y el eliminado de los cocteles**
  - Funcionalidad completa para añadir y eliminar cocteles favoritos.
  - Verificación de integridad en las operaciones de base de datos.

- **Ajuste del estilo de login y registro**
  - Mejoras visuales en las pantallas de login y registro para hacerlas más atractivas y usables.
  - Correcciones de diseño responsivo.

## 👤 Autor

- Desarrollador: **Jair Carvajal**
