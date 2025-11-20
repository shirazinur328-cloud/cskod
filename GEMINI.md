# GEMINI.md: Project cskod

## Project Overview

This project is a web-based e-learning or school management system named "cskod". It is built with the **CodeIgniter 3** PHP framework. The application is designed to be used by three distinct user roles:

*   **Admin:** Manages the overall system.
*   **Guru:** (Teacher) Manages subjects, materials, and student assignments.
*   **Murid:** (Student) Accesses learning materials and submits assignments.

The application follows the Model-View-Controller (MVC) architectural pattern. The frontend appears to use Bootstrap, with a theme called "SB Admin 2". It also uses `dompdf` for generating PDF files, likely for reports or certificates.

## Building and Running

This is a PHP project that requires a web server with a MySQL database. A typical local development environment would be XAMPP or a similar stack.

### 1. Environment Setup

*   **Web Server:** Apache or Nginx with PHP 5.6 or newer.
*   **Database:** MySQL.
*   **Project Files:** Place the project files in your web server's document root (e.g., `C:\xampp\htdocs\cskod`).

### 2. Database Setup

*   The database connection settings are located in `application/config/database.php`.
*   By default, the application is configured to use the following settings:
    *   **Hostname:** `localhost`
    *   **Username:** `root`
    *   **Password:** (empty)
    *   **Database Name:** `cskod`
*   You must create a MySQL database named `cskod` and import the schema. The database schema can be inferred from the migration files located in `application/migrations/`. These files define the structure for tables like `absensi_guru`, `tugas`, `materi`, `kelas_mapel`, and more.

### 3. Running the Application

*   Once the files and database are set up, you can access the application in your web browser.
*   The base URL is configured in `application/config/config.php` as `http://localhost/cskod/`.
*   The application's entry point is the login page, handled by the `Auth` controller.

## Development Conventions

*   **Framework:** The project strictly follows CodeIgniter 3 conventions.
*   **MVC Pattern:**
    *   **Models:** Located in `application/models/`, they handle database interactions. Model files are named `Model_*.php`.
    *   **Views:** Located in `application/views/`, they contain the HTML templates. The views are organized into subdirectories based on user roles (`admin`, `guru`, `murid`).
    *   **Controllers:** Located in `application/controllers/`, they handle user input and business logic, acting as the intermediary between Models and Views. Controllers are also organized by role.
*   **Routing:** URL routes are defined in `application/config/routes.php`. The default controller is `auth`, which handles login. Role-specific routes (`/admin`, `/guru`, `/murid`) are mapped to their respective dashboard controllers.
*   **Dependencies:** PHP dependencies are managed with Composer and are listed in `composer.json`.
*   **Database Migrations:** Database schema changes are managed through migration files in `application/migrations/`.
*   **Authentication:** The `Auth` controller (`application/controllers/Auth.php`) manages user login and logout. After a successful login, user data is stored in the session, and the user is redirected to a dashboard based on their role.
