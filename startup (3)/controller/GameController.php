<?php

namespace controller;

class GameController {

    private $gameView;
    private $getWordFromTextFile;
    private $gameSession;
    private $hangMan;

    public function __construct(\view\GameView $gv, \model\ReadTextFile $rtf, \model\GameSession $gs, \model\HangMan $hm) {
        $this->gameView = $gv;
        $this->getWordFromTextFile = $rtf;
        $this->gameSession = $gs;
        $this->hangMan = $hm;
    }
    
    public function initializeGame () {
        if($this->gameSession->hasGameSession()) {

            $this->getWordFromTextFile->readFromTextFile();
            $this->getWordFromTextFile->randomWord();
                 
            $this->gameView->setWord($this->gameSession->getHangManWord());

            $this->gameSession->guessedLetterSession($this->gameView->getGuessedLetter());

            $this->hangMan->validateGuessedLetter();
            $this->gameView->setAllGuesses($this->gameSession->getAllGuessedLetters());
            $this->gameView->setWrongGuess($this->gameSession->getWrongGuesses());

            $this->gameView->displayCorrectlyGuessedLetters();
            $this->gameSession->setCorrectGuess($this->gameView->getCorrectGuess());
            $this->gameView->setCorrectWord($this->gameSession->getCorrectGuess());

            $this->quitGame();
        }
    }

    public function quitGame() {
        if($this->gameView->getQuitGame()) {
            $this->gameSession->destroyGameSession();
        }
    }
}