<?php

namespace view;

class LayoutView {

  private $loginView;
  private $dtv;
  private $isLoggedIn;
  private $session;
  private $registerView;
  
  public function __construct (\view\LoginView $lv, \view\DateTimeView $dtv, \model\Session $s, \view\RegisterView $rv) {
    $this->loginView = $lv;
    $this->serverTime = $dtv;
    $this->session = $s;
    $this->registerView = $rv;

  }
  
  public function render() {
    echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Login Example</title>
        </head>
        <body>
          <h1>Assignment 2</h1>
          '. $this->generateLink().'
          ' . $this->renderIsLoggedIn() . '
          ' . $this->registerUser() . '
          <div class="container">
              ' . $this->renderView() . '
              
              ' . $this->serverTime->show() . '
          </div>
         </body>
      </html>
    ';
  }
  
  private function renderIsLoggedIn() {
    if ($this->session->hasSession()) {
      return '<h2>Logged in</h2>';

    }
    else {
      return '<h2>Not logged in</h2>';

    }
  }

  private function renderView() {
    if($this->session->hasSession()) {
      return $this->loginView->renderLoginView($this->session->hasSession());

    } else if(isset($_GET['register'])) {
      return $this->registerView->renderRegisterView();

    } else if(!$this->session->hasSession()) {
      return $this->loginView->response($this->session->hasSession());

    }
  }

  private function generateLink() {
    if(!$this->session->hasSession()) {

      if(isset($_GET["register"])) {
        return '<a href="?">Back to login</a>';
        
      } else {
        return '<a href=?register>Register a new user</a>';
        
      }
    }
  }

  private function registerUser() {
    if(isset($_GET["register"])) {
      return '<h2> Register new user</h2>';

    } else {
      return "";

    }
  }
}
