<?php

namespace model;

class Session {

    private $sessionName;
    private $lastGuessedLetter;

    public function startSession () {
        if(!isset($_SESSION)) {
            session_start();
        }
    }

    // set users name to session.
    public function setSessionName($setSessionName) {
        $this->sessionName = $setSessionName;
        $_SESSION['username'] = $this->sessionName;
    }


    public function hasSession() {
        if(isset($_SESSION['username'])) {
            return true;
        }
    }

    public function destroySession() {
        unset($_SESSION['username']);
        session_destroy();
    }
}