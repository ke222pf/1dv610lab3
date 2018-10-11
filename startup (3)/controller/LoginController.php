<?php

namespace controller;

use Exception;
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
        try {
        if($this->loginView->getRequestUserName() && $this->loginView->getRequestPassword()) {
                $this->loginUser->getCredentials($this->loginView->getRequestUserName(), $this->loginView->getRequestPassword());
                $this->loginUser->matchLogin();
                $this->loginView->validateLogin($this->loginUser->isUserLoggedIn());
                
            }
        } catch(Exception $e) {
            $this->loginView->validateLoginCredentials($e->getMessage());
        }
    }

    public function logoutUser() {
        $this->session->destroySession();
    }

    public function loginWithCookies() {
        $this->loginUser->getCredentials($this->loginView->getCookieName(), $this->loginView->getCookiePassword());
    }
}