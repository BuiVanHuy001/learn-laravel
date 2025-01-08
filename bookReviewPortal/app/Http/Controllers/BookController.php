<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the book.
     */
    public function index(Request $request): View|Factory|Application
    {
        $title = $request->title;
        $filter = $request->filter ?? '';
        $books = Book::when($title, fn($query, $title) => $query->title($title))->orderBy('created_at', 'desc');

        $books = match ($filter) {
            'popular_last_month' => $books->popularLastMonth(),
            'popular_last_6months' => $books->popularLast6Months(),
            'highest_rated_last_month' => $books->highestRatedLastMonth(),
            'highest_rated_last_6months' => $books->highestRatedLast6Months(),
            default => $books->latest()->withAvgRating()->withReviewsCount()
        };
        $cacheKey = 'books:' . $title . ':' . $filter;
        $books = cache()->remember($cacheKey, 3600, fn () =>  $books->get());
        return view('books.index', ['books' => $books]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): View|Factory|Application
    {
        $cacheKey = 'book:' . $id;
        $book = cache()->remember($cacheKey, 3600, fn () => Book::with([
            'reviews' => fn($query) => $query->latest()
        ])->withAvgRating()->withReviewsCount()->findOrFail($id));
        return view('books.show', ['book' => $book]);
    }
}
