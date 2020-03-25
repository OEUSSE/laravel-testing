<?php

use Illuminate\Support\Facades\Route;

use App\Jobs\ProcessSomething;
use App\Jobs\ShouldFiledJob;
use App\Jobs\ProcessDB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('prueba', function () {
    ProcessSomething::withChain([
        new ShouldFiledJob,
        new ProcessDB
    ])->dispatch()->onQueue('processing');
});
