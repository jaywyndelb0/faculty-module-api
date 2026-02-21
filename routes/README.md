# Routes (Bisaya)

- Gigamit ang Laravel 12 bootstrap routing: [app.php](file:///c:/xampp/htdocs/swtagapi/bootstrap/app.php#L7-L14) para sa web, api, console, ug health.
- Gitangtang ang `apiPrefix` kay built-in na ang `/api` prefix sa Laravel.

## Web Routes
- File: [web.php](file:///c:/xampp/htdocs/swtagapi/routes/web.php)
- Tumong: Para lang sa UI pages.
- Nakadefine:
  - GET / → mobalik sa `welcome` view

## API Routes
- File: [api.php](file:///c:/xampp/htdocs/swtagapi/routes/api.php)
- Deklarasyon:
  - `Route::apiResource('faculties', FacultyController::class);`
- Lohikal nga mapping:
  - GET /api/faculties → lista sa tanang faculty
  - POST /api/faculties → himo og bag-ong faculty
  - GET /api/faculties/{id} → kuha og usa ka faculty
  - PUT/PATCH /api/faculties/{id} → update sa faculty
  - DELETE /api/faculties/{id} → tangtang sa faculty
- Nota:
  - Resource routes mobalik ug JSON by default.
  - Ang route parameter `{faculty}` pwede gamiton para sa implicit model binding.

## Health Route
- Path: `/up`
- Gigamit para sa basic uptime check sa app.
