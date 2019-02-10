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
 * Description of RoleService
 *
 * @author mover  
 */
class RoleService {

    //put your code here

    private $util;
    private static $instance;

    function __construct() {
        $this->util = new Utils();
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new RoleService();
        }
        return self::$instance;
    }
    
    
     public function populate($role) {
        $userResponse = new UserResponse();
        if ($role->username != null) {
            $userResponse->setUsername($role->username);
        }

        $roles = [];
        $userResponse->setId($role->id);
        foreach ($role->role as $role) {
            if ($role->status == 'ACTIVE') {
                $roles[] = $role;

                ;
            }
        }

        $userResponse->setRole($roles);
        $userResponse->setDateCreated($this->util::convertToTimestamp($role->date_created));
        $profileResponse = ProfileService::getInstance()->populate($role->profile);
        $userResponse->setProfile($profileResponse->toString());

        return $userResponse;
    }
    

}
