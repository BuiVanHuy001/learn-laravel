<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Book $book): View|Factory|Application
    {
        return view('books.reviews.create', ['book' => $book]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Book $book): RedirectResponse
    {
        $data = $request->validate([
            'content' => 'required|string:min:15',
            'rating' => 'required|integer|min:1|max:5',
        ]);
        $book->reviews()->create($data);
        return redirect()->route('books.show', $book);
    }

}
