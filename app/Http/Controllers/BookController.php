<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookController extends Controller
{
    public function index(Request $request): View
    {
        $title = $request->input('title');
        $filterValue = $request->input('filter', '');


        $books = Book::query()->with('author')->when($title, fn($query, $title) => $query->searchByTitle($title));

        $books = match ($filterValue) {
            'popular_last_month' => $books->popularLastMonth(),
            'popular_last_6_months' => $books->popularLastSixMonths(),
            'highest_rated_last_month' => $books->highestRatedLastMonth(),
            'highest_rated_last_6_months' => $books->highestRatedLastSixMonths(),
            default => $books->popular()->highestRated()
        };

        $books = $books->simplePaginate(10);

        return view('books.index', [
            'books' => $books,
        ]);
    }

    public function show(string $id): View
    {
        $book = Book::query()->popular()->highestRated()->with('reviews', fn($query) => $query->latest())->findOrFail($id);

        return view('books.show', [
            'book' => $book,
        ]);
    }

    public function create()
    {
        return 'create book form';
    }

    public function store(Request $request)
    {
        return 'store book';
    }

    public function edit(string $id)
    {
        return 'edit book form';
    }

    public function update(Request $request, string $id)
    {
    }

    public function destroy(Request $request, string $id)
    {
    }
}
