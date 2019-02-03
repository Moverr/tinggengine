<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class Users extends Controller
{
   public function index($offset = 0, $limit = 10)
    { 
        $users = User::offset($offset)->limit($limit)->get();
        return json_encode($users);
    }

    public function show($id)
    {

       $user =  User:: where('id', '=', $id)->get();
        return json_encode($user);
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
