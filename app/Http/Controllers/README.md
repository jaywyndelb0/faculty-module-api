# Controllers (Bisaya)

- Tumong: Ang controllers mao’y nagdumala sa REST logic sa API.
- Namespace: App\Http\Controllers\Api (alang sa API controllers).
- Model gigamit: [Faculty](file:///c:/xampp/htdocs/swtagapi/app/Models/Faculty.php) nga naay fillable `name`.
- File sa controller: [Api/FacultyController.php](file:///c:/xampp/htdocs/swtagapi/app/Http/Controllers/Api/FacultyController.php)

## Mga Aksyon sa FacultyController
- index() → mokuha sa tanang faculties (Faculty::all())
- store(Request) → mo-validate `{ name }`, mohimo og bag-ong record, mobalik 201 JSON
- show($id) → mokuha og usa ka record, kung wala mobalik 404
- update(Request, $id) → mo-validate `{ name }` kung naa, mo-update sa record, mobalik 200 JSON
- destroy($id) → mo-delete sa record, mobalik 204 No Content

## Validation ug Status Codes
- name: required, string, max:255
- Status codes:
  - 200 → OK (read/update)
  - 201 → Created (store)
  - 204 → No Content (delete)
  - 404 → Not Found (wala’y record)

## Seed Data
- Ang seeder nagbutang og usa ka faculty: “Jay Wyndel Bagsic”
- Tan-awa: [DatabaseSeeder.php](file:///c:/xampp/htdocs/swtagapi/database/seeders/DatabaseSeeder.php)
