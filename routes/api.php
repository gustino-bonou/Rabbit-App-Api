<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\LoginController;
use App\Http\Controllers\Api\User\LogoutController;
use App\Http\Controllers\Api\Rabbit\RabbitController;
use App\Http\Controllers\Api\Pairing\PairingController;
use App\Http\Controllers\Api\Weaning\WeaningController;
use App\Http\Controllers\Api\Adoption\AdoptionController;
use App\Http\Controllers\Api\Farm\RegisterFarmController;
use App\Http\Controllers\Api\User\RegistreUserController;
use App\Http\Controllers\Api\Whelping\WhelpingController;
use App\Http\Controllers\Api\Rabbit\RabbitIndexController;
use App\Http\Controllers\Api\Rabbit\StoreRabbitController;
use App\Http\Controllers\Api\Pairing\PairingIndexController;
use App\Http\Controllers\Api\Pairing\StorePairingController;
use App\Http\Controllers\Api\Weaning\StoreWeaningController;
use App\Http\Controllers\Api\Weaning\WeaningIndexController;
use App\Http\Controllers\Api\Adoption\AdoptionIndexController;
use App\Http\Controllers\Api\Adoption\StoreAdoptionController;
use App\Http\Controllers\Api\Rabbit\RabbitDetailController;
use App\Http\Controllers\Api\Whelping\NearbyWhelpingController;
use App\Http\Controllers\Api\Whelping\StoreWhelpingController;
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


Route::post('/register', RegistreUserController::class)
    ->middleware('guest')->name('user.register');

    
Route::post('/login', LoginController::class)->name('login')->middleware('guest');


Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {

        return response()->json(['user' => $request->user()]);

    })->name('user');

    Route::get('/logout', LogoutController::class)
        ->name('logout');

    Route::prefix('farms')->as('farms.')->group(static function (): void {
        $idRegex = '[0-9]+';
        $slugRegex = '[0-9a-zA-Z\-]+';

        Route::post('/store', RegisterFarmController::class)->name('store');
        
    });


    Route::prefix('rabbits')->as('rabbits.')->group(static function (): void {
    $idRegex = '[0-9]+';
    $slugRegex = '[0-9a-zA-Z\-]+';

        Route::get('/', RabbitIndexController::class)->name('index');
        Route::get('/{rabbit}', RabbitDetailController::class)->name('show')->where([
            'rabbit' => $idRegex
        ]);
        Route::post('/store', StoreRabbitController::class)->name('store');
        
        Route::get('/same/mother',[ RabbitController::class, 'getRabbitSameMother'])->name('same.mother');
        Route::get('/same/father',[ RabbitController::class, 'getRabbitSameFather'])->name('same.father');
        Route::get('/{rabbit}/parents',[ RabbitController::class, 'getRabbitParents'])->name('rabbit.parents');
        Route::get('/same/parents',[ RabbitController::class, 'getRabbitSameParents'])->name('same.parents');
        Route::get('/possible/pairing',[ RabbitController::class, 'compatibleRabbitsForPairing'])->name('compatible.for.pairing');
        Route::get('/females',[ RabbitController::class, 'femalesRabbits'])->name('females');
        Route::get('/males',[ RabbitController::class, 'malesRabbits'])->name('males');
   
    });

    Route::prefix('pairings')->as('pairings.')->group(static function (): void {
        $idRegex = '[0-9]+';
        $slugRegex = '[0-9a-zA-Z\-]+';
        
        Route::get('/', PairingIndexController::class)->name('pairings.index');

        Route::post('/store', StorePairingController::class)->name('store');

        Route::get('/old', NearbyWhelpingController::class)->name('old.pairing');

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
        Route::post('/store', StoreWeaningController::class)->name('store');
    });

    Route::prefix('whelpings')->as('whelpings.')->group(static function (): void {
        $idRegex = '[0-9]+';
        $slugRegex = '[0-9a-zA-Z\-]+';

        Route::get('/', WhelpingIndexController::class)->name('whelpings.index');
        Route::get('/{whelping}',[ WhelpingController::class, 'show'])->name('show')->where([
            'whelping' => $idRegex
        ]);
        Route::post('/store', StoreWhelpingController::class)->name('store');

    });

    Route::prefix('adoptions')->middleware('initialize.tenant')->as('adoptions.')->group(static function (): void {  
    $idRegex = '[0-9]+';
    $slugRegex = '[0-9a-zA-Z\-]+';

        Route::get('/', AdoptionIndexController::class)->name('adoptions.index');
        Route::get('/{adoption}',[ AdoptionController::class, 'show'])->name('show')->where([
            'adoption' => $idRegex
        ]);

        Route::post('/store', StoreAdoptionController::class)->name('store');

    });


});
