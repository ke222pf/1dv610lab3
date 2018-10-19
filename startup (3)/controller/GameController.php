<?php

namespace controller;

class GameController {

    private $gameView;
    private $getWordFromTextFile;
    private $setSession;
    private $hangMan;

    public function __construct(\view\GameView $gv, \model\ReadTextFile $rtf, \model\Session $s, \model\HangMan $hm) {
        $this->gameView = $gv;
        $this->getWordFromTextFile = $rtf;
        $this->setSession = $s;
        $this->hangMan = $hm;
    }
    
    public function initializeGame () {
        if($this->setSession->hasGameSession()) {
            $this->getWordFromTextFile->readFromTextFile();
            $this->getWordFromTextFile->randomWord();
            $this->gameView->getword($this->setSession->getHangManWord());
            $this->setSession->guessedLetterSession($this->gameView->getGuessedLetter());
            $this->gameView->getPositionOnGuess($this->hangMan->matchLetter());
            $this->gameView->getAllGuesses($this->setSession->AllGuessedLetters());
            $this->gameView->setWrongGuesses($this->setSession->getWrongGuesses());
            $this->gameView->howManyGuesses();
            $this->quitGame();
        }
    }

    public function quitGame() {
        if($this->gameView->getQuitGame()) {
            $this->setSession->destroyGameSession();
        }
    }
}