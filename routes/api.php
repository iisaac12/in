<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventarisController;

Route::get('/inventaris', [InventarisController::class , 'index']);
Route::get('/inventaris/{id}', [InventarisController::class , 'show']);
Route::post('/inventaris', [InventarisController::class , 'store']);
Route::put('/inventaris/{id}', [InventarisController::class , 'update']);
Route::patch('/inventaris/{id}', [InventarisController::class , 'update']);
Route::delete('/inventaris/{id}', [InventarisController::class , 'destroy']);
