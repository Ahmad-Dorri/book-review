<?php

declare(strict_types=1);

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return redirect()->route('books.index');
});

Route::resource('books', BookController::class);
