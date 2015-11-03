<?php
/**
 * Created by PhpStorm.
 * User: AndreasAnemyr
 * Date: 2015-11-03
 * Time: 21:55
 */





//Example code
require_once("Logger.php");




loggHeader("write a message");
loggThis("write a message");
loggThis("include call trace", true);
loggThis("include an object", false, new \Exception("foo exception"));

echoLog();