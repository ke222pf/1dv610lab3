<?php

namespace model;

class GameSession {

    private $getSessionName;
    private $lastGuessedLetter;

    public function startSession () {
        if(!isset($_SESSION)) {
            session_start();
        }
    }
    public function gameSession() {
        if(!isset($_SESSION['wrongGuesses'])) {
            $_SESSION['wrongGuesses'] = 0;
        }
        $_SESSION['activeGame'] = true;
    }

    public function guessedLetterSession($lastGuessedLetter) {
            $this->lastGuessedLetter = $lastGuessedLetter;
            if(strlen($this->lastGuessedLetter) > 0) {
                echo $this->lastGuessedLetter;
                $_SESSION['guessedLetters'] .= $this->lastGuessedLetter;
            }
    }

    public function AllGuessedLetters() {
        if(isset($_SESSION['guessedLetters'])) {
            return  $_SESSION['guessedLetters'];
        }
    }

    public function getLastGuess() {
        return  $this->lastGuessedLetter;
    }

    public function saveHangManWord($randomizedWord) {
        $_SESSION['word'] = $randomizedWord;
        
    }

    public function getHangManWord() {
        return $_SESSION['word'];
    }


    public function hasGameSession() {
        if(isset($_SESSION['activeGame'])) {
            return true;
        }
    }

    public function isSessionGameEmpty () {
        if(empty($_SESSION['word'])) {
            return true;
        }
    }

    public function setWrongGuesses() {
        $numberOfWrongGuesses = $_SESSION['wrongGuesses'];
        ++$numberOfWrongGuesses;
        $_SESSION['wrongGuesses'] = $numberOfWrongGuesses;
    }

    public function setCorrectGuess($latestGuess) {
        $_SESSION['correctGuesses'] = $latestGuess;
        echo $_SESSION['correctGuesses'];
    }

    public function getCorrectGuess() {
        return $_SESSION['correctGuesses'];
    }

    public function getWrongGuesses() {
        return $_SESSION['wrongGuesses'];
    }


    public function destroyGameSession() {
        unset($_SESSION['activeGame']);
        unset($_SESSION['wrongGuesses']);
        unset($_SESSION['guessedLetters']);
        unset($_SESSION['word']);
        unset($_SESSION['correctGuesses']);
    }
}