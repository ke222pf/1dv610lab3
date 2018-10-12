<?php

namespace controller;

class MainController {

    private $loginView;
    private $loginController;
    private $session;
    private $registerView;
    private $registerController;

    public function __construct (\view\LoginView $v, \controller\LoginController $lc, \model\Session $s, \view\RegisterView $rv, \controller\RegisterController $rc) {
        $this->loginView = $v;
        $this->loginController = $lc;
        $this->session = $s;
        $this->registerView = $rv;
        $this->registerController = $rc;
    }
    
    public function validateUserAction() {
        if(!$this->session->hasSession()) {
            if($this->loginView->getCookieName() && $this->loginView->getCookiePassword()) {
                $this->loginController->loginWithCookies();
            }
            if($this->loginView->getKeepLoggedInAction()) {
                $this->loginView->setCookie();
                $this->loginController->loginUser();
            } 
            if($this->loginView->getLoginAction()) {
                $this->loginController->loginUser();
            } 
            if($this->registerView->getRegisterUserAction() && $this->registerView->ifNoErrorMessages()) {
                $this->registerController->registerUser();
            }
        }
        if($this->loginView->getLogoutAction()) {
            $this->loginController->logoutUser();
        }
    
    }
}