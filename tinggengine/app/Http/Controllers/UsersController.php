<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\RequestEntities\UserRequest;
use App\Http\Helpers\Utils;

class UsersController extends Controller {

    private $util;

    function __construct() {
        $this->util = new Utils();
    }

    public function index($offset = 0, $limit = 10) {
        $users = User::offset($offset)->limit($limit)->get();
        return json_encode($users);
    }

    public function get($id) {
        $user = User::where('id',$id)->first();
        if($user == null){
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Record does not exist in the daabase");
        }
        return json_encode($user);
    }

    public function save(Request $request) {
        $username = $request['username'];
        $password = $request['password'];
        $repassword = $request['repassword'];
        $role_id = $request['role_id'];
        
        $userRequest = new UserRequest($username, $password, $repassword, $role_id);
        $userRequest->validate();
        
        //todo: check if user exists wit the same username 
        $user = User::where('username',$username)->first();
        if($user !=  null){
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("User Exists with the same username in the database ");
        }
        
        
        $user = new User();
        $user->username = $username;
        $user->password = $password;         
        $user->status = 'ACTIVE'; 
        
        
        $user->save();
        
       
        return "Reached";
    }

    public function update(Request $request, $id) {

        // $article = Article::findOrFail($id);
        // $article->update($request->all());
        // return $article;
        return "Reached";
    }

    public function archive($id) {
        // $article = Article::findOrFail($id);
        // $article->delete();

        return 204;
    }

}
