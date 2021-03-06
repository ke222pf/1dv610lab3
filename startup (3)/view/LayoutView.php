<?php

namespace view;

class LayoutView {


  private $dtv;
  private $isLoggedIn;
  private $session;

  private $loginView;
  private $registerView;
  private $gameView;
  private $gameSession;

  private static $register = 'register';
  
  public function __construct (\view\LoginView $lv, \view\DateTimeView $dtv, \model\Session $s,
                               \view\RegisterView $rv, \view\GameView $gv, \model\GameSession $gs) {
    $this->loginView = $lv;
    $this->serverTime = $dtv;
    $this->session = $s;
    $this->registerView = $rv;
    $this->gameView = $gv;
    $this->gameSession = $gs;

  }
  
  public function render() {
    echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <link rel="stylesheet" type="text/css" href="style.css">
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
  
    // depending on user action render view.
    private function renderView() {
      if($this->gameSession->hasGameSession()) {
        return $this->gameView->render();
      } else if($this->session->hasSession()) {
        return $this->loginView->renderLoggedInView($this->session->hasSession());
  
      } else if(isset($_GET[self::$register])) {
        return $this->registerView->renderRegisterView();
  
      } else if(!$this->session->hasSession()) {
        return $this->loginView->response($this->session->hasSession());
  
      }
    }

  private function renderIsLoggedIn() {
    if ($this->session->hasSession()) {
      return '<h2>Logged in</h2>';

    }
    else {
      return '<h2>Not logged in</h2>';

    }
  }

  private function generateLink() {
    if(!$this->session->hasSession()) {

      if(isset($_GET[self::$register])) {
        return '<a href="?">Back to login</a>';
        
      } else {
        return '<a href=?register>Register a new user</a>';
        
      }
    }
  }

  private function registerUser() {
    if(isset($_GET[self::$register])) {
      return '<h2> Register new user</h2>';

    } else {
      return "";

    }
  }
}
