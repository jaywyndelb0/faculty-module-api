<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public Auth Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::prefix('faculty')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

// Protected Routes
Route::middleware('auth:sanctum')->group(function () {
    // Auth profile/logout
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Faculty Management
    Route::get('/faculty', [FacultyController::class, 'index']);
    Route::post('/faculty', [FacultyController::class, 'store']);
    Route::get('/sections/{id}/faculty', [FacultyController::class, 'getSectionFaculty']);
    Route::post('/sections/{id}/assign-faculty', [FacultyController::class, 'assignToSection']);
    Route::get('/sections/{id}/classlist', [FacultyController::class, 'getClasslist']);

    // Grades & Attendance
    Route::get('/grades', [FacultyController::class, 'indexGrades']);
    Route::post('/grades', [FacultyController::class, 'uploadGrade']);
    Route::get('/grades/{studentId}', [FacultyController::class, 'getStudentGrades']);
    Route::post('/attendance', [FacultyController::class, 'recordAttendance']);
    Route::get('/attendance/{studentId}', [FacultyController::class, 'getAttendance']);

    // Student & Section Resources
    Route::apiResource('students', StudentController::class);
    Route::apiResource('sections', SectionController::class);
});
