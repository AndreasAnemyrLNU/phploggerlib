<?php

namespace controller;

/**
 * Created by PhpStorm.
 * User: AndreasAnemyr
 * Date: 2015-11-03
 * Time: 23:26
 */
class LogManager
{
    private $mysqli;

    private $logItemDal;

    private $nav;

    //TODO Cached logcollection...
    private $logCollection;

    /**
     * LogManager constructor.
     */
    public function __construct(\view\Navigation $nav)
    {
        $this->mysqli = $this->DoConnectionToMysql();
        $this->logItemDal = new \model\LogItemDAL($this->mysqli);
        $this->nav = $nav;
        $this->logCollection = $this->logItemDal->ReadLogItemAll();
    }

    private function DoConnectionToMysql()
    {
    $mysqli = new \mysqli
                        (
                            "localhost",
                            "root",
                            "",
                            "log"
                        );

        if(mysqli_connect_errno())
        {
            printf("Connect failed: %s  \n", mysqli_connect_errno());
            exit;
        }

        return $mysqli;
    }

    public function doLogManager()
    {

        return new \view\LogInterfaceView(new \view\Navigation());


                                                                //UC0
                                                                //* System presents a simple interface for logging

        if  (
                $this->nav->SystemsModeWasSetToLogStuff()
            )
        {
                                                                //* Programmer uses a method in the interface to log a message
                                                                //* System stores the message in a log item each time the method is called
                $this->logItemDal->CreateLogItem
                (
                    new \model\LogItem
                    (
                        $this->nav->GetNameOfTrigger(),
                        true,
                        new \Exception("Ohhhho just a test!"),
                        microtime(true),
                        debug_backtrace()
                    )
                );
        }
                                                                //UC1
                                                                //* Administrator wants to se all logs by ip-adress
        if
            (
                $this->nav->ClientWantsToListAllLogsByIp()
            )
        {
            return $logView = new \view\LogView($this->logCollection);
        }








    }


}