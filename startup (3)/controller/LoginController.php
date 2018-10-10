<?php

namespace controller;

class LoginController {

    private $loginView;
    private $loginUser;
    private $layoutView;
    private $session;

    public function __construct (\view\LoginView $v, \model\loginUser $lu, \view\LayoutView $lv, \model\Session $s) {
        $this->loginView = $v;
        $this->loginUser = $lu;
        $this->layoutView = $lv;
        $this->session = $s;
    }
    
    public function loginUser() {
        if($this->loginView->getRequestUserName() && $this->loginView->getRequestPassword()) {
            $this->loginUser->getCredentials($this->loginView->getRequestUserName(), $this->loginView->getRequestPassword());
            $this->loginUser->matchLogin();
            $this->loginView->validateUserLogin($this->loginUser->isUserLoggedIn());
        }
    }

    public function logoutUser() {
        $this->session->destroySession();
    }

    public function loginWithCookies() {
        $this->loginUser->getCredentials($this->loginUser->getCookieName(), $this->loginUser->getCookiePassword());
    }
}