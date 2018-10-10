<?php

namespace view;

class LayoutView {

  private $loginView;
  private $dtv;
  private $isLoggedIn;
  private $session;
  
  public function __construct (\view\LoginView $lv, \view\DateTimeView $dtv, \model\Session $s) {
    $this->loginView = $lv;
    $this->serverTime = $dtv;
    $this->session = $s;

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
          ' . $this->renderIsLoggedIn() . '
          
          <div class="container">
              ' . $this->renderLoginPage() . '
              
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

  private function renderLoginPage() {
    if($this->session->hasSession()) {
      return $this->loginView->renderLoginView();
    } else {
      var_dump($this->session->hasSession());
      return $this->loginView->response();
    }
  }
}
