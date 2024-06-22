<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/students', [StudentController::class, 'index']);
Route::post('/students', [StudentController::class, 'register']);
Route::patch('/students/{id}', [StudentController::class, 'update']);

Route::get('/students/{id}/subjects', [SubjectController::class, 'indexSubject']);
Route::post('/students/{id}/subjects', [SubjectController::class, 'createSubject']);
Route::patch('/students/{id}/subjects/{subject_id}', [SubjectController::class, 'updateSubject']);