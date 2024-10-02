<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\VisitController;

Route::get('/', function () {
    //return view('welcome');
    return redirect('/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');


    Route::prefix('properties')->group(function () {
        Route::get('/index', [PropertyController::class, 'index'])->name('index.properties');
        Route::get('/manage/{id?}', [PropertyController::class, 'manage'])->name('manage.properties');
        Route::post('/create-property', [PropertyController::class, 'store'])->name('create-property.properties');
        Route::post('/update-property/{id}', [PropertyController::class, 'update'])->name('update-property.properties');
        Route::delete('/delete-property/{id}', [PropertyController::class, 'destroy'])->name('delete-property.properties');


    });

    Route::prefix('clients')->group(function () {
        Route::get('/index', [ClientController::class, 'index'])->name('index.clients');
        Route::get('/manage/{id?}', [ClientController::class, 'manage'])->name('manage.clients');
        Route::post('/create-client', [ClientController::class, 'store'])->name('create-client.clients');
        Route::post('/update-client/{id}', [ClientController::class, 'update'])->name('update-client.clients');
        Route::delete('/delete-client/{id}', [ClientController::class, 'destroy'])->name('delete-client.clients');

    });

    Route::prefix('visits')->group(function () {
        Route::get('/index', [VisitController::class, 'index'])->name('index.visits');
        Route::get('/manage/{id?}', [VisitController::class, 'manage'])->name('manage.visits');
        Route::post('/create-visit', [VisitController::class, 'store'])->name('create-visit.visits');
        Route::post('/update-visit/{id}', [VisitController::class, 'update'])->name('update-visit.visits');
        Route::delete('/delete-visit/{id}', [VisitController::class, 'destroy'])->name('delete-visit.visits');

    });

});
