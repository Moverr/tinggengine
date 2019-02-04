<?php

namespace App\Http\Controllers\RequestEntities;
 
class UserRequest {

    private $username;
    private $password;
    private $repassword;
    private $role_id;
    
    private $id;
    
    function __construct($username = null, $password = null, $repassword = null, $role_id = null) {

        $this->username = $username;
        $this->password = $password;
        $this->repassword = $repassword;
        $this->role_id = $role_id;
    }
    
    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }

    
    /**
     * @return mixed
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * @param mixed $username
     *
     * @return self
     */
    public function setUsername($username) {
        $this->username = $username;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * @param mixed $password
     *
     * @return self
     */
    public function setPassword($password) {
        $this->password = $password;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRepassword() {
        return $this->repassword;
    }

    /**
     * @param mixed $repassword
     *
     * @return self
     */
    public function setRepassword($repassword) {
        $this->repassword = $repassword;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRoleId() {
        return $this->role_id;
    }

    /**
     * @param mixed $role_id
     *
     * @return self
     */
    public function setRoleId($role_id) {
        $this->role_id = $role_id;

        return $this;
    }

    function validate() {


        
        if ($this->getUsername() == null || strlen($this->getUsername()) == 0  ) {
             throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Username is Mandatory");
             
        }


        if ($this->getPassword() == null ) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Password is Mandatory");
              
        }

        if ($this->getRepassword() == null  ) {             
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Password is Mandatory");
        }



        if ($this->getRoleId() == null ) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Role  is Mandatory");
        }

        
        if($this->getPassword() != $this->getRepassword()){
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Passwords do not match");       
        }





        return true;
    }

}
/*
ENDPOINT PARAMS 
 
{
    "username": "sderty",
    "password":"sdferrr",
    "repassword":"sdddddd",
    "emailaddress": "ghytrfgh@gmail.com",
    "role_id": 1
    
    
     
}


*/
?>
