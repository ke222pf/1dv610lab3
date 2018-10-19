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
        if($this->registerView->getRequestRegUserName() && $this->registerView->getRequestRegPassword()) {

            $this->registerUserDb->getUserCredentials($this->registerView->getRequestRegUserName(), $this->registerView->getRequestRegPassword());
            if($this->registerUserDb->checkIfAlreadyExistingUser() == false) {
                $this->registerUserDb->setUpUserToDb();
                $this->registerView->getIfRegistered($this->registerUserDb->checkIfRegistered());
            }
            }
    }
}