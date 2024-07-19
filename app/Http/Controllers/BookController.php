<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookController extends Controller
{
    public function index()
    {
        return 'hello';
    }

    public function show(string $id)
    {
        return 'single book';
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
