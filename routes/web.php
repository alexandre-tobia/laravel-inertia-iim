<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/blog', [\App\Http\Controllers\BlogController::class, 'index'])->name('blog.index');

    Route::get('/blog/create', [\App\Http\Controllers\BlogController::class, 'create'])->name('blog.create');

    Route::post('/blog', [\App\Http\Controllers\BlogController::class, 'store'])->name('blog.store');

    Route::put('/blog/{slug}', [\App\Http\Controllers\BlogController::class, 'update'])->name('blog.update');

    Route::delete('/blog/{slug}', [\App\Http\Controllers\BlogController::class, 'delete'])->name('blog.delete');

    Route::get('/blog/{slug}/edit', [\App\Http\Controllers\BlogController::class, 'edit'])->name('blog.edit');

    Route::post('/blog/{id}/toggle', [\App\Http\Controllers\BlogController::class, 'toggle'])->name('blog.toggle');

    Route::post('/users', function(\Illuminate\Http\Request $request) {
        $request->validate([
           'firstname' => 'required'
        ]);
    })->name('user.create');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
