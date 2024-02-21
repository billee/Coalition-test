<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;

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

#task resource
Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
Route::post('/tasks/save', [TaskController::class, 'store'])->name('tasks.store');
Route::get('task/{id}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('task/{id}/update', [TaskController::class, 'update'])->name('tasks.update');
Route::delete('task/{id}/delete', [TaskController::class, 'destroy'])->name('tasks.delete');
Route::get('/tasks/{project_id?}', [TaskController::class, 'index'])->name('tasks.index');
Route::post('tasks/reorder', [TaskController::class, 'reorder']);



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
