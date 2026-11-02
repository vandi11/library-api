<?php

use App\Http\Controllers\KonyvController;
use App\Http\Controllers\OlvasoController;
use Illuminate\Support\Facades\Route;

Route::get('olvasok/kolcsonzok', [OlvasoController::class, 'kolcsonzok']);
Route::get('olvasok/{olvaso}/konyvek', [OlvasoController::class, 'konyvek']);
Route::apiResource('olvasok', OlvasoController::class)->parameters(['olvasok' => 'olvaso']);

Route::get('konyvek/szabad', [KonyvController::class, 'szabad']);
Route::get('konyvek/kereses', [KonyvController::class, 'kereses']);
Route::apiResource('konyvek', KonyvController::class)->parameters(['konyvek' => 'konyv']);
