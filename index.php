<?php
session_start();
/**
 * Created by PhpStorm.
 * User: AndreasAnemyr
 * Date: 2015-11-03
 * Time: 21:55
 */

//Example code
require_once("Logger.php");
require_once("model/LogItemDAL.php");
require_once("view/html/HTMLPage.php");
require_once("view/html/LogInterfaceView.php");
require_once("controller/LogManager.php");


$logManagerController = new \controller\LogManager();
$HTMLPage = new view\HTMLPage();

//loggHeader("write a message");
//loggThis("write a message");
//loggThis("include call trace", true);
//loggThis("include an object", false, new \Exception("foo exception"));

//echoLog();

echo $HTMLPage->getHTMLPage($logManagerController->doLogManager()->getHTML());





