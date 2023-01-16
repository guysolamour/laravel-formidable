<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Back\FormidableController;

Route::get('formidable', [FormidableController::class, 'urlLink'])->name('formidable.url');
