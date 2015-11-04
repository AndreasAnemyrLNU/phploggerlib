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
    private static $table = "LogItem";

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
        //$logItem->m_object = serialize($logItem->m_object);
        //$logItem->m_debugBacktrace = serialize($logItem->m_debugBacktrace);


        var_dump($logItem);

        $stmt = $this->database->prepare
        (

            "INSERT INTO `LogItem`
            (
                `message`, `object`, `debugBacktrace`, `calledFrom`, `microTime`
            )
            VALUES (?, ?, ?, ?, ?)"
        );
        $this->TestSTMT($stmt);

            $message        = $logItem->m_message;
            $object         = serialize($logItem->m_object);
            $debugBacktrace = serialize($logItem->m_debugBacktrace);
            $calledFrom     = $logItem->m_calledFrom;
            $microTime      = $logItem->m_microTime;

        $stmt->bind_param
        (
            'ssssd',
            $message,
            $object,
            $debugBacktrace,
            $calledFrom,
            $microTime
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

        $stmt = $this->database->prepare("SELECT * FROM " . self::$table);
        $this->TestSTMT($stmt);

        $stmt->execute();

        $stmt->bind_result($message, $object, $debugBacktrace, $calledFrom, $microTime);

        while($stmt->fetch())
        {
            $this->logCollection->addLogItem($message, false, false);
        }

        return $this->logCollection;
    }

}