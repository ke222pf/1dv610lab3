<?php

namespace view;

use Exception;

class RegisterView {

    private static $registerMessageId = 'RegisterView::Message';
	private static $registerName = 'RegisterView::UserName';
	private static $registerPassword = 'RegisterView::Password';
    private static $registerPasswordRepeat = 'RegisterView::PasswordRepeat';
    private static $registerUser = 'RegisterView::DoRegistration';

	private $regMessage = '';
	private $savedToDb;
	private $regUserToDb;
	
	const REGUSERNAME_MISSING = "Username has too few characters, at least 3 characters." . '<br>';
	const REGPASSWORD_MISSING = "Password has too few characters, at least 6 characters." . '<br>';
	const MATCH_PASSWORDS = "Passwords do not match." . '<br>';
	const USERNAME_LENGTH = 3;
	const PASSWORD_LENGTH = 6;
	const USERNAME_INVALID_CHARACTERS = "Username contains invalid characters." . '<br>';
	const USERNAME_ALREADY_EXIST = "User exists, pick another username." . '<br>';



	public function __construct(\model\RegisterUserToDb $rudb) {
		$this->regUserToDb = $rudb;
	}

	public function renderRegisterView() {
		if(!empty($_POST)) {
			$this->validateUserRegristration();
			$response = $this->generateRegisterFormHTML();
			return $response;
		} else {
			$response = $this->generateRegisterFormHTML();
			return $response;
		}
	}

    private function generateRegisterFormHTML () {
		return '
		<form method="post">
        <fieldset>
					<legend>Register a new user - Write username and password</legend>
					<p id="' . self::$registerMessageId . '">' . $this->regMessage . '</p>
					
					<label for="' . self::$registerName . '">Username :</label>
					<input type="text" size="20"  name="' . self::$registerName . '" value="'. $this->checkForInvalidCharacters() .'" id="' . self::$registerName . '" />

					<label for="' . self::$registerPassword . '">Password :</label>
					<input type="password" size="20"  name="' . self::$registerPassword . '" id="' . self::$registerPassword . '" />

					<label for="' . self::$registerPasswordRepeat . '">Repeat password  :</label>
					<input type="password" size="20" name="' . self::$registerPasswordRepeat . '" id="' . self::$registerPasswordRepeat . '" />
					
					<input type="submit" id="submit" name="'. self::$registerUser .'" value="register" />
				</fieldset>
        </form>
		';
    }


	public function getRequestRegUserName() {
		if(isset($_POST[self::$registerName])) {
			return $_POST[self::$registerName];
		}
    }

	public function getRequestRegPassword() {
		if(isset($_POST[self::$registerPassword])) {
			return $_POST[self::$registerPassword];
		}
    }

    public function getRequestRegPasswordConformation() {
		$passwordConf = self::$registerPasswordRepeat;
		if(isset($_POST[$passwordConf])) {
			return $_POST[$passwordConf];
		}
	}

	public function getRegisterUserAction () {
		return isset($_POST[self::$registerUser]);
	}

	public function validateUserRegristration() {

		if (strlen($this->getRequestRegUserName()) < self::USERNAME_LENGTH) {
			$this->regMessage = self::REGUSERNAME_MISSING;
		}

		if(strlen($this->getRequestRegPasswordConformation()) < self::PASSWORD_LENGTH) {
			$this->regMessage .= self::REGPASSWORD_MISSING;
		}

		if($this->getRequestRegPassword() != $this->getRequestRegPasswordConformation()) {
			$this->regMessage .= self::MATCH_PASSWORDS;
		}

        if(preg_match('/[^A-Za-z0-9.#\\-$]/', $this->getRequestRegUserName())) {
			$this->regMessage .= self::USERNAME_INVALID_CHARACTERS;
			$this->checkForInvalidCharacters();
		}

		if($this->regUserToDb->checkIfAlreadyExistingUser()) {
			$this->regMessage = self::USERNAME_ALREADY_EXIST;
			// var_dump($this->regUserToDb->checkIfAlreadyExistingUser());
		} 
		if ($this->regUserToDb->checkIfRegistered()){
			$this->regMessage = "Registered new User";
		}
		
		return $this->regMessage;
	}
	
    public function checkForInvalidCharacters() {
        if(preg_match('/[^A-Za-z0-9.#\\-$]/', $this->getRequestRegUserName())) {
            $string = strip_tags($this->getRequestRegUserName());
			return $string;
			
        } else {
			return $this->getRequestRegUserName();
			
        }
	}
	
	public function ifNoErrorMessages() {
		if(empty($this->validateUserRegristration())) {
			return true;
		}
	}

	public function validateRegCredentials($getMessage) {
		$this->regMessage = $getMessage;
	}

	public function getIfRegistered ($savedToDb) {
		return $this->savedToDb = $savedToDb;
	}
}