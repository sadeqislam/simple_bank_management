<?php

namespace App;

abstract class User {
    protected $name;
    protected $email;
    protected $password;

    public function __construct($name, $email, $password) {
        $this->name = $name;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function getEmail() {
        return $this->email;
    }

    public function checkPassword($password) {
        return password_verify($password, $this->password);
    }
}
