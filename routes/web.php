<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApplicantController;

Route::get('/', function () {
    return view('welcome');
});


// Route::post('/save-applicant', [ApplicantController::class, 'saveapplicant']);
// Route::get('/get-applicants', [ApplicantController::class, 'getapplicants']);
