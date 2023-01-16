<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Back\NoteController;

Route::middleware(['admin.auth'])->group(function () {
    Route::resource('notes', NoteController::class)->names([
        'index'      => 'back.note.index',
        'create'     => 'back.note.create',
        'show'       => 'back.note.show',
        'store'      => 'back.note.store',
        'edit'       => 'back.note.edit',
        'update'     => 'back.note.update',
        'destroy'    => 'back.note.delete',
    ]);
});
