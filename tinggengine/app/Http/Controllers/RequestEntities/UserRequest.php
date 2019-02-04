<?php

namespace App\Http\Controllers\RequestEntities;

class UserRequest {

    private $username;
    private $password;
    private $repassword;
    private $role_id;

    function __construct($username = null, $password = null, $repassword = null, $role_id = null) {

        $this->username = $username;
        $this->password = $password;
        $this->repassword = $repassword;
        $this->role_id = $role_id;
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


        $error = \Illuminate\Validation\ValidationException::withMessages([
                    'field_name_1' => ['Validation Message #1'],
                    'field_name_2' => ['Validation Message #2'],
        ]);
        throw $error;


        if ($this->username == null || strlen($this->username == 0)) {
            return abort('401', 'Username is Mandatory');
        }


        if ($this->password == null || strlen($this->password == 0)) {
            return abort('401', 'Username is Mandatory');
        }

        if ($this->repassword == null || strlen($this->repassword == 0)) {
            return abort('401', 'Username is Mandatory');
        }



        if ($this->role_id == null || strlen($this->role_id == 0)) {
            return abort('401', 'Username is Mandatory');
        }






        return true;
    }

}

?>
