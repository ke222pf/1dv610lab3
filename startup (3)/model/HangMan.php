<?php

namespace model;

class HangMan {

    private $gameSession;

    public function __construct(\model\GameSession $gs) {
        $this->gameSession = $gs;
    }

    // validates if the user has guessed correctly
    public function validateGuessedLetter() {
        $word = $this->gameSession->getHangManWord();
        $latestGuess = $this->gameSession->getLastGuess();
        if ($word && $latestGuess ) {
        if(strpbrk($word, $latestGuess)) {
        } else {
            $this->gameSession->setWrongGuesses();
        }
    }
    }
}
