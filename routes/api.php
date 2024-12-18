<?php
// routes/api.php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApplicantController;

// Define API routes here
Route::post('/save-applicant', [ApplicantController::class, 'saveapplicant']);
Route::get('/get-applicants', [ApplicantController::class, 'getapplicants']);
