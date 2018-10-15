<?php

namespace model;


class ReadTextFile {

    private $words_array = array();
    
    public function readFromTextFile () {
        $fh = fopen('WordsForHangMan.txt','r');
        while ($line = fgets($fh)) {
            $this->words_array []= trim($line);
        }
        fclose($fh);
        // rand(0, count($items) - 1)
    }
    function randomWord() {
        $randomizedWord = $this->words_array[array_rand($this->words_array)];
        return $randomizedWord;
    }
}
