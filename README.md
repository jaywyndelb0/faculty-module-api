# Faculty Module REST API

A complete Faculty Module REST API built with Laravel 12.x and MySQL (XAMPP), featuring staff authentication, student management, grading, and attendance tracking.

## 🚀 Getting Started

### Prerequisites
- **XAMPP** (with MySQL and PHP 8.2+)
- **Composer** installed

### Installation & Setup

1. **Clone/Open the Project**
   Ensure you are in the project root directory: `c:\Users\MARY GRACE\Desktop\faculty-api`

2. **Database Configuration**
   - Open XAMPP Control Panel and start **Apache** and **MySQL**.
   - Create a database named `school_system` in phpMyAdmin.
   - The `.env` file is already configured with:
     ```env
     DB_DATABASE=school_system
     DB_USERNAME=root
     DB_PASSWORD=
     ```

3. **Install Dependencies** (if not already done)
   ```bash
   composer install
   ```

4. **Run Migrations**
   This will create all necessary tables (users, faculty, students, sections, grades, attendance).
   ```bash
   php artisan migrate:fresh
   ```

5. **Start the Server**
   Run the following command to make the API accessible at `127.0.0.1:8000`:
   ```bash
   php artisan serve --host=127.0.0.1
   ```

---

## 🛠 Testing the API

### 1. Interactive Web Dashboard
You can test all API routes directly in your browser without Postman:
- URL: [http://127.0.0.1:8000/test-api](http://127.0.0.1:8000/test-api)
- **Note**: You must **Register** and **Login** in the dashboard first to unlock the protected modules.

### 2. Postman Instructions

#### **Staff Authentication (Public)**
- **Login**: `POST /api/login` (or `/api/faculty/login`)
  - Body (JSON): `{"email": "admin@school.edu", "password": "password123"}`
- **Register**: `POST /api/register` (or `/api/faculty/register`)
  - Body (JSON): `{"name": "Admin", "email": "admin@school.edu", "password": "password123", "password_confirmation": "password123"}`
  - *Copy the `access_token` from the response.*

#### **Faculty Management (Protected)**
- **Create Faculty**: `POST /api/faculty`
  - Header: `Authorization: Bearer <your_token>`
  - Body (JSON): `{"name": "John Doe", "email": "john@school.edu", "department": "Science"}`
- **List Faculty**: `GET /api/faculty`

#### **Grades & Attendance (Protected)**
- **Upload Grade**: `POST /api/grades`
  - Body (JSON): `{"student_id": 1, "subject": "Math", "grade": "A"}`
- **Record Attendance**: `POST /api/attendance`
  - Body (JSON): `{"student_id": 1, "date": "2026-03-06", "status": "present"}`

---

## 📂 Project Structure
- **Controllers**: `app/Http/Controllers/` (Faculty, Auth, Student, etc.)
- **Models**: `app/Models/` (Faculty, Student, Grade, etc.)
- **Routes**: `routes/api.php`
- **Migrations**: `database/migrations/`
- **Test UI**: `resources/views/test-api.blade.php`

## 🔐 Security
Authentication is handled via **Laravel Sanctum**. All management routes require a valid Bearer token obtained through the login endpoint.
