<?php

namespace controller;

class MainController {

    private $loginView;
    private $loginController;
    private $session;
    private $registerView;
    private $registerController;
    private $gameController;

    public function __construct (\view\LoginView $v, \controller\LoginController $lc, \model\Session $s, \view\RegisterView $rv, \controller\RegisterController $rc, \controller\GameController $gc) {
        $this->loginView = $v;
        $this->loginController = $lc;
        $this->session = $s;
        $this->registerView = $rv;
        $this->registerController = $rc;
        $this->gameController = $gc;
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
            if($this->loginView->getLoginAction() && $this->loginView->ifNoErrorMessages()) {
                $this->loginController->loginUser();
            } 
            if($this->registerView->getRegisterUserAction() && $this->registerView->ifNoErrorMessages()) {
                $this->registerController->registerUser();
            }
        }
        if($this->loginView->getStartGameAction()) {
            $this->session->gameSession();
            $this->gameController->initializeGame();
        }
        if($this->loginView->getLogoutAction()) {
            $this->loginController->logoutUser();
        }
    
    }
}