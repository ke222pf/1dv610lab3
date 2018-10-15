<?php

namespace view;

class GameView {


    public function render() {
        $respone = $this->generateGameHTML();
        return $respone;
    }

    private function generateGameHTML() {
        return '
        ' . $this->generateAlphabetForm() . '
        ';
    }
    private function generateAlphabetForm () {
        $alphabet = range('a', 'z');
        $buttons = '';
        foreach ($alphabet as $letter) {
            $buttons .= '
            <p>
            <form method="POST">
            <button class="button" type="submit" name="letters" value= "'. $letter .'"> '. $letter.'</button>
            </form>
            </p>
            ';
        }
        return $buttons;
    }
}