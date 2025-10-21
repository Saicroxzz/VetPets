# 🐾 VetPets — Sistema de Base de Datos Distribuida

Un sistema web para la **gestión integral de información veterinaria** en múltiples sedes, desarrollado con **PHP, MySQL, HTML, CSS, JavaScript y Bootstrap**.
El proyecto implementa una **base de datos distribuida mediante replicación maestro–esclavo**, garantizando disponibilidad, consistencia y seguridad de los datos en tiempo real entre sedes.

---

## 📋 Características principales

* **Gestión de sedes** y sincronización automática de datos.
* **Administración de usuarios, dueños y mascotas** con control por sede.
* **Agenda de citas veterinarias** con registro de fecha, hora y motivo.
* **Historial médico digital** vinculado a cada mascota y cita.
* **Autenticación segura por sede**, con acceso independiente y coherente.
* **Replicación de base de datos en tiempo real** entre servidor maestro y servidores esclavos.
* **Interfaz intuitiva** y diseño responsive basado en Bootstrap.

---

## ⚙️ Tecnologías utilizadas

* **Backend:** PHP 8.4 (procedural)
* **Frontend:** HTML5, CSS3, JavaScript, Bootstrap
* **Base de datos:** MySQL (replicación maestro–esclavo)
* **Servidor local:** Apache (XAMPP)
* **Entorno de desarrollo:** Visual Studio Code
* **Control de versiones:** Git y GitHub

---

## 🧩 Estructura del sistema distribuido

### 🖥️ Servidor Maestro

El servidor principal almacena la base de datos original y genera los **archivos binarios (binlog)** para registrar todas las operaciones ejecutadas.
Configuración base en `my.ini` o `my.cnf`:

```ini
[mysqld]
server-id=1
log-bin=mysql-bin
binlog-do-db=vetpets_db
```

### 🌐 Servidores Esclavos

Cada servidor esclavo mantiene una copia sincronizada de la base de datos principal.

```ini
[mysqld]
server-id=2
relay-log=relay-bin
replicate-do-db=vetpets_db
```

Conexión al maestro:

```sql
CHANGE MASTER TO
MASTER_HOST='ip_maestro',
MASTER_USER='replica',
MASTER_PASSWORD='clave123',
MASTER_LOG_FILE='mysql-bin.000001',
MASTER_LOG_POS=XXX;
START SLAVE;
```

Verificación del estado:

```sql
SHOW SLAVE STATUS\G;
```

✅ Campos `Slave_IO_Running` y `Slave_SQL_Running` deben mostrar **Yes**.

---

## 🗄️ Entidades principales

| Entidad             | Descripción                                   |
| ------------------- | --------------------------------------------- |
| **Sede**            | Identifica cada clínica (ciudad, ubicación).  |
| **Usuario**         | Control de acceso por correo y contraseña.    |
| **Dueño (Cliente)** | Datos personales del propietario de mascotas. |
| **Mascota**         | Información básica del animal y su sede.      |
| **Cita**            | Fecha, hora, motivo y estado de la atención.  |
| **Historia Médica** | Registros clínicos asociados a cada cita.     |

> Todas las tablas incluyen el campo `id_sede` para mantener la coherencia en la replicación y restringir el acceso por ubicación.

---

## 🔑 Credenciales de prueba

| Rol / Sede                  | Correo electrónico                            | Contraseña |
| --------------------------- | --------------------------------------------- | ---------- |
| **Administrador (Maestro)** | [admin@vetpets.com](mailto:admin@vetpets.com) | admin123   |
| **Usuario sede 1**          | [sede1@vetpets.com](mailto:sede1@vetpets.com) | sede123    |
| **Usuario sede 2**          | [sede2@vetpets.com](mailto:sede2@vetpets.com) | sede123    |

Ò puedes crear tu cuenta en el modulo de Logueo

---

## 🧠 Funcionalidades principales

* Autenticación por sede y gestión de sesiones.
* Panel de control para registrar, editar y eliminar dueños.
* Registro de mascotas con vínculo directo al dueño y sede.
* Administración de citas y cronogramas veterinarios.
* Módulo de historia médica para seguimiento clínico.
* Visualización distribuida de datos sincronizados entre servidores.

---

## 🧪 Prueba de replicación

Durante las pruebas, se realizaron inserciones y actualizaciones en el **servidor maestro**, verificando en los **servidores esclavos** que los cambios se reflejaban automáticamente, validando así la correcta **sincronización y consistencia del sistema distribuido**.

```sql
INSERT INTO cita (fecha, hora, motivo) VALUES ('2025-10-10', '10:00:00', 'Chequeo general');
```

> Este registro fue replicado exitosamente en los esclavos, confirmando la integridad del modelo maestro–esclavo.

---

## 🚀 Instalación y despliegue

1. Clonar el repositorio:

   ```bash
   git clone https://github.com/Saicroxzz/VetPets.git
   ```

2. Configurar el entorno local (XAMPP o Laragon).

3. Crear la base de datos `vetpets_db` e importar el archivo SQL incluido.

4. Configurar la replicación según las instrucciones del apartado anterior.

5. Ingresar desde el navegador:

   ```
   http://localhost/VetPets/
   ```

---

## 📸 Capturas sugeridas
<img width="516" height="243" alt="image" src="https://github.com/user-attachments/assets/50727ec7-aff3-4651-a435-d87d2d980cd3" />
<img width="517" height="247" alt="image" src="https://github.com/user-attachments/assets/036ad08b-8044-4e28-bca2-f90bb3c063b6" />
<img width="519" height="248" alt="image" src="https://github.com/user-attachments/assets/e9f61fdd-8458-4875-9c7b-adc291b9bba0" />

---

## 👥 Autores

* **Wilever Beltrán Tuay**

---

## 📎 Repositorio

🔗 [https://github.com/Saicroxzz/VetPets](https://github.com/Saicroxzz/VetPets)

---

## 📄 Licencia

Este proyecto se distribuye bajo la licencia **MIT**.
Puedes usarlo, modificarlo y compartirlo libremente, siempre que mantengas la atribución a los autores originales.
