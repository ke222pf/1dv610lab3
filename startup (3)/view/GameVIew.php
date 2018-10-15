<?php

namespace view;

class GameView {

    const ALPHABET = 26;

    public function render() {
        return $this->generateGameFormHTML();
    }
    public function generateGameFormHTML() {
        return '
        <form method="POST">

        </form>
        ';
    }
    public function generateAlphabet () {
        for ($i = 1; $i < self::NUMBER_OF_LETTER_IN_ALPHABET; $i++) { 
        }
    }
}