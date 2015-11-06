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

    private $view;

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




        if($this->nav->DoShowWelcome())
        {

            $this->view = new \view\LogWelcomeView(new \view\Navigation());
        }

        if($this->nav->DoShowInterface())
        {
            $this->view = new \view\LogInterfaceView(new \view\Navigation());
        }

        if($this->nav->DoShowDetailsOfLogItem())
        {
            $logItem = $this->nav->GetLogItem($this->logCollection);
            $logCollection = new \model\LogCollection();
            $logCollection->addExistingLogItem($logItem);
            $this->view =  new \view\LogView($logCollection, $this->nav);
        }


        try
        {
            if($this->nav->SystemShouldThrowAnException());
        }
        catch (\Exception $e)
        {


            $this->logItemDal->CreateLogItem
                                                (
                                                    new \model\LogItem
                                                    (
                                                        $e->getMessage(),
                                                        true,
                                                        $e,
                                                        microtime(true),
                                                        $e->getTrace()
                                                    )
                                                );

            $this->logCollection = $this->logItemDal->ReadLogItemAll();
            return $logView = new \view\LogView($this->logCollection, $this->nav);
        }
        return $this->view;
    }


}