<?php

namespace controller;

class LoginController {

    private $loginView;

    public function __construct (\view\LoginView $v) {
        $this->loginView = $v;
    }
    
    public function loginUser() {
        if($this->loginView->getRequestUserName() && $this->loginView->getRequestPassword()) {
            echo "drop da bess";
        }
    }
}