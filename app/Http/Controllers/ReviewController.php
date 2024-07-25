<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    public function __construct()
    {
        $this->middleware('throttle:reviews')->only(['store']);
    }

    public function store(Request $request, Book $book)
    {
        $data = $request->validate([
            'review' => 'required|min:15',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $book->reviews()->create([...$data, 'user_id' => 1]);
        return redirect()->route('books.show', $book)->with('success', 'You successfully added a review.');
    }
}
