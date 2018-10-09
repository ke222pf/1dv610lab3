<?php

namespace controller;

class MainController {

    private $loginView;
    private $loginController;

    public function __construct (\view\LoginView $v, \controller\LoginController $lc) {
        $this->loginView = $v;
        $this->loginController = $lc;
    }
    
    public function validateUserAction() {
        if($this->loginView->getLoginAction()) {
            $this->loginController->loginUser();
        }
    }
}