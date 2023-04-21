<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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


Route::get('/', [\App\Http\Controllers\WebsiteController::class, 'index'])->name('home');
Route::get('jobs', [\App\Http\Controllers\WebsiteController::class, 'jobs'])->name('jobs');
Route::get('about', [\App\Http\Controllers\WebsiteController::class, 'about'])->name('about');
Route::get('contact', [\App\Http\Controllers\WebsiteController::class, 'contact'])->name('contact');
Route::get('privacy-policy', [\App\Http\Controllers\WebsiteController::class, 'privacyPolicy'])->name('privacy-policy');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
