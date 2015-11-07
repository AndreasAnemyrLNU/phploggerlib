<?php
/**
 * Created by PhpStorm.
 * User: AndreasAnemyr
 * Date: 2015-11-04
 * Time: 16:54
 */

namespace view;


class Navigation
{




    // Really important. Do Not change!
    private static $staticDo = 'do';
    private static $staticAction = 'action';
    // Really important. Do Not change!
    private static $types =
    [
            'primary',
            'default',
            'success',
            'info',
            'warning',
            'danger'
    ];
    private $do;
    private $action;

    /**
     * Navigation constructor.
     * @param $do
     * @param $action
     */
    public function __construct()
    {
        if(isset($_GET[self::$staticDo]))
            $this->do = $_GET[self::$staticDo];

        if(isset($_GET[self::$staticAction]))
            $this->action = $_GET[self::$staticAction];
    }

    public function DoShowWelcome()
    {
        if(!isset($_GET[self::$staticDo]))
            return true;
    }

    public function DoShowInterface()
    {
        if($this->action === 'interface')
            return true;
    }

    public function DoLogDefaultException()
    {
        if($this->action === 'default')
            return true;
    }

    public function RenderGenericDoButtonWithAction($btnText, $do = false, $action = false, $type = 'primary', $params = false)
    {
        if($do)
            $this->setDo($do);

        if($action)
            $this->setAction($action);

        $url = "";
        if($this->do != '')
            $url   .= self::$staticDo . '=' . $do;
        if($this->action != '')
            $url   .= '&' . self::$staticAction . '=' . $action;
        if($params != false)
            $url = $url . $params;

        return
        "
        <a href='?$url'>
            <button type=\"button\" class=\"btn btn-$type\">$btnText</button>
        </a>
        "
        ;
    }

    public function setDo($do)
    {
        $this->do = $do;
    }

    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @return bool
     * If action is set with an value from the array $types an exception is thrown...
     */
    public function SystemShouldThrowAnException()
    {
        foreach($this->getTypes() as $type)
        {
            if($type === $this->action)
            {
                $exceptionToBeThrown = '\\' . $type . 'Log' . 'Exception';

                throw new $exceptionToBeThrown($type);
            }
        }
        return false;
    }

    public function getTypes()
    {
        return self::$types;
    }

    public function GetLogItem(\model\LogCollection $logCollection)
    {
        foreach($logCollection->getList() as $logItem)
        {
            if($_GET['logitem'] == $logItem->m_microTime)
                return $logItem;
        }
        return null;
    }

    public function DoShowDetailsOfLogItem()
    {
        if($this->action == 'zoom')
            return true;
        return false;
    }

    public function DoShowAllIpAddresseThatExistsInSavedLogCollection()
    {
        //TODO fix string dependencies later.....
        if($this->action === 'iplist')
            return true;
    }

    public function DoShowAllSessionsThatExistsInSavedLogCollection()
    {
        //TODO fix string dependencies later.....
        if($this->action === 'sessionlist')
            return true;
    }

    public function GetLogItemsBySession(\model\LogCollection $logCollection)
    {
        return  $logCollection->GetLogItemsBySess($_GET['sess']);
    }

    public function ClentWantsToDigDeeper()
    {
        if($this->action == 'digdeeper')
            return true;
    }

    private function getDo()
    {
        return $this->do;
    }

    private function  getAction()
    {
        return $this->do;
    }
}
