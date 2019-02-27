<?php

namespace App\Http\Helpers;

use DateTime;
use App\User;
use App\Http\Controllers\ResponseEntities\AuthResponse;
use App\UserRoles;

class Utils {

    function __construct() {
        
    }

    function incrementalHash($len = 5) {
        $charset = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $base = strlen($charset);
        $result = '';

        $now = explode(' ', microtime())[1];
        while ($now >= $base) {
            $i = $now % $base;
            $result = $charset[$i] . $result;
            $now /= $base;
        }
        return substr($result, -5);
    }

    public function validateAuthenction($authentication_string) {



        if ($authentication_string == null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Authentcation String should not be null");
        }

        $authentication = str_replace("Basic:", "", $authentication_string);


        $usernamePassword = base64_decode($authentication);
        $usernamePassword = trim($usernamePassword);

        $parts = explode(":", $usernamePassword);


        if (sizeof($parts) != 2) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("invalid security credentials");
        }

        $auth = $this->validateUser($parts[0], $parts[1]);

        return $auth;
    }

    function validateUser($username, $password) {

        $existing_user = User::where('username', $username)
                ->where('password', sha1($password))
                ->where('status', "ACTIVE")
                ->first();
        if ($existing_user == null) {
            throw new \Illuminate\Validation\UnauthorizedException("Invalid  user credentials", 403);
        }

        //todo: get me all the use roles where user_id = this
        $user_roles =  UserRoles::where('user_id',$existing_user->id)->get();
        if($user_roles != null){
            
            foreach ($user_roles as $record) {
                
            }
        }
        
                
        $auth = new AuthResponse();
        $auth->setAuthentication($this->convertToBasicAuth($username, $password));
        $auth->setId($existing_user->id);
        $auth->setRole($user_roles->Roles);

        return $auth;
    }

    public function convertToBasicAuth($username, $password) {
        $authString = $username . ":" . $password;
        $authStringEnc = base64_encode($authString);
        return ("Basic:" . $authStringEnc);
    }

    public static function HashPassword($password) {
        if ($password != null) {
            return sha1($password);
        }
        throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("String should not be null");
    }

    public function getHttpResponseHeader($code) {

        if ($code !== NULL) {

            switch ($code) {
                case 100: $text = 'Continue';
                    break;
                case 101: $text = 'Switching Protocols';
                    break;
                case 200: $text = 'OK';
                    break;
                case 201: $text = 'Created';
                    break;
                case 202: $text = 'Accepted';
                    break;
                case 203: $text = 'Non-Authoritative Information';
                    break;
                case 204: $text = 'No Content';
                    break;
                case 205: $text = 'Reset Content';
                    break;
                case 206: $text = 'Partial Content';
                    break;
                case 300: $text = 'Multiple Choices';
                    break;
                case 301: $text = 'Moved Permanently';
                    break;
                case 302: $text = 'Moved Temporarily';
                    break;
                case 303: $text = 'See Other';
                    break;
                case 304: $text = 'Not Modified';
                    break;
                case 305: $text = 'Use Proxy';
                    break;
                case 400: $text = 'Bad Request';
                    break;
                case 401: $text = 'Unauthorized';
                    break;
                case 402: $text = 'Payment Required';
                    break;
                case 403: $text = 'Forbidden';
                    break;
                case 404: $text = 'Not Found';
                    break;
                case 405: $text = 'Method Not Allowed';
                    break;
                case 406: $text = 'Not Acceptable';
                    break;
                case 407: $text = 'Proxy Authentication Required';
                    break;
                case 408: $text = 'Request Time-out';
                    break;
                case 409: $text = 'Conflict';
                    break;
                case 410: $text = 'Gone';
                    break;
                case 411: $text = 'Length Required';
                    break;
                case 412: $text = 'Precondition Failed';
                    break;
                case 413: $text = 'Request Entity Too Large';
                    break;
                case 414: $text = 'Request-URI Too Large';
                    break;
                case 415: $text = 'Unsupported Media Type';
                    break;
                case 500: $text = 'Internal Server Error';
                    break;
                case 501: $text = 'Not Implemented';
                    break;
                case 502: $text = 'Bad Gateway';
                    break;
                case 503: $text = 'Service Unavailable';
                    break;
                case 504: $text = 'Gateway Time-out';
                    break;
                case 505: $text = 'HTTP Version not supported';
                    break;
                default:
                    exit('Unknown http status code "' . htmlentities($code) . '"');
                    break;
            }

            return $text;
        }
    }

    public static function convertToTimestamp($date) {
        if($date instanceof DateTime){
            return strtotime($date);
        }
        
    }

}
