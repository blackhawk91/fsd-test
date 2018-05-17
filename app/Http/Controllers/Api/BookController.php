<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CreateBookRequest;
use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Book;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Display a listing of User the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $books = Book::where('user_id','=', Auth::user()->id)->paginate(10);

        return response($books, 206);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBookRequest $request)
    {
        $book = Auth::user()->books()->create($request->all());

        return response($book, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        if($book->user_id !== Auth::user()->id) return response(['msg' => 'Unauthorized access.', 401]);


        return response($book,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        if($book->user_id !== Auth::user()->id) return response(['msg' => 'Unauthorized access.', 401]);

        return response($book,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $book = Book::find($request->id);

        if($book->user_id !== Auth::user()->id) return response(['msg' => 'Unauthorized access.', 401]);

        $book->update($request->all());

        return response($book,201);
    }

    /**
     * @param Book $book
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function destroy(Book $book)
    {
        if($book->user_id !== Auth::user()->id) return response(['msg' => 'Unauthorized access.', 401]);

        $book->delete();

        return response(['msg' => 'success'],200);
    }
}
