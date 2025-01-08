<?php

    use App\Http\Controllers\BookController;
    use App\Http\Controllers\ReviewController;
    use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('books.index');
});

Route::resource('books', BookController::class)->only(['index', 'show']);
Route::resource('books.reviews', ReviewController::class)->scoped(['book' => 'id'])->only(['create', 'store']);
