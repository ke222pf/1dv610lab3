<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('view/RegisterView.php');
require_once('view/GameView.php');
require_once('view/RenderHangManView.php');

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
require_once('model/GameSession.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'off');

//CREATE OBJECTS OF THE VIEWS

$s = new \model\Session();
$gs = new \model\GameSession();
$hm = new \model\HangMan($gs);
$ctdb = new \model\ConnectToDb();
$lu = new \model\LoginUser($ctdb, $s);
$rudb = new \model\RegisterUserToDb($ctdb);
$rtf = new \model\ReadTextFile($gs);

$rgmv = new \view\RenderHangManView();
$gv = new \view\GameView($rgmv);
$rv = new \view\RegisterView($rudb);
$v = new \view\LoginView($lu);
$dtv = new \view\DateTimeView();
$lv = new \view\LayoutView($v, $dtv, $s, $rv, $gv, $gs);

$gc = new \controller\GameController($gv, $rtf, $gs, $hm);
$rc = new \controller\RegisterController($rv, $rudb);
$lc = new \controller\LoginController($v, $lu, $lv, $s);
$mc = new \controller\MainController($v, $lc, $s, $rv, $rc, $gc, $gs);

$s->startSession();

$mc->validateUserAction();
$gc->initializeGame();
$lv->render();

