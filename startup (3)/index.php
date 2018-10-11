<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('view/RegisterView.php');
require_once('controller/MainController.php');
require_once('controller/LoginController.php');
require_once('controller/RegisterController.php');
require_once('model/ConnectToDb.php');
require_once('model/LoginUser.php');
require_once('model/Session.php');
//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//CREATE OBJECTS OF THE VIEWS
$rv = new \view\RegisterView();
$s = new \model\Session();
$ctdb = new \model\ConnectToDb();
$lu = new \model\LoginUser($ctdb, $s);
$v = new \view\LoginView();
$dtv = new \view\DateTimeView();
$lv = new \view\LayoutView($v, $dtv, $s, $rv);
$lc = new \controller\LoginController($v, $lu, $lv, $s);
// $rc = new \controller\RegisterController();
$mc = new \controller\MainController($v, $lc, $s, $rv);

$s->startSession();

$mc->validateUserAction();
$lv->render();

