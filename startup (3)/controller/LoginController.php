<?php

namespace controller;

class LoginController {

    private $loginView;
    private $loginUser;
    private $layoutView;

    public function __construct (\view\LoginView $v, \model\loginUser $lu, \view\LayoutView $lv) {
        $this->loginView = $v;
        $this->loginUser = $lu;
        $this->layoutView = $lv;
    }
    
    public function loginUser() {
        if($this->loginView->getRequestUserName() && $this->loginView->getRequestPassword()) {
            $this->loginUser->getCredentials($this->loginView->getRequestUserName(), $this->loginView->getRequestPassword());
            $this->loginUser->matchLogin();
            $this->layoutView->setIsLoggedIn($this->loginUser->isUserLoggedIn());
            $this->loginView->validateUserLogin($this->loginUser->isUserLoggedIn());
        }
        
    
    }
}