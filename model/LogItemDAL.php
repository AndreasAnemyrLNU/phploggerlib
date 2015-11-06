<?php
/**
 * Created by PhpStorm.
 * User: AndreasAnemyr
 * Date: 2015-11-04
 * Time: 09:27
 */

namespace model;

/*
	This class uses mysql for presisten storage.
	This query creates an proper table for that purpose.
	A.Anemyr 2015-11-04
	    CREATE TABLE `log`.`LogItem` (
	  `idLogItem` INT NOT NULL AUTO_INCREMENT,
	  `message` VARCHAR(45) NULL,
	  `object` VARCHAR(256) NULL,
	  `debugBacktrace` VARCHAR(128) NULL,
	  `calledFrom` VARCHAR(45) NULL,
	  `microTime` TIMESTAMP(6) NULL,
	  PRIMARY KEY (`idLogItem`));
 */

class LogItemDAL
{
    private static $table = "`LogItem`";

    private $database;

    private $logCollection;

    /**
     * LogItemDAL constructor.
     */
    public function __construct(\mysqli $db)
    {
        $this->database = $db;
    }

    public function CreateLogItem(\model\LogItem $logItem)
    {

        $stmt = $this->database->prepare
        (

            "INSERT INTO". self::$table ."
            (
                `message`, `object`, `debugBacktrace`, `calledFrom`, `microTime`, `superGlobals`, `ip`, `sess`
            )
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
        );
        $this->TestSTMT($stmt);

            $message        = $logItem->m_message;
            $object         = serialize($logItem->m_object);
            $debugBacktrace = serialize($logItem->m_debugBacktrace);
            $calledFrom     = $logItem->m_calledFrom;
            $microTime      = $logItem->m_microTime;
            $superGlobals   = $logItem->m_superGlobals;
            $ip             = $logItem->m_ip;
            $sess           = $logItem->m_sess;

        $stmt->bind_param
        (
            'ssssssss',
            $message,
            $object,
            $debugBacktrace,
            $calledFrom,
            $microTime,
            $superGlobals,
            $ip,
            $sess
        );

        $stmt->execute();
    }

    public function TestSTMT($stmt)
    {
        if($stmt === FALSE)
        {
            throw new \Exception($this->database->error);
        }
    }

    public function ReadLogItemAll()
    {
        $this->logCollection = new \model\LogCollection();

        $stmt = $this->database->prepare("SELECT `message`, `object`, `debugBacktrace`, `calledFrom`, `microTime`, `superGlobals`, `ip`, `sess` FROM " . self::$table);
        $this->TestSTMT($stmt);

        $stmt->execute();

        $stmt->bind_result($message, $object, $debugBacktrace, $calledFrom, $microTime, $superGlobals, $ip, $sess);

        while($stmt->fetch())
        {
            $object = unserialize($object);
            $debugBacktrace = unserialize($debugBacktrace);
            $this->logCollection->addLogItem(
                                                $message,
                                                false,
                                                $object,
                                                $message,
                                                $microTime,
                                                $debugBacktrace,
                                                $superGlobals,
                                                $ip,
                                                $sess
                                            );
        }
        return $this->logCollection;
    }
}

