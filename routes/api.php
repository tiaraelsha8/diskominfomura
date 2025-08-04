<?php

use App\Http\Controllers\Api\BeritaController;
use App\Http\Controllers\Api\PengumumanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

//berita
Route::apiResource('/berita', BeritaController::class);

//Pengumuman
Route::apiResource('/pengumuman', PengumumanController::class);
