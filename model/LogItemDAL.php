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


    public function getLogItemAll()
    {
        $this->logCollection = new \model\LogCollection();

        $stmt = $this->database->prepare("SELECT * FROM " . self::$table);
        if($stmt === FALSE)
        {
            throw new \Exception($this->database->error);
        }

        $stmt->execute();

        $stmt->bind_result($message, $object, $debugBacktrace, $calledFrom, $microTime);

        while($stmt->fetch())
        {
            $this->logCollection->addLogItem($message, false, false);
        }

        return $this->logCollection;
    }
}