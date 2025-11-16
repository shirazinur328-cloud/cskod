# QWEN Project Context

## Project Overview

This is a **CodeIgniter 3 web application** designed as an educational management system. The application manages students (murid), teachers (guru), classes, subjects, assignments, materials, and attendance tracking. It provides separate interfaces for administrators, teachers, and students.

## Architecture

- **Framework**: CodeIgniter 3 (PHP MVC framework)
- **Database**: MySQL/MariaDB with InnoDB tables
- **Directory Structure**:
  - `application/` - Core application code (controllers, models, views)
  - `system/` - CodeIgniter core framework files
  - `assets/` - CSS, JavaScript, and image files (not yet explored)
  - `uploads/` - File upload storage

## Database Configuration

- **Database**: `cskod` (as seen in database.php config)
- **Driver**: MySQLi
- **Host**: localhost
- **Username**: root
- **Default Character Set**: UTF-8
- **Connection**: Standard MySQLi connection

## Routing

The application uses custom routing defined in `application/config/routes.php`:

- **Default route**: `admin/dashboard` (handles the homepage)
- **Admin routes**: Any route starting with `admin/` is directed to the Admin controller directory
- **Student routes**: `murid/` routes are handled by the Murid controller directory
- **Subject detail route**: `mapel/{id}` routes to student dashboard subject details

## Key Features

Based on the database schema:

1. **User Management**:
   - Students (murid)
   - Teachers (guru) 
   - Admin users

2. **Class Management**:
   - Class assignments (kelas)
   - Student-class relationships (murid_kelas)

3. **Subject Management**:
   - Subjects (mapel) with descriptions
   - Subject-teacher assignments

4. **Learning Materials**:
   - Study materials (materi) with file attachments
   - Meeting-based organization (pertemuan)

5. **Assignments**:
   - Tasks (tugas) with deadlines
   - Student submissions (submission)
   - Assignment tracking (tugas_murid)

6. **Grades**:
   - Grade tracking (nilai) system

7. **Attendance**:
   - Teacher attendance tracking (absensi_guru)

8. **Certificates**:
   - Certificate generation (sertifikat) and tracking (sertifikat_murid)

9. **Notifications**:
   - Student notification system (notifikasi)

## Controllers Structure

- **Admin/** - Administrative functionality
- **Guru/** - Teacher-specific controllers
- **Murid/** - Student-specific controllers
- **Migrate.php** - Database migration functionality
- **Welcome.php** - Default welcome controller (likely unused due to custom routing)

## Environment and Configuration

- **Environment**: Set to 'development' by default (in index.php)
- **Base URL**: http://localhost/cskod/ (in config.php)
- **URL Rewriting**: Clean URLs enabled (index_page set to '' in config.php)
- **CSRF Protection**: Currently disabled (config.php)
- **Session Management**: Files-based sessions (config.php)

## Dependencies

- **PHP**: ≥5.3.7 (as specified in composer.json, though 5.6+ recommended)
- **DOMPDF**: For PDF generation (mentioned in composer.json)
- **XAMPP**: Local development environment indicated by directory structure

## Special Files

- **cskod(1).sql**: Complete database schema with sample data
- **temp_update_tugas.php**: Appears to be a temporary file for updating assignments
- **sample_data_correct_schema.sql**: Additional sample data schema file
- **sql tambahan.txt**: Additional SQL queries

## Development Notes

- The application uses Composer for dependency management (DOMPDF)
- Migration system is implemented (migrations table in database)
- File uploads are supported (uploads/ directory exists)
- The application supports multiple file types (PDF, video, images) for learning materials
- Routes have been modified to direct 'admin' users to the admin dashboard by default
- Development environment shows all errors (as per index.php error reporting settings)