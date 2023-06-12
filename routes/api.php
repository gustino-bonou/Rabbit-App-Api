<?php

use App\Http\Controllers\Api\Adoption\AdoptionIndexController;
use App\Http\Controllers\Api\Rabbit\RabbitIndexController;
use App\Http\Controllers\Api\Pairing\PairingIndexController;
use App\Http\Controllers\Api\Weaning\WeaningIndexController;
use App\Http\Controllers\Api\Whelping\WhelpingIndexController;
use App\Http\Controllers\RabbitController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(static function(): void {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::prefix('rabbits')->as('rabbits.')->group(static function (): void {

    Route::get('/', RabbitIndexController::class)->name('rabbits.index');
    Route::get('/{rabbit}',[ RabbitController::class, 'show'])->name('rabbits.show');
    
    });
    Route::prefix('pairings')->as('pairings.')->group(static function (): void {

    Route::get('/', PairingIndexController::class)->name('pairings.index');

    });
    Route::prefix('weanings')->as('weanings.')->group(static function (): void {

    Route::get('/', WeaningIndexController::class)->name('weanings.index');

    });
    Route::prefix('whelpings')->as('whelpings.')->group(static function (): void {

    Route::get('/', WhelpingIndexController::class)->name('whelpings.index');

    });
    Route::prefix('adoptions')->as('adoptions.')->group(static function (): void {

    Route::get('/', AdoptionIndexController::class)->name('adoptions.index');

    });
});

