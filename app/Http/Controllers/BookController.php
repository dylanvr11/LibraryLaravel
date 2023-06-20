<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Psy\CodeCleaner\FunctionContextPass;
use Yajra\DataTables\Facades\DataTables;

class BookController extends Controller
{
    public function showBooks()
    {
        return view('books.index');
    }

    public function showHomeWithBooks()
    {
        $books = $this->getAllBooks()->original['books'];
        //dd($books);
        /*
        return view('home', compact('books'));
        forma uno
        */
        /*
        return view('home', ['books' => $books]);
        forma dos
        */
        return view('index', compact('books'));
    }

    public function getAllBooks()
    {
        $books = Book::with('Author')->get();
        return response()->json(['books' => $books], 200);
    }
    //se crea para rende datatable
    public function getAllBooksForDataTable()
    {
        $books = Book::with('Author');
        return DataTables::of($books)
        ->addColumn('action', function($row) {
            return "<a
            href='#'
            onclick='event.preventDefault();'
            data-id='{$row->id}'
            role='edit'
            class='btn btn-warning btn-sm'>Edit</a>
            <a
            href='#'
            onclick='event.preventDefault();'
            data-id='{$row->id}'
            role='delete'
            class='btn btn-danger btn-sm'>Delete</a>";
        })
        ->rawColumns(['action'])
        ->make();
    }
    /*
    public function getAllBooks()
    {
        $books = Book::with('Author')->get();
        return response()->json(['books' => $books], 200);
    }
    */
    public function getABook(Book $book)
    {
        $book->load('Author','Category');
        return response()->json(['book' => $book], 200);
    }

    public function saveBook(Request $request){
        $book = new Book($request->all());
        $this->uploadImages($request, $book);
        $book->save();
        return response()->json(['book' => $book], 200);
    }

    public function updateBook(Book $book, Request $request){

        $requestAll = $request->all();
        $this->uploadImages($request,$book);
        $requestAll['image'] = $book->image;
        $book->update($requestAll);
        return response()->json(['book' => $book->refresh()->load('Author','Category')], 201);
        /*
        acá no cargaba la imagen y guarda en base dato otra dirección diferente
        //$requestData = $request->all();
        $this->uploadImages($request,$book);
        $book->update($request->all());
        return response()->json(['book' => $book->refresh()->load('Author','Category')], 201);
        */
        /* antes de pasarle la imagen -->
        $book->update($request->all());
        return response()->json(['book' => $book->refresh()->load('Author','Category')], 201);
        */
    }

    public function deleteBook(Book $book)
    {
        /*
        sin la vista
        $user->delete();
        return response()->json([], 204);
        */
        $book->delete();
        return response()->json([],204);
    }

    private function uploadImages($request, &$book){
        if(!isset($request->image)) return;
        $random = Str::random(20);
        $image_name = "{$random}.{$request->image->clientExtension()}";
        $request->image->move(storage_path('app/public/images'), $image_name);
        $book->image = $image_name;
    }
}
