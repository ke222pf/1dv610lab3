<?php

namespace controller;

class RegisterController {

    private $registerView;

    public function __construct(\view\RegisterView $rv) {
        $this->registerView = $rv;
    }

    public function registerUser() {
        if($this->registerView->getRequestRegUserName() && $this->registerView->getRequestRegPassword()) {
            
        }
    }
}