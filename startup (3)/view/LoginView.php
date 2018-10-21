<?php

namespace view;

class LoginView {

	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';

	private static $startGame = 'LoginView::StartGame';

	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';

	private static $messageId = 'LoginView::Message';

	const USERNAME_MISSING = "Username is missing";
	const PASSWORD_MISSING = "Password is missing";
	const LOGOUT_MESSAGES = "Bye bye!";
	const LOGIN_WITH_COOKIES = "Welcome back with cookie";
	const DISPLAY_WELCOME_MESSAGE = "Welcome";
	const REMEMBERED_WITH_COOKIES_MESSAGE = "Welcome and you will be remembered";
	const WRONG_CREDENTIALS = "Wrong name or password";


	private $message = '';
	private $isUserLoggedIn;


	// return landing page
	public function response($isUserLogin) {
		if(!$isUserLogin && $this->getLogoutAction()) {
			$this->message = self::LOGOUT_MESSAGES;
			
		}
		$response = $this->generateLoginFormHTML();
		return $response;
	}
	
	public function renderLoggedInView($hasSession) {
		if($this->getCookieName() && $this->getCookiePassword()) {
			$this->message = self::LOGIN_WITH_COOKIES;
			
		} else if ($this->isUserLoggedIn && isset($_POST[self::$keep])) {
			$this->message = self::REMEMBERED_WITH_COOKIES_MESSAGE;
			
		} else if($this->isUserLoggedIn) {
			$this->message = self::DISPLAY_WELCOME_MESSAGE;
		}
		$response = $this->generateLogoutButtonHTML();
		return $response;
	}

	// Generate HTML code on the output buffer for the logout button
	private function generateLoginFormHTML() {
		return '
			<form method="post" > 
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $this->message . '</p>
					
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="'. $this->getRequestUserName() .'" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
					
					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
	}

	// Generate HTML code on the output buffer for the logout button
	private function generateLogoutButtonHTML() {
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $this->message .'</p>
				<input type="submit" name="'. self::$startGame .'" value="Start Game" />
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
	}

	private function getMissingCredentialMessage() {
		if(empty($this->getRequestUserName())) {
			$this->message = self::USERNAME_MISSING;
			
		} else if(empty($this->getRequestPassword())) {
			$this->message = self::PASSWORD_MISSING;
		}
		return $this->message;
	}

	public function ifNoErrorMessages () {
		if(empty($this->getMissingCredentialMessage())) {
			return true;
		}
	}

	// checks if user has successfully logged in.
	public function validateLogin($isUserLoggedIn) {
		$this->isUserLoggedIn = $isUserLoggedIn;
		if($this->isUserLoggedIn == false) {
			$this->message = self::WRONG_CREDENTIALS;
		}
	}

	public function getRequestUserName() {
		if(isset($_POST[self::$name])) {
			return $_POST[self::$name];
		}
	}

	public function getRequestPassword() {
		if(isset($_POST[self::$password])) {
			return $_POST[self::$password];
		}
	}

	public function getLoginAction() {
		return isset($_POST[self::$login]);
	}
	
	public function getLogoutAction() {
		return isset($_POST[self::$logout]);
	}

	public function getKeepLoggedInAction() {
		return isset($_POST[self::$keep]);
	}

	public function getStartGameAction() {
		return isset($_POST[self::$startGame]);
	}

	public function setCookie() {
		setcookie(self::$cookieName, $this->getRequestUserName(), time() + (86400 * 30), "/"); // 86400 = 1 day
		setcookie(self::$cookiePassword, $this->getRequestPassword(), time() + (86400 * 30), "/"); // 86400 = 1 day
	}

	public function getCookieName() {
		return isset($_COOKIE[self::$cookieName]);
	}

	public function getCookiePassword() {
		return isset($_COOKIE[self::$cookiePassword]);
	}
}