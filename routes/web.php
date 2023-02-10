<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PlanController;
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

// user dashbpard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// blog API
Route::resource('posts', PostController::class)->only(['index', 'store', 'edit', 'update', 'destroy'])->middleware(['auth', 'verified']);

// user profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// membership plan
Route::middleware('auth')->group(function () {
    Route::get('plans', [PlanController::class, 'index'])->name('membership.plan');
    Route::get('plans/{plan}', [PlanController::class, 'show'])->name('membership.show');
    Route::post('subscription', [PlanController::class, 'subscription'])->name('subscription.create');
});

require __DIR__.'/auth.php';
