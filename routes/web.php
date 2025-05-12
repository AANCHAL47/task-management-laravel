<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Task\AdminTaskController;
use App\Http\Controllers\Task\UserTaskController;
use App\Http\Middleware\RoleMiddleware;
use App\Models\User;

app('router')->aliasMiddleware('role', RoleMiddleware::class);

// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::get('/', function () {
//         return view('welcome');
//     });
// });

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

// Route::get('/task',[AdminTaskController::class, 'index'])->name('task');
// Route::get('/create',[AdminTaskController::class, 'create'])->name('task.create');
// Route::post('/store',[AdminTaskController::class, 'store'])->name('task.store');
// Route::get('/edit/{id}',[AdminTaskController::class, 'edit'])->name('task.edit');
// Route::post('/update',[AdminTaskController::class, 'update'])->name('task.update');
// Route::post('/destroy/{id}',[AdminTaskController::class, 'destroy'])->name('task.destroy');


Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/task', [AdminTaskController::class, 'index'])->name('task');
    Route::get('/create', [AdminTaskController::class, 'create'])->name('task.create');
    Route::post('/store', [AdminTaskController::class, 'store'])->name('task.store');
    Route::get('/edit/{id}', [AdminTaskController::class, 'edit'])->name('task.edit');
    Route::post('/update', [AdminTaskController::class, 'update'])->name('task.update');
    Route::post('/destroy/{id}', [AdminTaskController::class, 'destroy'])->name('task.destroy');
});

Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/task', [UserTaskController::class, 'index'])->name('task');
    Route::get('/view/{id}', [UserTaskController::class, 'view'])->name('task.view');
    Route::post('/update/{id}', [UserTaskController::class, 'updateStatus'])->name('task.update.status');

});


require __DIR__.'/auth.php';

