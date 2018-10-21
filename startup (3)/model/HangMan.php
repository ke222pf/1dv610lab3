<?php

namespace model;

class HangMan {

    private $gameSession;

    public function __construct(\model\GameSession $gs) {
        $this->gameSession = $gs;
    }

    // validates if the user has guessed correctly
    public function matchLetter() {
        $word = $this->gameSession->getHangManWord();
        $latestGuess = $this->gameSession->getLastGuess();
        if ($word && $latestGuess ) {
        if(strpbrk($word, $latestGuess)) {
            echo "match!";
        } else {
            $this->gameSession->setWrongGuesses();
            echo "no match!";
        }
    }
    }
}
