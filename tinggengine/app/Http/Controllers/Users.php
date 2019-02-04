<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use  App\Http\Controllers\RequestEntities\UserRequest;
use  App\Http\Helpers\Utils;


class Users extends Controller
{

   private  $util;

    function __construct(){
        $this->util = new Utils();
    }


   public function index($offset = 0, $limit = 10)
    { 
        $users = User::offset($offset)->limit($limit)->get();
        return json_encode($users);
    }

    public function get($id)
    {

       // $user =  User:: where('id', '=', $id)->get();
       //  return json_encode($user);
       return "GET FUNCTIOn ";
    }

    public function save(Request $request)
    {
         $username = $request['username'];
         $password = $request['password'];
         $repassword = $request['repassword'];
         $role_id = $request['role_id'];

        $userRequest = new UserRequest($username,$password,$repassword,$role_id);
        // $response_type =  $userRequest->validate();
        
        // if($response_type == false){
        //         return json_encode($this->util->getHttpResponseHeader(400));            
        // }

             // $firstname = $request['firstname'];
         // $lastname = $request['lastname'];
         // $organisation = $request['organisation'];
         
         
        // validate  mandatories
        //todo: check if user exists in the database
        // submit , and return resource_id 
        var_dump($username);
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

    public function archive($id)
    {
        // $article = Article::findOrFail($id);
        // $article->delete();

        return 204;


    }

}
