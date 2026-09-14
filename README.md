# 🔥 PyroBet App - Plataforma de Predicciones Deportivas

¡Bienvenido a **PyroBet**  Una aplicación web desarrollada en **Laravel 13** diseñada para la gestión, control y votación de pronósticos deportivos en tiempo real.

---

## 🚀 Características Principales
 
### ⚙️ Panel de Control Administrativo 
*   **Gestión Global Cruzada:** Control total (CRUD) sobre las tablas de **Equipos, Ligas/Competiciones y Partidos** mapeados de forma nativa en SQLite.
*   **Consola de Marcadores Oficiales:** Interfaz optimizada para la carga de marcadores reales y actualización de estados (`upcoming`, `live`, `finished`).
*   **Filtros Inteligentes:** Buscador avanzado con capacidades de filtrado por coincidencia de texto en equipos, estados del juego y ordenamiento cronológico.

### 🔮 Módulo de Usuarios y Pronósticos
*   **Cartelera Interactiva:** Panel visual horizontal para la consulta de partidos y registro de apuestas.
*   **Registro de predicciones y sistema de filtrado:** Consulta y Edicion de apuestas. 
*   **Salón de la Fama (Ranking Global):** Tabla de posiciones competitiva que despliega en tiempo real los usuarios con mas puntos.

---

## 🧮 Motor de Puntuación

PyroBet cuenta con un algoritmo matemático automatizado que se gatilla inmediatamente cuando el Administrador cambia el estado de un encuentro a **`finished`**. El sistema evalúa tres interruptores booleanos independientes por cada apuesta para determinar el puntaje exacto de forma justa:

| Rango | Regla de Puntuación | Puntos | Estado |
| :---: | :--- | :---: | :---: |
| 🏆 | **Marcador de Oro:** Adivinó el Resultado General + Goles de Ambos Equipos de forma exacta. | **8 PTS** | `hit` |
| 🥈 | **Marcador de Plata:** Adivinó ambos marcadores de goles exactos, pero erró el resultado general. | **6 PTS** | `hit` |
| 🥉 | **Marcador de Bronce:** Adivinó el Resultado General Y ADEMÁS un marcador de goles (Local o Visita). | **4 PTS** | `hit` |
| 🎖️ | **Acierto de Consolación:** Falló el resultado general, pero adivinó al menos un marcador de goles. | **2 PTS** | `hit` |
| 🎖️ | **Acierto de Tendencia:** Adivinó ÚNICAMENTE el resultado general (Ganador/Empate) fallando ambos goles. | **1 PT** | `hit` |
| ❌ | **Predicción Fallida:** No acertó ninguna de las variables del encuentro. | **0 PTS** | `missed` |

---

## 🛡️ Candados de Seguridad y Antifraude (Viaje en el Tiempo)

*   **Bloqueo de Votación Temporal:** Los usuarios comunes tienen prohibido inyectar o modificar predicciones si el estado del encuentro cambia o si la hora del reloj del servidor supera la fecha de juego programada.
*   **Protección Cronológica Administrativa:** El controlador de partidos valida en tiempo real que el administrador no pueda simular el inicio (`live`) o la conclusión (`finished`) de encuentros cuyas fechas reales se encuentren en el futuro en el calendario.

---

## 🛠️ Stack Tecnológico Utilizado

*   **Backend:** PHP 8.4 + Laravel 13 Framework
*   **Frontend UI:** Tailwind CSS v4 + Flux Starter Kit
*   **Base de Datos:** SQLite (Optimizado con indexación de claves relacionales)
*   **Calidad de Código y Estilos:** Laravel Pint (Linter de sintaxis) + PHPStan (Análisis estático de tipos estrictos genéricos)

---

## 📦 Requisitos de Instalación (Entorno Local)

Sigue estos pasos para levantar el entorno de desarrollo en tu computadora de forma limpia:

1. **Clonar el repositorio de GitHub:**
   ```bash
   git clone https://github.com/DylanGoncalvesDev/PyroBet-App.git
   cd PyroBet
   ```

2. **Instalar las dependencias de PHP (Composer):**
   ```bash
   composer install
   ```

3. **Instalar los paquetes y estilos del frontend (NPM):**
   ```bash
   npm install
   ```

4. **Configurar el Entorno:**
   Crea una copia de tu archivo de variables de entorno:
    ```bash
   # Si usas Windows (CMD clásico):
   copy .env.example .env

   # Si usas Linux, Mac o Git Bash:
   cp .env.example .env
   ```
   Genera la llave secreta de seguridad e encriptación obligatoria para evitar el error `MissingAppKeyException`:
    ```bash
   php artisan key:generate
   ```
   Abre el archivo `.env` y edita la tercera línea para asignar el nombre corporativo oficial:
   ```env
   APP_NAME="PyroBet"
   ```

5. **Preparar la Base de Datos:**
   Antes de migrar, es estrictamente obligatorio crear el archivo físico de la base de datos SQLite en tu computadora. Ejecuta el comando nativo de tu sistema operativo:
   ```bash
   # Opción para Windows (CMD clásico):
   copy nul database\database.sqlite

   # Opción para Linux, Mac o Git Bash:
   touch database/database.sqlite
   ```
   Una vez creado el archivo físico en el disco duro, ejecuta las migraciones junto con los seeders de fábrica para estructurar las tablas y rellenar los datos de prueba:
   ```bash
   php artisan migrate --seed
   ```
6. **Compilar Gráficos y Encender Servidor:**
   Abre una terminal y mantén encendido el compilador en caliente de Tailwind:
   ```bash
   npm run dev
   ```
   En una segunda pestaña de tu terminal, enciende el servidor local de Laravel:
   ```bash
   php artisan serve
   ```
   Accede desde tu navegador a: `http://127.0.0.1:8000`
---

## 💻 Comandos Útiles de Desarrollo y CI/CD

*   **Correr Pruebas Automatizadas:** `php artisan test`
*   **Limpiar y dar Formato al Código (Linter):** `vendor\bin\pint` (Windows) o `./vendor/bin/pint` (Linux/Bash)
*   **Analizar Tipos Estrictos (PHPStan):** `composer ci:check`
*   **Ascender Usuario a Administrador (Tinker):**
    ```bash
    php artisan tinker
    >>> \$user = \App\Models\User::find(1); user->role = 'admin'; user->save();          
    >>> exit
    ```
