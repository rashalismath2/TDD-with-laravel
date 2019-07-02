<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Http\Requests\StoreBooValidation;

class BookController extends Controller
{
    public function store(StoreBooValidation $request){
        Book::create([
            'title'=>$request->title,
            'author'=>$request->author
        ]);
    }
    public function update(StoreBooValidation $request,$id){
        $book=Book::find($id);
        $book->update([
            'title'=>$request->title,
            'author'=>$request->author
        ]);
     
    }
}
