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
use App\Http\Controllers\RequestEntities\ProfileRequest;

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

        throw new Exception("Not Yet Implemented", 403);
    }

    public function saveProfile(ProfileRequest $profileRequest, $autneticaton_response = null) {
        $createdBy = $autneticaton_response->getId();


        $profiles = new Profiles();
        $profiles->firstname = $profileRequest->getFirstname();
        $profiles->lastname = $profileRequest->getLastname();
        $profiles->companyname = $profileRequest->getCompanyname();
        $profiles->created_by = $createdBy;
        $profiles->save();

        return $profiles;
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
