<?php

namespace model;

class Session {

    private $getSessionName;

    public function startSession () {
        if(!isset($_SESSION)) {
            session_start();
        }
    }
    public function getSessionName($setSessionName) {
        $this->getSessionName = $setSessionName;
        $_SESSION['username'] = $this->getSessionName;
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