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
use App\Http\Controllers\ResponseEntities\RoleResponse;
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
        $roleResponse = new RoleResponse();
        $roleResponse->setId($role->id);
        $roleResponse->setCode($role->code);
        $roleResponse->setName($role->name);
        $roleResponse->setDescription($role->description);
        $roleResponse->setIs_system($role->is_system == 1 ? TRUE : FALSE );
        $roleResponse->setPermissions($role->permission);



        return $roleResponse;
    }

}
