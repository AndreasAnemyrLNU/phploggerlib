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
									$superGlobals = null,
									$ip,
									$sess
								)
	{
		$this->logArray[] = new LogItem($string, $trace, $object, $microtime, $debugBactrace, $superGlobals, $ip, $sess);
	}

	public function ReplaceLogCollection($logItems)
	{
		$this->logArray = $logItems;
	}

	/**
	* @return array of logger/LogItem
	*/
	public function getList() {
		return $this->logArray;
	}

	public function getLastSaved()
	{
		return $this->logArray[count($this->logArray) - 1];
	}

	public function getUniqueIPList()
	{
		$ips = Array();
		foreach($this->logArray as $logItem)
		{
			$ips[] = $logItem->m_ip;
		}
		return $ips = array_keys(array_flip($ips));
	}

	public function countTracesFoSpecificIp($ip)
	{
		$sum = 0;
		foreach($this->logArray as $item)
		{
			if($item->m_ip == $ip)
			{
				$sum += 1;
			}
		}
		return $sum;
	}

	public function countSessionsForSpecificIp($ip)
	{
		$sesss = Array();
		foreach($this->logArray as $logItem)
		{
			if($logItem->m_ip == $ip)
			{
				$sesss[] = $logItem->m_sess;
			}
		}
		//Count unique sessions in $sesss[]...
		return count(array_keys(array_flip($sesss)));
	}

	public function GetSessionsForSpecificIp($ip)
	{
		$sesss = Array();
		foreach($this->logArray as $logItem)
		{
			if($logItem->m_ip == $ip)
			{
				$sesss[] = $logItem->m_sess;
			}
		}
		//Return unique sessions in $sesss[]...
		return array_keys(array_flip($sesss));
	}

	public function GetLogItemsBySess($sess)
	{
		$logCollection = new \model\LogCollection();
		foreach($this->logArray as $logItem)
		{
			if($logItem->m_sess == $sess)
				$logCollection->addExistingLogItem($logItem);
		}
		return $logCollection;
	}

	public function addExistingLogItem(LogItem $logItem)
	{
		$this->logArray[] = $logItem;
	}

}
