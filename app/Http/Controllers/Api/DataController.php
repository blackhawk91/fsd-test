<?php

namespace App\Http\Controllers\Api;

use App\Book;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function allBooks(Request $request)
    {
        $query = Book::query();

        if ($request->author) $query->where('author','LIKE',"%{$request->author}%");

        if ($request->yearFrom) $query->where('year','>=',$request->yearFrom);

        if ($request->yearTo) $query->where('year','<=',$request->yearTo);

        $books = $query->paginate(10);

        return response($books, 206);
    }
}
