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

    const MAXED_GUESSES = 6;

    public function __construct(\view\RenderHangManView $rhmv) {
        $this->renderHangManView = $rhmv;
    }

    // render game.
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
        '. $this->displayFaildTries() .'
        </div>
        <div class="myLetters"> 
        '. $this->displayCorrectlyGuessedLetters() .'
        </div>
        ' . $this->generateAlphabet() . '
        <div class="quitGame">
        <input type="submit" name="' . self::$quitGame . '" value="Quit Game"/>
        </div>
        </form>
        ';
    }

    private function finishedGame() {
        if($this->checkIfCorrectWord()) {
            return '
            <h1>
            You Guessed the correct word!
            </h1>
            ';
        }
    }

    private function maxGuesses() {
        if($this->wrongGuesses == self::MAXED_GUESSES) {
              return '
            <h1>
           game over!
            </h1>
            ';
        }
    }

        // when user guesses wrong letter, display difrent fail views.
        public function displayFaildTries() {
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

    // for each character in the word display a dash
    public function displayCorrectlyGuessedLetters() {
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
            $this->setCorrectGuessCharacter($char);
        }
        return $secretWord;
    }

    // generate a button for each character in the alphabet
    private function generateAlphabet() {
        if(!$this->checkIfCorrectWord() && $this->wrongGuesses < self::MAXED_GUESSES) {

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

    public function getCorrectGuess() {
        return $this->correctGuess;
    }

    private function checkIfCorrectWord() {
        if(strpbrk($this->correctGuessedWord, '-')) {
           return false;
        } else {
            return true;
        }
    }

    public function setCorrectGuessCharacter($char) {
        $this->correctGuess .= $char;
    }

    public function setCorrectWord($correctGuess) {
        $this->correctGuessedWord = $correctGuess;
    }

    public function setWrongGuess($wrongGuesses) {
        $this->wrongGuesses = $wrongGuesses;
    }

    public function setWord($hangManWord) {
        $this->hangManWord = $hangManWord;
    }

    public function setAllGuesses($allUsersGuesses) {
        $this->allUsersGuesses = $allUsersGuesses;
    }
}