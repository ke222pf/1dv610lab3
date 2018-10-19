<?php

namespace model;


class ReadTextFile {

    private $words_array = array();
    private $session;
    public function __construct(\model\Session $s) {
        $this->session = $s;
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
        if($this->session->isSessionGameEmpty()) {
            $randomizedWord = $this->words_array[array_rand($this->words_array)];
            echo "1knknknknknknknknknkn" . $randomizedWord;
            $this->session->saveHangManWord($randomizedWord);
        }
    }
}
