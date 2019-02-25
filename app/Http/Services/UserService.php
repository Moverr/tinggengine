<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

use App\User;
use App\Http\Controllers\RequestEntities\UserRequest;
use App\Http\Helpers\Utils;
use App\Http\Controllers\ResponseEntities\UserResponse;
use App\Http\Controllers\RequestEntities\LoginRequest;
use Exception;

/**
 * Description of UserService
 *
 * @author mover  
 */
class UserService {

    private $util;
    private static $instance;

    function __construct() {
        $this->util = new Utils();
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new UserService();
        }
        return self::$instance;
    }

    public function getList($offset, $limit, $autneticaton_response = null) {

        $users = User::offset($offset)->limit($limit)->get();
        //todo: loop through and create different  important aspects ::
        $userResponses = [];
        foreach ($users as $user) {
            $userResponse = $this->populate($user);
            $userResponses[] = $userResponse->toString();
        }


        return $userResponses;
    }

    public function get($id, $autneticaton_response = null) {

        $user = User::where('id', $id)->get();
        if ($user == null) {
            throw new Exception("Record does not exist in the daabase");
        }

        $userResponse = $this->populate($user[0]);
        return $userResponse->toString();
    }

    public function login($request) {
        $username = $request['username'];
        $password = $request['password'];

        $loginRequest = new LoginRequest();
        $loginRequest->setPassword($password);
        $loginRequest->setUsername($username);
        $loginRequest->validate();

        $response = $this->util->validateUser($username, $password);
        return $response->toString();
    }

    public function save($request, $autneticaton_response = null) {

        $username = $request['username'];
        $password = $request['password'];
        $repassword = $request['repassword'];
        $role_id = $request['role_id'];
        $userRequest = new UserRequest($username, $password, $repassword, $role_id); 
        $user = $this->saveUser($userRequest, $autneticaton_response);
        $userResponse = $this->populate($user);
        return $userResponse->toString();
    }

    public function saveUser(UserRequest $userRequest, $autneticaton_response = null) {

        $userRequest->validate();

        $user = User::where('username', $userRequest->getUsername())->first();
        if ($user != null) {
            throw new Exception("User Exists with the same username in the database ");
        }

        $user = new User();
        $user->username = $userRequest->getUsername();
        $user->password = Utils::HashPassword($userRequest->getPassword());
        $user->status = 'ACTIVE';
        if ($autneticaton_response != null) {
            $createdBy = $autneticaton_response->getId();
            $user->created_by = $createdBy;
        }
        $user->group = $userRequest->getGroup();
        $user->save();
        return $user;
    }

    public function update($request, $authentication = null) {
        $username = $request['username'];
        $password = $request['password'];
        $repassword = $request['repassword'];
        $role_id = $request['role_id'];
        $userRequest = new UserRequest($username, $password, $repassword, $role_id);

        if ($request['id'] == null) {
            throw new Exception("Mandatory field ID is missing", 403);
        }

        $userRequest->setId($request['id']);
        $userRequest->validate();

        $user = User::where('id', $userRequest->getId())->first();
        if ($user == null) {
            throw new Exception("Record does not exist in the daabase", 403);
        }

        //todo: check if user exists wit the same username 
        $existing_user = User::where('username', $username)
                ->where('id', "<>", $userRequest->getId())
                ->first();
        if ($existing_user != null) {
            throw new Exception("User Exists with the same username in the database ", 403);
        }



        $userResponse = $this->populate($user);
        return $userResponse->toString();
    }

    public function archive($id, $autneticaton_response = null) {

        $user = User::where('id', $id)->first();
        if ($user == null) {
            throw new Exception("Record does not exist in the daabase", 403);
        }
        $user->status = 'ARCHIVED';
        $user->update();
    }
    
    
    
    public function setUserRole($user_id, $role_name){
        
        
        return  null;
        
    }

    public function populate($user) {
        $userResponse = new UserResponse();
        if ($user->username != null) {
            $userResponse->setUsername($user->username);
        }

        $roles = [];
        $userResponse->setId($user->id);
        foreach ($user->role as $role) {
            if ($role->status == 'ACTIVE') {
                $roles[] = RoleService::getInstance()->populate($role)->toString();
            }
        }


        $userResponse->setRole($roles);
        $userResponse->setDateCreated($this->util::convertToTimestamp($user->date_created));
        $profileResponse = ProfileService::getInstance()->populate($user->profile);
        if ($profileResponse != null) {
            $userResponse->setProfile($profileResponse->toString());
        }

        return $userResponse;
    }

}
