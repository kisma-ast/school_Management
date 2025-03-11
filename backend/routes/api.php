<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfesseurController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\EmploiDuTempsController;
use App\Http\Controllers\EtudiantController;

// Route::get('/professeurs', ProfesseurController::class);
Route::apiResource('professeurs', ProfesseurController::class);
Route::apiResource('cours', CoursController::class);
Route::apiResource('classes', ClasseController::class);
Route::apiResource('emplois_du_temps', EmploiDuTempsController::class);
Route::apiResource('etudiants', EtudiantController::class);
Route::post('login', [AuthController::class, 'login']);
