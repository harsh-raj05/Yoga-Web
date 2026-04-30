<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PreferenceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlannerController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\Admin\YogaController;
use App\Http\Controllers\Admin\MeditationController;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 👇 ADD THIS PART
    Route::get('/preferences', [PreferenceController::class, 'create'])->name('preferences.create');
    Route::post('/preferences', [PreferenceController::class, 'store'])->name('preferences.store');
    
    Route::get('/plan', [PlannerController::class, 'index'])->name('plan');
    Route::post('/complete', [ProgressController::class, 'store'])->name('complete');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/yoga', [YogaController::class, 'index'])->name('admin.yoga');
    Route::get('/admin/yoga/create', [YogaController::class, 'create'])->name('admin.yoga.create');
    Route::post('/admin/yoga', [YogaController::class, 'store'])->name('admin.yoga.store');
    Route::delete('/admin/yoga/{id}', [YogaController::class, 'destroy'])->name('admin.yoga.delete');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/meditation', [MeditationController::class, 'index'])->name('admin.meditation');
    Route::get('/admin/meditation/create', [MeditationController::class, 'create'])->name('admin.meditation.create');
    Route::post('/admin/meditation', [MeditationController::class, 'store'])->name('admin.meditation.store');
    Route::delete('/admin/meditation/{id}', [MeditationController::class, 'destroy'])->name('admin.meditation.delete');
});

require __DIR__.'/auth.php';