<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $attributes = ['language', 'genre'];

        $books = Book::query()->FilterBySearch($request)->FilterByAttribute($request, $attributes)->latest()->paginate(10);

        return view('dashboard', ['books' => $books]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
