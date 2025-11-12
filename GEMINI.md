# Gemini Code Assistant Context

## Project Overview

This is a web application built using the **CodeIgniter 3** framework for PHP. Based on the database models (`Model_guru`, `Model_murid`, `Model_kelas`, `Model_mapel`, `Model_absensi_guru`, `Model_sertifikat`), the application appears to be a **School Management System** for managing teachers, students, classes, subjects, attendance, and certificates.

The project uses a standard MVC (Model-View-Controller) architecture.

### Key Technologies

*   **Backend:** PHP 7.x, CodeIgniter 3
*   **Database:** MySQL (MariaDB)
*   **Frontend:** Bootstrap (via the SB Admin 2 template), JavaScript, CSS
*   **PHP Dependencies:**
    *   `dompdf/dompdf`: For generating PDF files from HTML content.
*   **Development:**
    *   `phpunit/phpunit`: For unit testing.

## Building and Running

This project runs on a standard PHP web server stack (like XAMPP, WAMP, or MAMP). There is no compilation or build step required for the main application.

### 1. Environment Setup

1.  **Web Server:** Ensure you have a local web server (e.g., Apache) with PHP (v5.6 or newer recommended) and a MySQL database server.
2.  **Project Files:** Place the project folder `cskod` inside your web server's document root (e.g., `C:\xampp\htdocs\`).
3.  **PHP Dependencies:** Install the required PHP libraries using Composer.
    ```bash
    composer install
    ```

### 2. Database Setup

1.  **Create Database:** Using a tool like phpMyAdmin, create a new MySQL database named `cskod`.
2.  **Import Schema:** The database connection is configured in `application/config/database.php` to use the `cskod` database with user `root` and no password.
    *   **TODO:** The database schema and initial data source are not present in the repository. You will need to find the `.sql` file and import it into the `c-skod` database.

### 3. Running the Application

1.  **Start Server:** Start your Apache and MySQL services via the XAMPP/WAMP control panel.
2.  **Access URL:** Open your web browser and navigate to:
    [http://localhost/cskod/](http://localhost/cskod/)

## Development Conventions

*   **Framework:** All development should follow CodeIgniter 3 conventions and best practices.
*   **Models:** Database interactions are handled by models located in `application/models/`.
*   **Views:** Frontend templates are located in `application/views/`. The main admin panel UI is based on the SB Admin 2 theme.
*   **Controllers:** Application logic resides in controllers found in `application/controllers/`.
*   **Frontend Assets:** All CSS, JavaScript, and image files are stored in the `assets/` directory and are managed manually (not via npm/yarn).
*   **Testing:** A test script is defined in `composer.json` (`"test:coverage"`), but it appears configured for a CI environment.
    *   **TODO:** Clarify the standard procedure for running unit tests in a local development environment.

    nah kemarin kita garap sampai yang tugas habis itu kita mau buat pengerjaan  │
│   tugas yang coding bukan yang upload file nah terus kamu kasih di database
    table tugas jadi ada type tugas coding atau bukan nah kalo gitu penilaiian   │
│   otomatis nya gimana nanti dinilai berdasarkan output dan nanti ada button    │
│   reset code tampilkan output terus kirim tugas terus di bagian pertemuan kan  │
│   ada materi dan tugas nah ditugas dikasih button kerjakan yang menuju         │
│   halaman pengerjaan masing masing contoh tugas coding ya kehalaman            │
│   pengerjaan coding . terus di bagian materi itu kan isi nya itu bukan         │
│   deskripsi materi ditugas tapi isi file materi contoh kalo vidio youtube ya   │
│   vidio youtube nya di tonton disitu kalo file pdf materi isi nya di baca      │
│   disitu jadi g perlu buka file nya tapi tetep di tampilin judul materi dan    │
│   deskripsinya
