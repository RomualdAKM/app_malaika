<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FAQController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ConditionController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\StructureController;
use App\Http\Controllers\TestimonyController;
use App\Http\Controllers\ReservationController;

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', HomeController::class)->name('dashboard');

    Route::resource('structure', StructureController::class);

    Route::resource('equipment', EquipmentController::class);
    Route::resource('room', RoomController::class);
    Route::resource('reservation', ReservationController::class);
    Route::resource('condition', ConditionController::class);
    Route::resource('faq', FAQController::class);
    Route::resource('testimony', TestimonyController::class);

    Route::post('/gallery-room', [RoomController::class, 'addImage'])->name('gallery.room.store');
    Route::delete('/gallery-room/{image}', [RoomController::class, 'destroyImage'])->name('gallery.room.destroy');

    Route::post('/gallery-structure', [StructureController::class, 'addImage'])->name('gallery.structure.store');
    Route::delete('/gallery-structure/{image}', [StructureController::class, 'destroyImage'])->name('gallery.structure.destroy');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('/migrate', function () {
    Artisan::call('migrate');
    dd('migrated!');
});

Route::get('/migrate-seed', function () {
    Artisan::call('migrate:fresh --seed');
    dd('migrated & seed!');
});

Route::get('/seed', function () {
    Artisan::call('db:seed');
    dd('seed!');
});

Route::get('/migrate-fresh', function () {
    Artisan::call('migrate:fresh');
    dd('migrated & fresh!!');
});

Route::get('/reboot', function () {
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    dd('All done!');
});

Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');
