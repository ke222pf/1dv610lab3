<?php

namespace controller;

class GameController {

    private $gameView;
    private $getWordFromTextFile;
    private $gameIsActive;
    private $setSession;

    public function __construct(\view\GameView $gv, \model\ReadTextFile $rtf, \model\Session $s) {
        $this->gameView = $gv;
        $this->getWordFromTextFile = $rtf;
        $this->setSession = $s;
    }

    public function initializeGame () {
        if($this->setSession->hasGameSession()) {
            $this->getWordFromTextFile->readFromTextFile();
            // echo "det finns en session och vill spela spelet";
            $this->gameIsActive = true;
            // $this->getWordFromTextFile->randomWord();
            $this->gameView->getword($this->getWordFromTextFile->randomWord());
            $this->gameView->howManyGuesses();
            $this->setSession->guessedLetterSession($this->gameView->getGuessedLetter());
            if($this->gameView->getQuitGame()) {

                $this->quitGame();
            }
            // echo($this->getWordFromTextFile->randomWord());
            // $this->gameView->getGuessedLetter();
            // echo($this->gameView->getGuessedLetter());
        }
    }

    public function quitGame() {
            $this->setSession->destroyGameSession();
    }
}