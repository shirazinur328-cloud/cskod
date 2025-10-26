# Project Overview

This project is a web application built using the **CodeIgniter 3** PHP framework. It leverages **Composer** for PHP dependency management and **npm/Gulp** for frontend asset management. The administrative interface is styled with the **SB Admin 2** Bootstrap theme. The application is designed to interact with a **MySQL** database.

## Technologies Used

*   **Backend:** PHP (5.6+), CodeIgniter 3
*   **Database:** MySQL (configured for `cskod` database)
*   **Frontend:** HTML, CSS (Bootstrap 4 / SB Admin 2), JavaScript, jQuery, Chart.js, DataTables
*   **Dependency Management:** Composer (PHP), npm (Node.js)
*   **Task Runner:** Gulp (for frontend assets)
*   **PDF Generation:** Dompdf

## Building and Running

### Backend Setup (PHP/CodeIgniter)

1.  **PHP Version:** Ensure PHP 5.6 or newer is installed.
2.  **Composer Dependencies:** Navigate to the project root (`C:\xampp\htdocs\cskod\`) and install PHP dependencies:
    ```bash
    composer install
    ```
3.  **Database Configuration:**
    *   The application expects a MySQL database named `cskod`.
    *   Database connection settings are located in `application/config/database.php`.
    *   Default credentials: `hostname: localhost`, `username: root`, `password: (empty)`.
4.  **Web Server:** Configure your web server (e.g., Apache with XAMPP) to point to the project's root directory. The base URL is configured as `http://localhost/cskod/`.

### Frontend Setup (SB Admin 2 / Gulp)

1.  **Node.js Dependencies:** Navigate to the `assets/` directory (`C:\xampp\htdocs\cskod\assets\`) and install Node.js dependencies:
    ```bash
    npm install
    ```
2.  **Compile Assets:** To watch for changes in frontend files (SCSS, JS) and compile them, run the Gulp watch task:
    ```bash
    npm start
    ```
    (This executes `node_modules/.bin/gulp watch`)

## Development Conventions

*   **MVC Architecture:** Follows the Model-View-Controller pattern as enforced by CodeIgniter.
*   **Coding Style:** Adheres to CodeIgniter's recommended PHP coding standards.
*   **Frontend Styling:** Uses Bootstrap 4 with the SB Admin 2 theme. Custom styles are likely in `assets/css/custom_theme.css` or SCSS files under `assets/scss/`.
*   **Color Scheme:**
    *   Primary: `#2C3E50` (Blue Navy)
    *   Accent (Success): `#28A745` (Green)
    *   Background (Light): `#F8F9FA`
    *   Main Text: `#343A40`
    *   Secondary Text/Gray: `#858796`
*   **Testing:** PHPUnit is used for running tests, as indicated by the `composer.json` script `test:coverage`.

## Key Directories

*   `application/`: Contains the core application logic (controllers, models, views, configurations).
*   `system/`: CodeIgniter system files (do not modify directly).
*   `assets/`: Frontend assets including CSS, JavaScript, images, and vendor libraries (Bootstrap, FontAwesome, Chart.js).
*   `vendor/`: PHP dependencies managed by Composer.
*   `kategori/`: Contains view files related to 'kategori' (category) functionality.
