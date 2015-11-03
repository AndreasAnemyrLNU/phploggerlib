<?php
/**
 * Created by PhpStorm.
 * User: AndreasAnemyr
 * Date: 2015-11-03
 * Time: 21:55
 */





//Example code
require_once("Logger.php");
require_once("view/html/HTMLPage.php");


$HTMLPage = new view\HTMLPage();

//loggHeader("write a message");
//loggThis("write a message");
//loggThis("include call trace", true);
//loggThis("include an object", false, new \Exception("foo exception"));

//echoLog();


echo $HTMLPage->getHTMLPage();





