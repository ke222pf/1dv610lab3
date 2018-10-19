<?php

namespace view;

class GameView {

    private static $quitGame = 'GameView::quitGame';


    private $secretWord;
    private $index;
    private $allUsersGuesses;

    public function render() {
        $respone = $this->generateGameHTML();
        return $respone;
    }

    private function generateGameHTML() {
        return '
        <form method="POST">
        '. $this->howManyGuesses() .'
        ' . $this->generateAlphabetForm() . '
        <input type="submit" name="' . self::$quitGame . '" value="Quit Game"/>
        </form>
        ';
    }

    private function generateAlphabetForm () {
        $alphabet = range('a', 'z');
        $buttons = '';
        foreach ($alphabet as $letter) {
            $buttons .= '
            <ul id="alphabet">
            <li><input class="button" type="submit" name="guessed" value= "'. $letter .'"/></li>
            </p>
            ';
        }
        return $buttons;
    }

    public function getGuessedLetter() {
        if(isset($_POST['guessed'])) {
            return $_POST['guessed'];
        } else {
            return "";
        }
    }

    public function getQuitGame() {
        if(isset($_POST[self::$quitGame])) {
            return $_POST[self::$quitGame];
        }
    }

    public function howManyGuesses() {
        $char = '-';
        $secretWord = "";
        $allGuesses = str_split($this->allUsersGuesses);
        for ($i = 0; $i < strlen($this->secretWord); $i++){
            $char = '-';
            for($x = 0; $x < count($allGuesses); $x++) {
                if($this->secretWord[$i] == $allGuesses[$x]) {
                    $char = $allGuesses[$x];
                }
            }
            echo $this->index;
            if($i == $this->index && $this->index != null) {
                $char = $this->getGuessedLetter();
                
            }
        $secretWord .= '
        <ul id="my-word">
        <li>'. $char .'</li>
        </ul>
        ';
        }
        return $secretWord;
    }

    public function getword($secretWord) {
        $this->secretWord = $secretWord;
    }
    
    public function getPositionOnGuess($i) {
        $this->index = $i;
    }

    public function getAllGuesses($allUsersGuesses) {
        $this->allUsersGuesses = $allUsersGuesses;
    }
}