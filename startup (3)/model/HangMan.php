<?php

namespace model;

class HangMan {

    private $session;

    public function __construct(\model\Session $s) {
        $this->session = $s;
    }

    public function matchLetter() {
        $word = $this->session->getHangManWord();
        $latestGuess = $this->session->getLastGuess();
        if ($word && $latestGuess ) {
        if(strpbrk($word, $latestGuess)) {
            echo "match!";
        } else {
            $this->session->setWrongGuesses();
            echo "no match!";
        }
    }
        // for($i = 0; $i < count($word); $i++) {
        //     if($word[$i] == $this->session->getLastGuess()) {
        //         echo "correct";
        //         return $i;
        //     } else { echo 'wrong BIATCH!'; }
        // }
    }

    public function wrongGuess () {
        $word = str_split($this->session->getHangManWord());
        for($i = 0; $i < count($word); $i++) {
            if($word[$i] == $this->session->getLastGuess()) {
                
                return true;
            }
        } 
    }
}
