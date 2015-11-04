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

    /**
     * LogManager constructor.
     */
    public function __construct()
    {
        $this->mysqli = $this->DoConnectionToMysql();
        $this->logItemDal = new \model\LogItemDAL($this->mysqli);
        $this->nav = new \view\Navigation();
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
                                                                //UC0
                                                                //* System presents a simple interface for logging

        if  (
                $this->nav->SystemsModeWasSetToLogStuff()
            )
        {
                                                                //* Programmer uses a method in the interface to log a message
                $this->logItemDal->CreateLogItem
                                                    (
                                                        new \model\LogItem
                                                                            (
                                                                                $this->nav->GetNameOfTrigger(),
                                                                                true,
                                                                                new \Exception("Ohhhho just a test!")
                                                                            )
                                                    );
        }

        return new \view\LogInterfaceView(new \view\Navigation());


        //return $logView = new \view\LogView($logCollection = $this->logItemDal->getLogItemAll());

    }


}