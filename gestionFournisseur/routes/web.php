<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GestionController;
use App\Http\Controllers\AdminController;

Route::GET('/',
[GestionController::class,'index'])->name('gestion.index');

Route::GET('/administration',
[AdminController::class,'index'])->name('admin.index');