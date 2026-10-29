<?php

use App\Http\Controllers\MesinController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('mesin.index'));

Route::resource('mesin', MesinController::class)->except('show');