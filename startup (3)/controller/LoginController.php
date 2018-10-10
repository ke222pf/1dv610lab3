<?php

namespace controller;

class LoginController {

    private $loginView;
    private $loginUser;

    public function __construct (\view\LoginView $v, \model\loginUser $lu) {
        $this->loginView = $v;
        $this->loginUser = $lu;
    }
    
    public function loginUser() {
        if($this->loginView->getRequestUserName() && $this->loginView->getRequestPassword()) {
            $this->loginUser->getCredentials($this->loginView->getRequestUserName(), $this->loginView->getRequestPassword());
            $this->loginUser->match();
        }
        if($this->loginUser->isUserLoggedIn()) {
            echo "itJonas";
        }
    }
}