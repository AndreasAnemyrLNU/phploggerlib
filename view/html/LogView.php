<?php

namespace view;



class LogView {

	private $log;

	private $nav;

	public function __construct(\model\LogCollection $log, \view\Navigation $nav, $details = false) {
		$this->log = $log;
		$this->nav = $nav;
	}

	/**
	* @param boolean $doDumpSuperGlobals
	* @return string HTML
	*/
	public function getHTML($doDumpSuperGlobals = false) {

		if ($doDumpSuperGlobals) {
			$superGlobals = $this->dumpSuperGlobals();
		} else {
			$superGlobals = "";
		}

		$debugItems = "";
		foreach ($this->log->getList() as $item) {
			$debugItems .= $this->showDebugItem($item);
		}
		return "
			<div>
				<h2>Debug</h2>
				<h3>Debug Items</h3>
				<div class=\"panel panel-group\">
					$debugItems
				</div>
		    </div>";
	}

	/**
	* @return string HTML 
	*/
	private function dumpSuperGlobals() {
		$dumps = $this->arrayDump($_GET, "GET");
		$dumps .= $this->arrayDump($_POST, "POST");
		
		$dumps .= $this->arrayDump($_COOKIE, "COOKIES");
		if (isset($_SESSION)) {
			$dumps .= $this->arrayDump($_SESSION, "SESSION");
		}
		$dumps .= $this->arrayDump($_SERVER, "SERVER");

		return $dumps;
	}
	
	/**
	* @return string HTML
	*/
	private function arrayDump($array, $title) {
		$ret = "<h3>$title</h3>

				<ul>";
		foreach ($array as $key => $value) {
			$value = htmlspecialchars($value);
			$ret .= "<li>$key => [$value]</li>";
		}
		$ret .= "</ul>";
		return $ret;
	}
	
	/**
	* @param \model\LogItem $item
	* @return string HTML
	*/
	private function showDebugItem(\model\LogItem $item) {


		if ($item->m_debugBacktrace != null) {
			$debug = "<h4>Trace:</h4>";
			$debug .= "<ul>";
			foreach ($item->m_debugBacktrace AS $key => $row) {

				$debug .= "<li> $key " . \model\LogItem::cleanFilePath($row['file']) . " Line : " . $row["line"] .  "</li>";
			}
			$debug .= "</ul>";
		} else {
			$debug = "";
		}


		if ($item->m_object != null)
			$object = $item->m_object;
		else
			$object = "";

		$date = date("Y-m-d H:i:s", $item->m_microTime);


		$detailsBtn = $this->nav->RenderGenericDoButtonWithAction
		(
			'Details', 'logmanager', 'zoom', 'primary', '&logitem=' . $item->m_microTime
		);

		return	"<div class='panel panel-default'>
					<div class='panel-body bg-$item->m_message'>
						$item->m_message
						$item->m_calledFrom
						$date
						$debug
						$detailsBtn
					</div>
				</div>";
	}
}

