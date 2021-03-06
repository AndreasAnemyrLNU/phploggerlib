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
            $this->view =  new \view\LogView($logCollection, $this->nav, true);
        }

        if($this->nav->DoShowAllIpAddresseThatExistsInSavedLogCollection())
        {
            $this->view = new \view\LogIpListSelectable($this->logCollection, $this->nav);
        }

        if($this->nav->DoShowAllSessionsThatExistsInSavedLogCollection())
        {
            $this->view = new \view\LogSessionListSelectable($this->logCollection, $this->nav);
        }

        if($this->nav->ClentWantsToDigDeeper())
        {
            $logCollection = $this->nav->GetLogItemsBySession($this->logCollection);
            $this->view = new \view\LogView($logCollection, $this->nav);
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
                                                        $e->getTrace(),
                                                        $this->GetStateOfRequest(),
                                                        $_SERVER['REMOTE_ADDR'],
                                                        session_id()
                                                    )
                                                );

            $this->logCollection = $this->logItemDal->ReadLogItemAll();
            $tmpLogCollection = new \model\LogCollection();
            $tmpLogCollection->addExistingLogItem($this->logCollection->getLastSaved());
            return $logView = new \view\LogView($tmpLogCollection, $this->nav);
        }
        return $this->view;
    }

    /**
     * @return string
     */
    private function GetStateOfRequest()
    {
        $logView = new \view\LogView($this->logCollection, $this->nav);
        return $logView->dumpSuperGlobals();
    }


}