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

    /**
     * LogManager constructor.
     */
    public function __construct()
    {
        $this->mysqli = $this->DoConnectionToMysql();

        $this->logItemDal = new \model\LogItemDAL($this->mysqli);
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


        return new \view\LogInterfaceView();


        //return $logView = new \view\LogView($logCollection = $this->logItemDal->getLogItemAll());

    }


}