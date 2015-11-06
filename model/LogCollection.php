<?php

namespace model;

require_once("LogItem.php");

class LogCollection {
	private $logArray = array();
	

	/**
	* Logging Method
	* @param string $logMessageString The message you intend to log
	* @param mixed $logThisObject An object which state you want to log 
	* @param boolean $includeTrace save callstack
	* @param string $class a userdefined class can be bound to css
	* @return void
	*/
	public function addLogItem
								(
									$string,
									$trace = false,
									$object = null,
									$class = "normal",
									$microtime,
									$debugBactrace,
									$superGlobals = null
								)
	{
		$this->logArray[] = new LogItem($string, $trace, $object, $microtime, $debugBactrace, $superGlobals);
	}

	public function addExistingLogItem(LogItem $logItem)
	{
		$this->logArray[] = $logItem;
	}

	/**
	* @return array of logger/LogItem
	*/
	public function getList() {
		return $this->logArray;
	}
}
