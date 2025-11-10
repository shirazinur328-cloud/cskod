# QWEN.md - CodeIgniter School Management System

## Project Overview

This is a **School Management System** built using the **CodeIgniter 3** framework for PHP. Based on the existing code structure, database schema information, and configuration files, this application manages teachers, students, classes, subjects, attendance, and certificates. The project follows the traditional MVC (Model-View-Controller) architecture of CodeIgniter.

The system includes:
- User management for teachers and students
- Class and subject management
- Attendance tracking for teachers
- Assignment and material distribution
- Grade management
- Certificate generation and distribution
- Student enrollment in classes and subjects

### Key Technologies

- **Backend:** PHP 7.x, CodeIgniter 3
- **Database:** MySQL (MariaDB)
- **Frontend:** Bootstrap (based on SB Admin 2 template), JavaScript, CSS
- **PDF Generation:** dompdf/dompdf library for generating PDF certificates and reports
- **Development:** Composer for dependency management, PHPUnit for testing

## Project Structure

```
cskod/
├── application/          # CodeIgniter application directory
│   ├── config/          # Configuration files
│   ├── controllers/     # Application controllers
│   │   ├── Admin/       # Admin-specific controllers
│   │   └── murid/       # Student-specific controllers
│   ├── models/          # Data models
│   ├── views/           # Frontend templates
│   │   ├── admin/       # Admin panel views
│   │   ├── murid/       # Student panel views
│   │   └── templates/   # Template components
│   ├── libraries/       # Custom libraries
│   ├── helpers/         # Helper functions
│   └── ...              # Other CodeIgniter directories
├── assets/              # Frontend assets (CSS, JS, images)
├── system/              # CodeIgniter core framework
├── composer.json        # PHP dependencies
├── index.php            # Main entry point
└── ...                  # Other files
```

## Database Schema

The system uses a MySQL database named `cskod` with the following tables:

1. **guru** - Teacher information (id_guru, nama_guru, email, no_telp, username, password, status)
2. **murid** - Student information (id_murid, nama_murid, email, no_telp, username, password, status)
3. **kelas** - Class information (id_kelas, nama_kelas, tahun_ajaran, id_guru_wali)
4. **mapel** - Subject information (id_mapel, nama_mapel, deskripsi, id_guru, status_aktif)
5. **pertemuan** - Session/meeting information (id_pertemuan, nama_pertemuan, tanggal, id_mapel)
6. **materi** - Learning materials (id_materi, judul_materi, deskripsi, file_materi, id_pertemuan)
7. **tugas** - Assignments (id_tugas, judul_tugas, deskripsi, deadline, id_mapel, id_pertemuan)
8. **submission** - Assignment submissions (id_submission, id_tugas, id_murid, file_submission, tanggal_kirim, status)
9. **nilai** - Grades/evaluations (id_nilai, id_mapel, id_murid, id_submission, nilai, tanggal_nilai)
10. **absensi_guru** - Teacher attendance (id_absensi, id_guru, status, tanggal, keterangan)
11. **sertifikat** - Certificate templates (id_sertifikat, id_mapel, nama_sertifikat, tanggal_diterbitkan, template_file)
12. **sertifikat_murid** - Certificate assignments to students (id_sertifikat_murid, id_sertifikat, id_murid, tanggal_dikeluarkan, status_validasi)
13. **murid_kelas** - Student-class relationships (id, id_murid, id_kelas)
14. **murid_mapel** - Student-subject relationships (id, id_murid, id_mapel)

## Building and Running

This project runs on a standard PHP web server stack (like XAMPP, WAMP, or MAMP). There is no compilation or build step required for the main application.

### 1. Environment Setup

1. **Web Server:** Ensure you have a local web server (e.g., Apache) with PHP (v5.6 or newer recommended) and a MySQL database server.
2. **Project Files:** Place the project folder `cskod` inside your web server's document root (e.g., `C:\xampp\htdocs\`).
3. **PHP Dependencies:** Install the required PHP libraries using Composer.
   ```bash
   composer install
   ```

### 2. Database Setup

1. **Create Database:** Using a tool like phpMyAdmin, create a new MySQL database named `cskod`.
2. **Import Schema:** Import the database schema found in `sql tambahan.txt` into the `cskod` database.
3. **Configure Connection:** The database connection is configured in `application/config/database.php` to use the `cskod` database with user `root` and no password by default.

### 3. Running the Application

1. **Start Server:** Start your Apache and MySQL services via the XAMPP/WAMP control panel.
2. **Access URL:** Open your web browser and navigate to:
   [http://localhost/cskod/](http://localhost/cskod/)

## Development Conventions

- **Framework:** All development should follow CodeIgniter 3 conventions and best practices.
- **Models:** Database interactions are handled by models located in `application/models/`.
- **Views:** Frontend templates are located in `application/views/`. The main admin panel UI is based on the SB Admin 2 theme.
- **Controllers:** Application logic resides in controllers found in `application/controllers/`.
- **Frontend Assets:** All CSS, JavaScript, and image files are stored in the `assets/` directory.
- **Testing:** A test script is defined in `composer.json` (`"test:coverage"`), but it appears configured for a CI environment.

## Key Features

- **User Authentication:** Secure login system for teachers and students
- **Attendance Management:** Track teacher attendance with status options (Hadir, Sakit, Izin, Alpa)
- **Academic Management:** Manage classes, subjects, materials, and assignments
- **Grade Tracking:** Record and track student grades for various assignments
- **Certificate Generation:** Create and distribute certificates to students using PDF generation
- **Responsive UI:** Admin panel based on SB Admin 2 template with mobile-friendly interface

## Special Configuration Notes

- The system uses the dompdf library for generating PDF certificates and reports
- Default credentials and configuration settings are in the config files
- The application has different environment configurations (development, testing, production)
- Custom routing can be configured in `application/config/routes.php`