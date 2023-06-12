<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Rabbit\RabbitController;
use App\Http\Controllers\Api\Adoption\AdoptionController;
use App\Http\Controllers\Api\Rabbit\RabbitIndexController;
use App\Http\Controllers\Api\Pairing\PairingIndexController;
use App\Http\Controllers\Api\Weaning\WeaningIndexController;
use App\Http\Controllers\Api\Adoption\AdoptionIndexController;
use App\Http\Controllers\Api\Pairing\PairingController;
use App\Http\Controllers\Api\User\RegistreUserController;
use App\Http\Controllers\Api\Weaning\WeaningController;
use App\Http\Controllers\Api\Whelping\WhelpingController;
use App\Http\Controllers\Api\Whelping\WhelpingIndexController;

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



Route::post('register-user', RegistreUserController::class)->name('user.register');
Route::middleware('auth:sanctum')->group(static function(): void {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::prefix('rabbits')->as('rabbits.')->group(static function (): void {
    $idRegex = '[0-9]+';
    $slugRegex = '[0-9a-zA-Z\-]+';

    Route::get('/', RabbitIndexController::class)->name('rabbits.index');
    Route::get('/{rabbit}',[ RabbitController::class, 'show'])->name('show')->where([
        'rabbit' => $idRegex
    ]);
    
    });
    Route::prefix('pairings')->as('pairings.')->group(static function (): void {
        $idRegex = '[0-9]+';
        $slugRegex = '[0-9a-zA-Z\-]+';

    Route::get('/', PairingIndexController::class)->name('pairings.index');
    Route::get('/{pairing}',[ PairingController::class, 'show'])->name('show')->where([
        'pairing' => $idRegex
    ]);
    });

    Route::prefix('weanings')->as('weanings.')->group(static function (): void {
        $idRegex = '[0-9]+';
        $slugRegex = '[0-9a-zA-Z\-]+';

    Route::get('/', WeaningIndexController::class)->name('weanings.index');
    Route::get('/{weaning}',[ WeaningController::class, 'show'])->name('show')->where([
        'weaning' => $idRegex
    ]);
    });

    Route::prefix('whelpings')->as('whelpings.')->group(static function (): void {
        $idRegex = '[0-9]+';
        $slugRegex = '[0-9a-zA-Z\-]+';

    Route::get('/', WhelpingIndexController::class)->name('whelpings.index');
    Route::get('/{whelping}',[ WhelpingController::class, 'show'])->name('show')->where([
        'whelping' => $idRegex
    ]);

    });
    Route::prefix('adoptions')->as('adoptions.')->group(static function (): void {  
    $idRegex = '[0-9]+';
    $slugRegex = '[0-9a-zA-Z\-]+';

    Route::get('/', AdoptionIndexController::class)->name('adoptions.index');
    Route::get('/{adoption}',[ AdoptionController::class, 'show'])->name('show')->where([
        'adoption' => $idRegex
    ]);

    });
});

