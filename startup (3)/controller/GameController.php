<?php

namespace controller;

class GameController {

    private $gameView;
    private $getWordFromTextFile;

    public function __construct(\view\GameView $gv, \model\ReadTextFile $rtf) {
        $this->gameView = $gv;
        $this->getWordFromTextFile = $rtf;
    }

    public function initializeGame () {
        echo "någon vill spela!";
        $this->getWordFromTextFile->readFromTextFile();
        $this->getWordFromTextFile->randomWord();
        echo($this->getWordFromTextFile->randomWord());
    }
}