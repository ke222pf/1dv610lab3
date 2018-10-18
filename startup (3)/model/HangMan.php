<?php

namespace model;

class HangMan {

    private $session;

    public function __construct(\model\Session $s) {
        $this->session = $s;
    }

    public function matchLetter() {
        $word = str_split($this->session->getHangManWord());
        for($i = 0; $i < count($word); $i++) {
            if($word[$i] == $this->session->getLastGuess()) {
                echo "match";
                return true;
            }
        }
    }
}
