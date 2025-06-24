<?php

use App\Http\Controllers\MascotasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource("/mascotas", MascotasController::class);
