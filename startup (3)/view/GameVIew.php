<?php

namespace view;

class GameView {

    private static $quitGame = 'GameView::quitGame';


    private $secretWord;
    private $index;
    private $allUsersGuesses;
    private $renderHangManView;
    private $wrongGuesses;

    public function __construct(\view\RenderHangManView $rhmv) {
        $this->renderHangManView = $rhmv;
    }

    public function render() {
        $respone = $this->generateGameHTML();
        return $respone;
    }

    private function generateGameHTML() {
        return '
        <form method="POST">
        <div class="hangman">
        '. $this->renderHangView() .'
        </div>
        <div class="myLetters"> 
        '. $this->howManyGuesses() .'
        </div>
        ' . $this->generateAlphabetForm() . '
        <div class="quitGame">
        <input type="submit" name="' . self::$quitGame . '" value="Quit Game"/>
        </div>
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
            if($i == $this->index && $this->index != null) {
                $char = $this->getGuessedLetter();
                
            }
        $secretWord .= '
        <ul id="my-word">
        <h1><li>'. $char .'</li></h1>
        </ul>
        ';
        }
        return $secretWord;
    }

    public function setWrongGuesses($wrongGuesses) {
        $this->wrongGuesses = $wrongGuesses;
    }
    public function renderHangView() {
        echo "from render view" . " " .  $this->wrongGuesses;
        switch($this->wrongGuesses) {
            case 1:
             return $this->renderHangManView->failedFirstGuess();
            break;
            case 2:
            return $this->renderHangManView->failedSecondGuess();
            break;
            case 3:
            return $this->renderHangManView->failedThirdGuess();
            break;
            case 4:
            return $this->renderHangManView->failedFourthGuess();
            break;
            case 5:
            return $this->renderHangManView->failedFifthGuess();
            break;
            case 6:
            return $this->renderHangManView->failedSixthGuess();
        break;
        }
    }

    // public function endGame() {
    //     echo "END GAME";
    // }

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