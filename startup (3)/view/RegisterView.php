<?php

namespace view;

class RegisterView {

    private static $registerMessageId = 'RegisterView::Message';
	private static $registerName = 'RegisterView::UserName';
	private static $registerPassword = 'RegisterView::Password';
    private static $registerPasswordRepeat = 'RegisterView::PasswordRepeat';
    private static $registerUser = 'RegisterView::DoRegistration';

    private $regMessage = '';

	public function __construct() {

	}
	public function renderRegisterView() {
		$response = $this->generateRegisterFormHTML();
		return $response;
	}

    private function generateRegisterFormHTML () {
		return '
		<form method="post">
        <fieldset>
					<legend>Register a new user - Write username and password</legend>
					<p id="' . self::$registerMessageId . '">' . $this->regMessage . '</p>
					
					<label for="' . self::$registerName . '">Username :</label>
					<input type="text" size="20"  name="' . self::$registerName . '" value="" id="' . self::$registerName . '" />

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
		} else {
			return "";
		}
    }

	public function getRequestRegPassword() {
		if(isset($_POST[self::$registerPassword])) {
			return $_POST[self::$registerPassword];
		} else {
			return "";
		}
    }

    public function getRequestRegPasswordConformation() {
		$passwordConf = self::$registerPasswordRepeat;
		if(isset($_POST[$passwordConf])) {
			return $_POST[$passwordConf];
		} else {
			return "";
		}
	}
	public function getRegisterUserAction () {
		return isset($_POST[self::$registerUser]);
	}
}