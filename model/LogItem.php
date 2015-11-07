<?php

namespace model;

class LogItem {
	//Maybe add some information hiding
	/**
	* @var String
	*/
	public $m_message;

	/**
	* @var mixed or null
	*/
	public $m_object;

	/**
	* @var array From debug_backtrace or null
	*/
	public $m_debugBacktrace;


	/**
	* @var String script location
	*/
	public $m_calledFrom;

	/**
	* @var Unix microtime 
	* see http://se1.php.net/manual/en/function.microtime.php
	*/
	public $m_microTime;

	public $m_superGlobals;

	public $m_ip;

	public $m_sess;

	public function __construct	(
									$logMessageString,
									$includeTrace = false,
									$logThisObject = null,
									$microTime = null,
									$debug_backtrace = null,
									$superGlobals = null,
									$ip,
									$sess
								)
	{

		$this->m_message = $logMessageString;

		if ($logThisObject != null)
			$this->m_object = var_export($logThisObject, true);

		if($debug_backtrace === null)
		{
			$this->m_debugBacktrace = debug_backtrace();
		}
		else
		{
			$this->m_debugBacktrace = $debug_backtrace;
		}


		if($microTime === null)
		{
			$this->m_microTime = microtime();
		}
		else
		{
			$this->m_microTime = $microTime;
		}

		$this->m_calledFrom = $this->cleanFilePath($this->m_debugBacktrace[0]["file"]) . " " . $this->m_debugBacktrace[0]["line"];

		if($superGlobals === null)
		{
			$this->m_superGlobals = '';
		}
		else
		{
			$this->m_superGlobals = $superGlobals;
		}

		//TODO Check if these are ok to be in a class of type model. Don´t know for now....
		$this->m_ip = $ip;
		$this->m_sess = $sess;
	}
	
	/**
	* removes full path
	* @param $path String the url of a script
	* @return string a path
	*/
	public static function cleanFilePath($path) {
		if (isset($_SERVER["CONTEXT_DOCUMENT_ROOT"]))
			return substr($path, strlen($_SERVER["CONTEXT_DOCUMENT_ROOT"]));
		
		$fullLength = strlen($_SERVER["SCRIPT_FILENAME"]); //P:/php/2013 secret/phpLoggerLib/example.php
		$partLength = strlen($_SERVER["PHP_SELF"]); // /2013secret/phpLoggerLib/example.php

		return substr($path, $fullLength - $partLength);
	}

	public function HasEqualsSess(LogItem $logItem)
	{
		if($this->m_sess == $logItem->m_sess)
		{
			return true;
		}

		return false;
	}

}