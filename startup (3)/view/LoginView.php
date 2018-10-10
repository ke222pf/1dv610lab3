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

	private $message = '';

	public function response() {
		$response = $this->generateLoginFormHTML();
		return $response;
	}
	
	public function renderLoginView() {
		
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
	
	public function getRequestUserName() {
		if(!empty($_POST[self::$name])) {
			return $_POST[self::$name];
		} else {
			$this->message = "Username is missing";
			return false;
		}
	}

	public function getRequestPassword() {
		if(!empty($_POST[self::$password])) {
			return $_POST[self::$password];
		} else {
			$this->message = "Password is missing";
			return false;
		}
	}

	public function setCookie() {
		setcookie(self::$cookieName, $this->getRequestUserName(), time() + (86400 * 30), "/"); // 86400 = 1 day
		setcookie(self::$cookiePassword, $this->getRequestPassword(), time() + (86400 * 30), "/"); // 86400 = 1 day
	}

	public function getCookieName() {
		return isset($_POST[self::$cookieName]);
	}

	public function getCookiePassword() {
		return isset($_POST[self::$cookiePassword]);
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

	public function logoutMessage() {
		$this->message = "Bye bye!";
	}

	public function validateUserLogin($isUserLoggedIn) {
		if($isUserLoggedIn) {
			$this->message = "Welcome";
		} else {
			$this->message = "Wrong name or password";
		}
	}
}