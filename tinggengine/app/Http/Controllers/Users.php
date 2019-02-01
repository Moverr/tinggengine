<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Users extends Controller
{
   public function index()
    {
        // return Article::all();
        return "All Users";
    }
 
    public function show($id)
    {
        // return Article::find($id);
        return "Reached";
    }

    public function store(Request $request)
    {
        // return Article::create($request->all());
         return "Reached";
    }

    public function update(Request $request, $id)
    {
        // $article = Article::findOrFail($id);
        // $article->update($request->all());

        // return $article;
         return "Reached";
    }

    public function delete(Request $request, $id)
    {
        // $article = Article::findOrFail($id);
        // $article->delete();

        return 204;


    }
    
}
