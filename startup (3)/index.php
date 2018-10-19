<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('view/RegisterView.php');
require_once('view/GameView.php');

require_once('controller/MainController.php');
require_once('controller/LoginController.php');
require_once('controller/RegisterController.php');
require_once('controller/GameController.php');

require_once('model/ConnectToDb.php');
require_once('model/LoginUser.php');
require_once('model/Session.php');
require_once('model/RegisterUserToDb.php');
require_once('model/ReadTextFile.php');
require_once('model/HangMan.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//CREATE OBJECTS OF THE VIEWS

$s = new \model\Session();
$hm = new \model\HangMan($s);
$ctdb = new \model\ConnectToDb();
$lu = new \model\LoginUser($ctdb, $s);
$rudb = new \model\RegisterUserToDb($ctdb);
$rtf = new \model\ReadTextFile($s);

$gv = new \view\GameView();
$rv = new \view\RegisterView($rudb);
$v = new \view\LoginView($lu);
$dtv = new \view\DateTimeView();
$lv = new \view\LayoutView($v, $dtv, $s, $rv, $gv);

$gc = new \controller\GameController($gv, $rtf, $s, $hm);
$rc = new \controller\RegisterController($rv, $rudb);
$lc = new \controller\LoginController($v, $lu, $lv, $s);
$mc = new \controller\MainController($v, $lc, $s, $rv, $rc, $gc);

$s->startSession();

$mc->validateUserAction();
$gc->initializeGame();
$lv->render();

