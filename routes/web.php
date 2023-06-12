<?php

use App\Models\User;
use App\Models\Rabbit;
use App\Models\Weaning;
use Nette\Utils\Random;
use App\Models\Adoption;
use App\Models\Pairing;
use App\Models\Whelping;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* Route::get('/', function () {
    return view('welcome');
}); */
Route::get('/', function () {
    $rabbits = Adoption::all();
    foreach($rabbits as $rabbit) {
        $rabbit->farm()->associate(User::all()->first()->farms()->first());

        $rabbit->save();
    }

    dd('ok');
});

Route::get(
    'login',
    static fn() => User::firstOrFail()->createToken('auth_token')->plainTextToken,
)->name('login');
