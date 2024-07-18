<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\DailyTaskController;
use Illuminate\Support\Facades\Route;

Route::get('/w', function () {
    return view('welcome');
});
Route::get('/iU', function () {
    return view('insertUserName');
}) -> name('insertUserName');

Route::get('/', function () {
    return view('index');
});

Route::get('/front', function () {
    return view('htmltesting');
});
Route::get('/bs', function () {
    return view('bs');
});
Route::get('/Habbits', function () {
    return view('Habbits') ;
}) -> name('Habbits');  ;
Route::get('/LongTermTasks', function () {
    return view('Long_term_tasks');
}) -> name('LongTermTasks');
Route::get('/insertH', function () {
    return view('insertHabit');
}) -> name('insertH');
Route::get('/insertD', function () {
    return view('insertDaily');
}) -> name('insertD');
Route::get('/insertL', function () {
    return view('insertLong');
}) -> name('insertL');

Route::get('/test', [TestController::class, 'index']);
Route::get('/test/{id}', [TestController::class, 'show']);

Route::get('/dashboard', function () {
    return view('Habbits');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/DailyTasks', [DailyTaskController::class, 'serch']) -> name('daily-tasks');
Route::get('Dayli', [DailyTaskController::class, 'store']);
Route::get('/daily-tasks-delete', [DailyTaskController::class, 'delete'])->name('daily-tasks-delete');

require __DIR__.'/auth.php';
