# TLMS - Employee Management & Attendance System

## 📋 Project Overview

TLMS is a web-based Employee Management and Attendance System developed using Laravel. The application provides secure authentication and complete CRUD (Create, Read, Update, Delete) operations for managing employee records and attendance information. It helps organizations efficiently maintain employee data and track attendance through a user-friendly interface.

---

##  Features

### Authentication
- User Registration
- User Login & Logout
- Session Management

### Employee Management
- Add Employee
- View Employee Details
- Update Employee Information
- Delete Employee Records

### Attendance Management
- Mark Attendance
- View Attendance Records
- Track Employee Attendance History
- Manage Daily Attendance

### Dashboard
- Employee Statistics
- Attendance Overview
- Easy Navigation

---

##  Technologies Used

- Laravel
- PHP
- MySQL
- HTML5
- CSS3
- JavaScript
- Bootstrap
- Git & GitHub

---

##  Installation

### Clone the Repository

```bash
git clone https://github.com/SheezaFatima1001/TLMS_project.git
```

### Navigate to Project Directory

```bash
cd TLMS_project
```

### Install Dependencies

```bash
composer install
```

### Create Environment File

```bash
cp .env.example .env
```

### Generate Application Key

```bash
php artisan key:generate
```

### Configure Database

Update the following values in the `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=root
DB_PASSWORD=
```

### Run Migrations

```bash
php artisan migrate
```

### Start Development Server

```bash
php artisan serve
```

Visit:

```text
http://127.0.0.1:8000
```

---

##  Project Structure

```text
app/
bootstrap/
config/
database/
public/
resources/
routes/
storage/
tests/
```

---

##  Purpose

The purpose of this project is to provide a centralized platform for managing employee information and attendance records. It reduces manual record-keeping and improves organizational efficiency through a secure web application.

---

##  Author

**Sheeza Fatima**

Laravel-based Employee Management & Attendance System.
