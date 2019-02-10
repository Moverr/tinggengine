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
use App\Http\Services\ProfileService;
use App\Profiles;
use Exception;

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

    public function populate(Profiles $profile) {

        $profileResponse = new ProfileService();
        if ($profile != null) {
            $profileResponse->setId($profile->id);
            $profileResponse->setFirstname($profile->firstname);
            $profileResponse->setLastname($profile->lastname);
            $profileResponse->setCompanyname($profile->companyname);
            $profileResponse->setStatus($profile->status);
        }

        return $profileResponse;
    }

}
