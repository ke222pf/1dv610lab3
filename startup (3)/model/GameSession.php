<?php

namespace model;

class GameSession {

    private $lastGuessedLetter;

    public function startSession () {
        if(!isset($_SESSION)) {
            session_start();
        }
    }

    // initialize the game session and set wrong guesses to zero.
    public function startGameSession() {
        if(!isset($_SESSION['wrongGuesses'])) {
            $_SESSION['wrongGuesses'] = 0;
        }
        $_SESSION['activeGame'] = true;
    }


    public function guessedLetterSession($lastGuessedLetter) {
        $this->lastGuessedLetter = $lastGuessedLetter;
        $_SESSION['guessedLetters'] .= $this->lastGuessedLetter;
    }


    public function getAllGuessedLetters() {
        if(isset($_SESSION['guessedLetters'])) {
            return  $_SESSION['guessedLetters'];
        }
    }

    // for each guess the a integer increments.
    public function setWrongGuesses() {
        $numberOfWrongGuesses = $_SESSION['wrongGuesses'];
        ++$numberOfWrongGuesses;
        $_SESSION['wrongGuesses'] = $numberOfWrongGuesses;
    }

    // if a user has guessed correct stor it in session.
    public function setCorrectGuess($latestGuess) {
        $_SESSION['correctGuesses'] = $latestGuess;
    }

    public function getLastGuess() {
        return  $this->lastGuessedLetter;
    }

    public function getHangManWord() {
        return $_SESSION['word'];
    }

    public function getCorrectGuess() {
        return $_SESSION['correctGuesses'];
    }

    public function getWrongGuesses() {
        return $_SESSION['wrongGuesses'];
    }

    public function saveHangManWord($randomizedWord) {
        $_SESSION['word'] = $randomizedWord;
        
    }


    public function hasGameSession() {
        if(isset($_SESSION['activeGame'])) {
            return true;
        }
    }

    public function sessionGameEmpty () {
        if(empty($_SESSION['word'])) {
            return true;
        }
    }

    public function destroyGameSession() {
        unset($_SESSION['activeGame']);
        unset($_SESSION['wrongGuesses']);
        unset($_SESSION['guessedLetters']);
        unset($_SESSION['word']);
        unset($_SESSION['correctGuesses']);
    }
}