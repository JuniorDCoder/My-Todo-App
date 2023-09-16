<?php

use App\Models\Task;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoriesController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    $tasks = Task::where('user_id', $user->id)->get();

    return view('dashboard', ['tasks' => $tasks]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // All tasks routes
    Route::get('/task/create', [TasksController::class, 'create'])->name('task.create');
    Route::get('/tasks/all', [TasksController::class, 'index'])->name('tasks.all');
    Route::post('/task/store', [TasksController::class, 'store'])->name('tasks.store');
    Route::get('/task/{task}', function(){
        $user = auth()->user();
        $tasks = Task::where('user_id', $user->id)->get();

        return view('dashboard', ['tasks' => $tasks]);
    });
    Route::patch('/task/{task}', [TasksController::class, 'updateStatus'])->name('tasks.updateStatus');
    Route::delete('/task/{task}',[TasksController::class, 'destroy'])->name('task.destroy');

    // All category routes
    Route::get('/category/create', [CategoriesController::class, 'create'])->name('categories.create');
    Route::post('/category/create', [CategoriesController::class, 'store'])->name('categories.store');
    Route::delete('/category/{category}', [CategoriesController::class, 'destroy'])->name('category.destroy');
});

require __DIR__.'/auth.php';
