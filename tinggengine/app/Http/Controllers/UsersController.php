<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\RequestEntities\UserRequest;
use App\Http\Helpers\Utils;
use App\Http\Controllers\ResponseEntities\UserResponse;

class UsersController extends Controller {

    private $util;

    function __construct() {
        $this->util = new Utils();
    }

    public function index(Request $request, $offset = 0, $limit = 10) {


        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);

        $users = User::offset($offset)->limit($limit)->get();
        //todo: loop through and create different  important aspects ::
        $userResponses = [];
        foreach ($users as $user) {
            $userResponse = new UserResponse();
            $userResponse->setUsername($user->username);
            $userResponse->setId($user->id);
            $userResponse->setRole($user->role->role_id);
            $userResponse->setDateCreated($user->date_created);

            $userResponses[] = $userResponse->toJson();
        }

        return ($userResponses);
    }

    public function get(Request $request, $id) {
        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);

        $user = User::where('id', $id)->get();
        if ($user == null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Record does not exist in the daabase");
        }

        $userResponse = new UserResponse();
        $userResponse->setId($user[0]->id);
        $userResponse->setAuthor(null);
        $userResponse->setUsername($user[0]->username);
        return $userResponse->toJson();
    }

    public function login(Request $request) {
        $username = $request['username'];
        $password = $request['password'];

        $loginRequest = new RequestEntities\LoginRequest();
        $loginRequest->setPassword($password);
        $loginRequest->setUsername($username);
        $loginRequest->validate();



        return $this->util->validateUser($username, $password);
    }

    public function save(Request $request) {

        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);

        $username = $request['username'];
        $password = $request['password'];
        $repassword = $request['repassword'];
        $role_id = $request['role_id'];

        $userRequest = new UserRequest($username, $password, $repassword, $role_id);
        $userRequest->validate();

        $user = User::where('username', $username)->first();
        if ($user != null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("User Exists with the same username in the database ");
        }

        $user = new User();
        $user->username = $username;
        $user->password = Utils::HashPassword($password);
        $user->status = 'ACTIVE';
        $user->save();


        return json_encode($user);
    }

    public function update(Request $request) {

        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);

        $username = $request['username'];
        $password = $request['password'];
        $repassword = $request['repassword'];
        $role_id = $request['role_id'];
        $userRequest = new UserRequest($username, $password, $repassword, $role_id);

        if ($request['id'] == null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Mandatory field ID is missing");
        }

        $userRequest->setId($request['id']);
        $userRequest->validate();

        $user = User::where('id', $userRequest->getId())->first();
        if ($user == null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Record does not exist in the daabase");
        }

        //todo: check if user exists wit the same username 
        $existing_user = User::where('username', $username)
                ->where('id', "<>", $userRequest->getId())
                ->first();
        if ($existing_user != null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("User Exists with the same username in the database ");
        }


        $user->username = $username;
        $user->password = $password;
        $user->update();

        return json_encode($user);
    }

    public function archive(Request $request, $id) {


        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);



        $user = User::where('id', $id)->first();
        if ($user == null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Record does not exist in the daabase");
        }
        $user->status = 'ARCHIVED';
        $user->update();
    }

}
