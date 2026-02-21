<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FacultyController;

Route::apiResource('faculties', FacultyController::class);
