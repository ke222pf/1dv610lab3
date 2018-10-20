<?php

namespace view;

class GameView {

    private static $quitGame = 'GameView::quitGame';


    private $hangManWord;
    private $index;
    private $allUsersGuesses;
    private $renderHangManView;
    private $wrongGuesses;
    private $correctGuess;
    private $correctGuessedWord;

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
        '.  $this->finishedGame() .'
        '. $this->maxGuesses().'
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
        if(!$this->checkIfCorrectWord() && $this->wrongGuesses < 6) {

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
        } else  {
            return '';
        }
    }

    public function getGuessedLetter() {
        if(!empty($_POST['guessed'])) {
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
        for ($i = 0; $i < strlen($this->hangManWord); $i++){
            $char = '-';
            for($x = 0; $x < count($allGuesses); $x++) {
                if($this->hangManWord[$i] == $allGuesses[$x]) {
                    $char = $allGuesses[$x];
                }
            }
            $secretWord .= '
            <ul id="my-word">
            <h1><li>'. $char .'</li></h1>
            </ul>
            ';
            $this->setCorrectGuess($char);
        }
        return $secretWord;
    }

    public function setCorrectGuess($char) {
        $this->correctGuess .= $char;
        // echo $char;
    }

    public function getCorrectGuess() {
        return $this->correctGuess;
    }

    public function checkIfCorrectWord() {
        if(strpbrk($this->correctGuessedWord, '-')) {
           return false;
        } else {
            return true;
        }
    }

    public function setCorrectWord ($correctGuess) {
        $this->correctGuessedWord = $correctGuess;
    }

    public function finishedGame() {
        if($this->checkIfCorrectWord()) {
            return '
            <h1>
            You Guessed the correct word!
            </h1>
            ';
        }
    }

    public function maxGuesses() {
        if($this->wrongGuesses == 6) {
              return '
            <h1>
           game over!
            </h1>
            ';
        }
    }

    public function setWrongGuesses($wrongGuesses) {
        $this->wrongGuesses = $wrongGuesses;
    }


    public function renderHangView() {
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

    public function getword($hangManWord) {
        $this->hangManWord = $hangManWord;
    }
    
    public function getPositionOnGuess($i) {
        $this->index = $i;
    }

    public function getAllGuesses($allUsersGuesses) {
        $this->allUsersGuesses = $allUsersGuesses;
    }
}