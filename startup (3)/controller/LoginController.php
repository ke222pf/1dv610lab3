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
            $this->loginView->validateLogin($this->loginUser->isUserLoggedIn());
            $this->loginUser->getCredentials($this->loginView->getRequestUserName(), $this->loginView->getRequestPassword());
            $this->loginUser->matchLogin();
        }
    }

    public function logoutUser() {
        $this->session->destroySession();
    }

    public function loginWithCookies() {
        $this->loginUser->getCredentials($this->loginView->getCookieName(), $this->loginView->getCookiePassword());
    }
}