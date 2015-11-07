<?php
session_start();
/**
 * Created by PhpStorm.
 * User: AndreasAnemyr
 * Date: 2015-11-03
 * Time: 21:55
 */

//phpLogLibber exceptions
require_once("extendException/DangerLogException.php");
require_once("extendException/DefaultLogException.php");
require_once("extendException/InfoLogException.php");
require_once("extendException/PrimaryLogException.php");
require_once("extendException/SuccessLogException.php");
require_once("extendException/WarningLogException.php");

require_once("Logger.php");
require_once("model/LogItemDAL.php");
require_once("view/html/HTMLPage.php");
require_once("view/html/LogWelcome.php");
require_once("view/html/LogInterfaceView.php");
require_once("view/html/LogSessionListSelectable.php");
require_once("view\html\LogIpListSelectable.php");
require_once("controller/LogManager.php");
require_once("view/html/Navigation.php");

$navigation = new \view\Navigation();
$logManagerController = new \controller\LogManager($navigation);
$HTMLPage = new view\HTMLPage($navigation);

echo $HTMLPage->getHTMLPage($logManagerController->doLogManager()->getHTML());





