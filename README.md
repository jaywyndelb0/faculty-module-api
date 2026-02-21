<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Routes

### Overview
This project uses Laravel 12’s bootstrap configuration to wire web and API routes. Web routes serve the UI, while API routes provide REST endpoints for your data. The current API focuses on a simplified Faculty resource with one field: `name`.

### Bootstrap Routing
- Configuration file: [bootstrap/app.php](file:///c:/xampp/htdocs/swtagapi/bootstrap/app.php#L7-L14)
- What it does:
  - Loads web routes from [routes/web.php](file:///c:/xampp/htdocs/swtagapi/routes/web.php)
  - Loads API routes from [routes/api.php](file:///c:/xampp/htdocs/swtagapi/routes/api.php)
  - Loads console routes from [routes/console.php](file:///c:/xampp/htdocs/swtagapi/routes/console.php)
  - Registers a health endpoint at `/up`
- Note: The redundant `apiPrefix: 'api'` option was removed to prevent conflicts; Laravel automatically prefixes API routes with `/api`.

### Web Routes
- File: [routes/web.php](file:///c:/xampp/htdocs/swtagapi/routes/web.php)
- Routes:
  - `GET /` → returns the `welcome` view
- Purpose:
  - Only UI routes belong here; API routes are defined in `routes/api.php`.

### API Routes
- File: [routes/api.php](file:///c:/xampp/htdocs/swtagapi/routes/api.php)
- Routes:
  - `Route::apiResource('faculties', FacultyController::class);`
- Generated endpoints:
  - `GET    /api/faculties` → list all faculties
  - `POST   /api/faculties` → create a faculty
  - `GET    /api/faculties/{id}` → show one faculty
  - `PUT    /api/faculties/{id}` or `PATCH /api/faculties/{id}` → update a faculty
  - `DELETE /api/faculties/{id}` → delete a faculty

## Controllers
- File: [app/Http/Controllers/Api/FacultyController.php](file:///c:/xampp/htdocs/swtagapi/app/Http/Controllers/Api/FacultyController.php)
- Key actions:
  - `index()` → returns all records (`Faculty::all()`)
  - `store(Request $request)` → validates `{ name }`, creates a record, returns 201 JSON
  - `show(string $id)` → returns a single record or 404 if not found
  - `update(Request $request, string $id)` → validates `{ name }` when present, updates the record
  - `destroy(string $id)` → deletes the record, returns 204 No Content

### Faculty Model
- File: [app/Models/Faculty.php](file:///c:/xampp/htdocs/swtagapi/app/Models/Faculty.php)
- Fields:
  - `name` (fillable)
- Notes:
  - Uses `HasFactory` for consistency
  - Column `code` was dropped to simplify the resource

### Database Setup
- Migrations:
  - Initial table: [2026_02_21_030937_create_faculties_table.php](file:///c:/xampp/htdocs/swtagapi/database/migrations/2026_02_21_030937_create_faculties_table.php)
  - Added fields: [2026_02_21_041000_add_fields_to_faculties_table.php](file:///c:/xampp/htdocs/swtagapi/database/migrations/2026_02_21_041000_add_fields_to_faculties_table.php)
  - Simplification (drop `code`): [2026_02_21_050300_drop_code_from_faculties_table.php](file:///c:/xampp/htdocs/swtagapi/database/migrations/2026_02_21_050300_drop_code_from_faculties_table.php)
- Seeder:
  - File: [database/seeders/DatabaseSeeder.php](file:///c:/xampp/htdocs/swtagapi/database/seeders/DatabaseSeeder.php)
  - Behavior:
    - Ensures the test user does not duplicate via `updateOrCreate`.
    - Clears `faculties` and inserts a single record with `name = "Jay Wyndel Bagsic"`.

### Quick Test
- List faculties:
  - `GET http://127.0.0.1:8000/api/faculties`
- Create faculty:
  - `POST http://127.0.0.1:8000/api/faculties`
  - Body: `{ "name": "Jay Wyndel Bagsic" }`
- Update faculty:
  - `PATCH http://127.0.0.1:8000/api/faculties/1`
  - Body: `{ "name": "New Name" }`
- Delete faculty:
  - `DELETE http://127.0.0.1:8000/api/faculties/1`
