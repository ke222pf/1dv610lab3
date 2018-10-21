<?php

namespace model;


class ReadTextFile {

    private $words_array = array();
    private $gameSession;
    public function __construct(\model\gameSession $gs) {
        $this->session = $gs;
    }
    //todo: implement so the same word doesnt repeat itself!
    public function readFromTextFile () {
        $fh = fopen('WordsForHangMan.txt','r');
        while ($line = fgets($fh)) {
            $this->words_array []= trim($line);
        }
        fclose($fh);
    }


    function randomWord() {
        if($this->session->sessionGameEmpty()) {
            $randomizedWord = $this->words_array[array_rand($this->words_array)];
            $this->session->saveHangManWord($randomizedWord);
        }
    }
}
