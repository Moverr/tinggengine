<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

use Exception;
use App\User;
use App\Http\Controllers\RequestEntities\UserRequest;
use App\Http\Helpers\Utils;
use App\Http\Controllers\ResponseEntities\UserResponse;
use App\Http\Controllers\RequestEntities\LoginRequest;
use App\Profiles;
use App\Http\Controllers\ResponseEntities\ProfileResponse;

/**
 * Description of ProfileService
 *
 * @author mover  
 */
class ProfileService {

    //put your code here

    private $util;
    private static $instance;

    function __construct() {
        $this->util = new Utils();
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new ProfileService();
        }
        return self::$instance;
    }

    
    public function save($request, $autneticaton_response = null) {

        $username = $request['username'];
        $password = $request['password'];
        $repassword = $request['repassword'];
        $role_id = $request['role_id'];
        $userRequest = new UserRequest($username, $password, $repassword, $role_id); 
        $user = $this->saveProfile($userRequest, $autneticaton_response);
        $userResponse = $this->populate($user);
        return $userResponse->toString();
    }

    public function saveProfile(UserRequest $userRequest, $autneticaton_response = null) {

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
        $user->save();
        return $user;
    }

    
    
    public function populate($profile) {
        if ($profile == null) {
            return null;
        }
        $profileResponse = new ProfileResponse();  
        $profileResponse->setId($profile->id);
        $profileResponse->setFirstname($profile->firstname);
        $profileResponse->setLastname($profile->lastname);
        $profileResponse->setCompanyname($profile->companyname);
        $profileResponse->setStatus($profile->status);

        return $profileResponse;
    }

}
