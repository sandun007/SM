# Student Management System (SM) 🎓

A modern, responsive, and intuitive web application for managing student records, built with **Laravel 10**, **Bootstrap 5**, **JavaScript (Fetch API)**, and **SweetAlert2**.

![PHP](https://img.shields.io/badge/PHP-8.1%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-00618A?style=for-the-badge&logo=mysql&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)

---

## 📌 Table of Contents

- [Overview](#-overview)
- [Key Features](#-key-features)
- [Tech Stack](#-tech-stack)
- [System Architecture & Routes](#-system-architecture--routes)
- [Database Schema](#-database-schema)
- [Installation & Getting Started](#-installation--getting-started)
- [Directory Structure](#-directory-structure)
- [Screenshots & UI Workflow](#-screenshots--ui-workflow)
- [Author & Acknowledgements](#-author--acknowledgements)
- [License](#-license)

---

## 📖 Overview

The **Student Management System (SM)** provides administrative staff and educators with an effortless, single-dashboard interface to create, browse, view, update, and delete student profiles. 

Rather than redirecting users across separate pages for each operation, the application leverages **Bootstrap modals**, **asynchronous AJAX calls via JavaScript Fetch API**, and **SweetAlert2 interactive dialogs** to provide a seamless Single-Page Application (SPA)-like experience.

---

## ✨ Key Features

- **⚡ Modal-Based Student Registration**:
  - Add new students directly from the dashboard via a clean modal popup.
- **🔄 Asynchronous Live Edit & Update**:
  - Dynamically fetches student edit forms into a modal via AJAX.
  - Submits updates asynchronously with JSON validation feedback and auto-refresh upon success.
- **👁️ Student Profile Preview**:
  - Quick-view modal showcasing student details, initial avatar, contact info, and enrolled course.
- **🗑️ Safe & Interactive Deletion**:
  - SweetAlert2 prompt to confirm deletion before removing a student.
  - Deletes the record asynchronously via HTTP `DELETE` and dynamically removes the row from the table without full page reload.
  - Displays instant toast notification upon successful deletion.
- **🔍 Client-Side Instant Search**:
  - Real-time search filtering on the table as you type (matches name, email, age, or course).
- **🛡️ Server-Side Validation**:
  - Validates input fields (e.g. required name, unique email exception for existing records, age bounds).

---

## 🛠️ Tech Stack

- **Backend**:
  - [PHP 8.1+](https://www.php.net/)
  - [Laravel 10.x](https://laravel.com/) (MVC Architecture & Eloquent ORM)
- **Frontend**:
  - [Blade Templating Engine](https://laravel.com/docs/10.x/blade)
  - [Bootstrap 5](https://getbootstrap.com/) (Responsive UI & Modals)
  - [SweetAlert2](https://sweetalert2.github.io/) (Alerts, confirmations & toasts)
  - Vanilla JavaScript (Fetch API, DOM manipulation)
- **Database**:
  - MySQL / MariaDB (Supports SQLite / PostgreSQL via Laravel database drivers)
- **Package Management**:
  - [Composer](https://getcomposer.org/)

---

## 🛣️ System Architecture & Routes

All routes are handled through the `AdminController`:

| Method | URI | Action | Description |
| :--- | :--- | :--- | :--- |
| `GET` | `/` or `/list` | `AdminController@list` | Renders main dashboard listing all students |
| `POST` | `/list` | `AdminController@store` | Stores a newly registered student |
| `GET` | `/view-form/{id}` | `AdminController@viewForm` | Returns partial view with student profile card |
| `GET` | `/update-form/{id}` | `AdminController@editForm` | Returns edit form partial loaded dynamically into the modal |
| `POST` | `/update` | `AdminController@update` | Validates and updates student record (returns JSON response) |
| `DELETE` | `/list/{id}` | `AdminController@delete` | Deletes a student record (returns JSON response) |

---

## 🗄️ Database Schema

### `students` Table

| Column | Type | Constraints / Attributes | Description |
| :--- | :--- | :--- | :--- |
| `id` | `BIGINT UNSIGNED` | `PRIMARY KEY`, `AUTO_INCREMENT` | Unique identifier |
| `name` | `VARCHAR(255)` | `NOT NULL` | Full name of the student |
| `email` | `VARCHAR(255)` | `UNIQUE`, `NOT NULL` | Student email address |
| `age` | `INTEGER` | `NOT NULL` | Student age |
| `course` | `VARCHAR(255)` | `NOT NULL` | Enrolled course / department |
| `created_at` | `TIMESTAMP` | `NULLABLE` | Record creation timestamp |
| `updated_at` | `TIMESTAMP` | `NULLABLE` | Record last update timestamp |

---

## 🚀 Installation & Getting Started

Follow these step-by-step instructions to set up the project locally:

### 1. Prerequisites
Ensure you have the following installed on your machine:
- **PHP** >= 8.1
- **Composer** (Latest version)
- **MySQL** / MariaDB (e.g. via XAMPP, WampServer, or native installation)
- **Git**

### 2. Clone the Repository
```bash
git clone https://github.com/Sandun007/SM.git
cd SM
```

### 3. Install PHP Dependencies
```bash
composer install
```

### 4. Configure Environment Variables
Copy the `.env.example` file to create your `.env` configuration:
```bash
cp .env.example .env
```
*(On Windows PowerShell, use `copy .env.example .env`)*

Open `.env` in your editor and configure your database settings:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sm_database
DB_USERNAME=root
DB_PASSWORD=
```
> **Note**: Make sure to create the database in MySQL (e.g. `sm_database`) before running migrations.

### 5. Generate Application Key
```bash
php artisan key:generate
```

### 6. Run Database Migrations
```bash
php artisan migrate
```

### 7. Run the Application
Start the Laravel local development server:
```bash
php artisan serve
```

Access the application in your web browser at:
```
http://127.0.0.1:8000
```

---

## 📁 Directory Structure

```text
SM/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── AdminController.php      # Main controller handling CRUD operations
│   └── Models/
│       └── Student.php                  # Student Eloquent model ($fillable defined)
├── database/
│   └── migrations/
│       └── 2025_11_14_021340_create_students_table.php
├── public/
│   └── assets/                          # Bootstrap CSS and JS bundles
├── resources/
│   └── views/
│       ├── component/
│       │   └── navbar.blade.php         # Top navigation bar
│       ├── partials/
│       │   └── view-student.blade.php   # Student detail profile modal
│       ├── list.blade.php               # Main dashboard with table & modals
│       ├── register.blade.php           # Registration form component
│       └── update.blade.php             # Edit form loaded via AJAX
├── routes/
│   └── web.php                          # Web route definitions
├── .env.example
├── composer.json
└── README.md
```

---

## 👤 Author

Developed by **Sandun007**
- **GitHub**: [@Sandun007](https://github.com/Sandun007)
- **Email**: sandungithub007@gmail.com

---

## 📄 License

This project is open-sourced software licensed under the [MIT License](LICENSE).
