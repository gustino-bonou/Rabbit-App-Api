<?php

use Carbon\Carbon;
use App\Models\User;
use App\Models\Rabbit;
use App\Models\Pairing;
use App\Models\Weaning;
use Nette\Utils\Random;
use App\Models\Adoption;
use App\Models\Farm;
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
    /* $rabbits = Rabbit::all();

    $datas = Adoption::all()->pluck('id')->toArray();
    foreach($rabbits as $rabbit )
    {
        $key = array_rand(Adoption::limit(20)->pluck('id')->toArray());
        $rabbit->adoption_id = null;

        $rabbit->save();
    } */

    
});

Route::get(
    'login',
    static fn() => User::firstOrFail()->createToken('auth_token')->plainTextToken,
)->name('login');
