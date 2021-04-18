<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\ContributorsController;
use App\Http\Controllers\LiveSearch;
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
    return view('home');
})->name('home');

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/entreprises', [CompaniesController::class, 'index'])->name('entreprises');
Route::get('/entreprises/action', [CompaniesController::class, 'action'])->name('entreprises.action');
Route::get('/entreprises/create', [CompaniesController::class, 'register'])->name('entreprises.create');
Route::post('/entreprises/create', [CompaniesController::class, 'add']);
Route::get('/entreprises/{id}', [CompaniesController::class, 'show'])->name('entreprise.show');
Route::get('/entreprises/update/{id}', [CompaniesController::class, 'update'])->name('entreprise.update');
Route::post('/entreprises/update', [CompaniesController::class, 'updateCompany'])->name('entreprise.updateCompany');
Route::delete('/entreprise/delete/{id}', [CompaniesController::class, 'destroy'])->name('entreprise.destroy');

Route::get('/collaborateurs', [ContributorsController::class, 'index'])->name('collaborateurs');
Route::get('/collaborateurs/action', [ContributorsController::class, 'action'])->name('collaborateurs.action');
Route::get('/collaborateurs/create', [ContributorsController::class, 'register'])->name('collaborateurs.create');
Route::post('/collaborateurs/create', [ContributorsController::class, 'add']);
Route::get('/collaborateurs/{id}', [ContributorsController::class, 'show'])->name('collaborateur.show');
Route::get('/collaborateurs/update/{id}', [ContributorsController::class, 'update'])->name('collaborateur.update');
Route::post('/collaborateurs/update', [ContributorsController::class, 'updateContributor'])->name('collaborateur.updateContributor');
Route::delete('/collaborateur/delete/{id}', [ContributorsController::class, 'destroy'])->name('collaborateur.destroy');
