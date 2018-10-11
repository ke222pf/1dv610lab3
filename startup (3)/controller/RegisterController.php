<?php

namespace controller;

class RegisterController {

    private $registerView;
    private $registerUserDb;

    public function __construct(\view\RegisterView $rv, \model\RegisterUserToDb $rudb) {
        $this->registerView = $rv;
        $this->regusterUserDb = $rudb;
    }

    public function registerUser() {
        if($this->registerView->getRequestRegUserName() && $this->registerView->getRequestRegPassword()) {
            $this->registerUserDb->getUserCredentials($this->registerView->getRequestRegUserName(), $this->registerView->getRequestRegPassword());
        }
    }
}