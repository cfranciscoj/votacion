<?php

use Illuminate\Support\Facades\Route;
//use App\Models\Users as Users;

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
})->name('welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/votado', [App\Http\Controllers\votos\VotosController::class, 'recolecta'])->name('votado');


Route::get('/restpass', [App\Http\Controllers\Profile\ProfileController::class, 'restpass'])->name('resetpass');
Route::get('/admin', [App\Http\Controllers\Administrador\AdminController::class, 'admin'] )->name('admin');
Route::get('/gestor', [App\Http\Controllers\Administrador\AdminController::class, 'gestor'] )->name('gestor');
Route::post('/traevotos', [App\Http\Controllers\Administrador\AdminController::class, 'traevotos'] )->name('traevotos');



Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [App\Http\Controllers\Administrador\AdminController::class, 'index'] )->name('dashboard');

/*
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
  return view('dashboard');
})->name('dashboard');
*/
