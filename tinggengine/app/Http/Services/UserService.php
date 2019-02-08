<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

use App\Http\Helpers\Utils;

/**
 * Description of UserService
 *
 * @author mover  
 */
class UserService {

    private $util;

    function __construct() {
        $this->util = new Utils();
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new UserService();
        }
        return self::$instance;
    }

}
