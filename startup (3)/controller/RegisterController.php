<?php

namespace controller;
use Exception;

class RegisterController {

    private $registerView;
    private $registerUserDb;

    public function __construct(\view\RegisterView $rv, \model\RegisterUserToDb $rudb) {
        $this->registerView = $rv;
        $this->registerUserDb = $rudb;
    }

    public function registerUser() {
        try {
            if($this->registerView->getRequestRegUserName() && $this->registerView->getRequestRegPassword() && $this->registerView->matchPasswords()) {
                $this->registerUserDb->getUserCredentials($this->registerView->getRequestRegUserName(), $this->registerView->getRequestRegPassword());
                $this->registerUserDb->setUpUserToDb();
            }
        } catch(Exception $e) {
            $this->registerView->validateRegCredentials($e->getMessage());
        }
    }
}