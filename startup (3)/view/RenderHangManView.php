<?php

namespace view;

class RenderHangManView {
    // private $hang = array();
    const BLANK_SPACES = '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';

    public function failedFirstGuess() {
       return $hang = '
       <h1>
            --------- <br>
           |/ <br>
           |<br>
           |<br>
           |<br>
           |<br>
          / \<br>
          </h1>
        ';
    }

    public function failedSecondGuess() {
        return $hang = '
        <h1>
            --------- <br>
           |/'. self::BLANK_SPACES .'| <br>
           |          <br>
           |          <br>
           |          <br>
           |          <br>
          / \         <br>
          </h1>
        ';
    }

    public function failedThirdGuess() {
        return $hang = '
        <h1>
            ---------   <br>
           |/'. self::BLANK_SPACES .'|   <br>
           | '. self::BLANK_SPACES .'O   <br>
           | '. self::BLANK_SPACES .'   <br>
           |            <br>
           |            <br>
          / \           <br>
          </h1>
        ';
    }

    public function failedFourthGuess() {
        return $hang = '
        <h1>
            ---------<br>
           |/'. self::BLANK_SPACES .'|<br>
           | '. self::BLANK_SPACES .'O<br>
           | '. self::BLANK_SPACES .'|<br>
           |'. self::BLANK_SPACES .'/<br>
           |         <br>
          / \        <br>
          </h1>
        ';
    }


    public function failedFifthGuess() {
        return $hang = '
        <h1>
            ---------<br>
           |/'. self::BLANK_SPACES .'|<br>
           | '. self::BLANK_SPACES .'O<br>
           | '. self::BLANK_SPACES .'|<br>
           | '. self::BLANK_SPACES .'/ \<br>
           |          <br>
          / \         <br>
          </h1>
        ';
    }

    public function failedSixthGuess() {
        return $hang = '
        <h1>
            ---------<br>
           |/'. self::BLANK_SPACES .'|<br>
           | '. self::BLANK_SPACES .'O<br>
           |'. self::BLANK_SPACES .'--|--<br>
           | '. self::BLANK_SPACES .'/ \<br>
           |          <br>
          / \         <br>
          </h1>
        ';
    }
}