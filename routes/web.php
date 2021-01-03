<?php

use Illuminate\Support\Facades\Route;

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

Route::any('{catchall}', function () {
    return view('master');
})->where('catchall', '.*');

// Route::get('/{any}', function () {
//     return view('master');
// });
// Route::get('/{any}/{all}', function () {
//     return view('master');
// });
// Route::get('/', function () {
//     return view('master');
// });