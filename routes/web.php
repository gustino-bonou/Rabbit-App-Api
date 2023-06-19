<?php

use Carbon\Carbon;
use App\Models\Farm;
use App\Models\User;
use App\Models\Rabbit;
use App\Models\Pairing;
use App\Models\Weaning;
use Nette\Utils\Random;
use App\Models\Adoption;
use App\Models\Whelping;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\LoginController;

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

require __DIR__.'/api.php';