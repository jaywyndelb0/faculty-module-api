<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::prefix('faculty')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/faculty', [FacultyController::class, 'index']);
    Route::post('/faculty', [FacultyController::class, 'store']);
    Route::get('/sections/{id}/faculty', [FacultyController::class, 'getSectionFaculty']);
    Route::post('/sections/{id}/assign-faculty', [FacultyController::class, 'assignToSection']);
    Route::get('/sections/{id}/classlist', [FacultyController::class, 'getClasslist']);

    Route::get('/grades', [FacultyController::class, 'indexGrades']);
    Route::post('/grades', [FacultyController::class, 'uploadGrade']);
    Route::get('/grades/{studentId}', [FacultyController::class, 'getStudentGrades']);
    Route::post('/attendance', [FacultyController::class, 'recordAttendance']);
    Route::get('/attendance/{studentId}', [FacultyController::class, 'getAttendance']);

    Route::apiResource('students', StudentController::class);
    Route::apiResource('sections', SectionController::class);
});
