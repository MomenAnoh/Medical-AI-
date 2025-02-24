<?php

use App\Http\Controllers\Api\AuthController;

use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\API\Medical_historyController;
use App\Http\Controllers\Api\PatientsController;

use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\ResponseController;
use App\Http\Controllers\Api\XRayController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('profile', [AuthController::class, 'profile']);
    Route::apiResource('patients',PatientsController::class);
    Route::apiResource('doctors',DoctorController::class);
    Route::apiResource('medical_histories',Medical_historyController::class);
    Route::get('medical_histories_of_patient',[Medical_historyController::class,'show']);// لازم تتدخل اليوزر  id
    Route::get('X-Ray_of_patient',[XRayController::class,'show']);// لازم تتدخل اليوزر id
    Route::get('Unique_XRay',[XRayController::class,'Unique_XRay']);// لازم تتدخل id بتاع ال xray
    Route::apiResource('XRay',XRayController::class);
    Route::apiResource('questions', QuestionController::class);// هتدخل (doctor_id(user_id),patient_id(user_id),response_text)
    Route::apiResource('responses', ResponseController::class);// هتدخل (doctor_id(user_id),question_id,response_text)
    Route::get('showquestions', [QuestionController::class, 'getPatientDoctorQuestions']);// هتدخل ال (doctor_id,patient_id)
    Route::get('showanswers', [ResponseController::class, 'getResoureformdoctor']);// هتدخل ال (doctor_id,patient_id)
});
