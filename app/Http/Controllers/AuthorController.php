<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function getAllAuthors(){
        $authors = Author::get();
        return response()->json(['authors'=>$authors],200);
    }
}
