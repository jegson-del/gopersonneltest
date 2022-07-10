<?php

use App\Http\Controllers\ContactController;
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

Route::get('/', function () {
    return view('welcome');
});
// single fetch contact route added to resource controller
Route::get('fetch-contacts', [ContactController::class, 'fetchcontact']);
//search route
Route::get('search', [ContactController::class, 'search']);
//using  a resource route for contacts
Route::resource('contacts', ContactController::class);
