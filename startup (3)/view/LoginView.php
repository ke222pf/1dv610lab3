<?php

namespace view;

class LoginView {

	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';

	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';

	private static $messageId = 'LoginView::Message';

	const USERNAME_MISSING = "Username is missing";
	const PASSWORD_MISSING = "Password is missing";

	private $message = '';
	private $isUserLoggedIn;

	public function response($isUserLogin) {
		if(!$isUserLogin && $this->getLogoutAction()) {
			$this->message = "Bye bye!";
			
		}
		$response = $this->generateLoginFormHTML();
		return $response;
	}
	
	public function renderLoginView($hasSession) {
		if($this->getCookieName() && $this->getCookiePassword()) {
			$this->message = "Welcome back with cookie";
			
		} else if ($this->isUserLoggedIn && isset($_POST[self::$keep])) {
			$this->message = "Welcome and you will be remembered";
			
		} else if($this->isUserLoggedIn) {
			$this->message = "Welcome";
		}
		$response = $this->generateLogoutButtonHTML();
		return $response;
	}
	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLogoutButtonHTML() {
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $this->message .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
	}
	
	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLoginFormHTML() {
		return '
			<form method="post" > 
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $this->message . '</p>
					
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
					
					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
	}
	
	public function getRequestUserName() {
		if(!empty($_POST[self::$name])) {
			return $_POST[self::$name];
		} else {
			throw new \Exception(self::USERNAME_MISSING);
			// $this->message = "Username is missing";
			// return false;
		}
	}

	public function getRequestPassword() {
		if(!empty($_POST[self::$password])) {
			return $_POST[self::$password];
		} else {
			throw new \Exception(self::PASSWORD_MISSING);
			// $this->message = "Password is missing";
			// return false;
		}
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

	public function getLoginAction() {
		return isset($_POST[self::$login]);
	}
	
	public function getLogoutAction() {
		return isset($_POST[self::$logout]);
	}

	public function getKeepLoggedInAction() {
		return isset($_POST[self::$keep]);
	}

	public function validateLogin($isUserLoggedIn) {
		$this->isUserLoggedIn = $isUserLoggedIn;
	}

	public function validateLoginCredentials($getMessage) {
		$this->message = $getMessage;
	}
}