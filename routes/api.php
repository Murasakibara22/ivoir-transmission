<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('webhook/ivoire-transmission', [PaymentController::class, 'webhookFunc']);
Route::post('webhook/ivoire-transmission', [PaymentController::class, 'webhookFunc']);
