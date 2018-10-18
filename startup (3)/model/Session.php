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
    public function gameSession() {
        $_SESSION['activeGame'] = true;
    }

    public function guessedLetterSession($lastGuessedLetter) {
        $_SESSION['guessedLetters'] .= $lastGuessedLetter;
        // var_dump($_SESSION['guessedLetters']);
    }

    public function hasSession() {
        if(isset($_SESSION['username'])) {
            return true;
        }
    }

    public function hasGameSession() {
        if(isset($_SESSION['activeGame'])) {
            return true;
        }
    }

    public function isSessionGameEmpty () {
        if(empty($_SESSION['guessedLetters'])) {
            echo "byt ord";
            return true;
        }
    }

    public function destroySession() {
        unset($_SESSION['username']);
        session_destroy();
    }

    public function destroyGameSession() {
        unset($_SESSION['activeGame']);
        unset($_SESSION['guessedLetters']);
    }
}