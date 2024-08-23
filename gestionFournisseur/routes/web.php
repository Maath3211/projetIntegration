<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GestionController;

Route::GET('/',
[GestionController::class,'index'])->name('gestion.index');
