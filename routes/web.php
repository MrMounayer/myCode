<?php

use App\Http\Controllers\{FormController,RegistrationController};
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
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



Volt::route("/forms", 'forms')->middleware(['auth', 'verified'])->name('forms');

Route::view('/', 'welcome');

Route::post('/registration-request',[FormController::class,'create'])->name('registration-request');
Route::get('/registration-request',[FormController::class,'index'])->name('registration-resoponse');

Route::post('/registration',[RegistrationController::class,'create'])->name('registration');
Route::get('/registration',[RegistrationController::class,'index'])->name('registration');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Volt::route('/forms-editor/{form?}', 'form-manager')->middleware(['auth', 'verified'])->name('forms-editor');
Volt::route('/fields-editor/{formField?}', 'fields-editor')->middleware(['auth', 'verified'])->name('fields-editor');
// Volt::route('/user-registration', 'user-registration');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
