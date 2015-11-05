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
    private static $action = "action";

    private static $triggerURL = "trigger";

    private static $logsByIp = "logsbyip";

    private static $logsBySession = "logsbysession";

    private static $testInterface = "testinterface";

    public function GetNameOfTrigger()
    {
        if
        (
            $this->SystemsModeWasSetToLogStuff()
        )
        {
            return $_GET[self::$triggerURL];
        }
        else
        {
            throw new Exception('Not valid get param in url!');
        }
    }

    public function SystemsModeWasSetToLogStuff()
    {
        if
            (
                isset($_GET[self::$triggerURL])
            )

            return true;
    }

    public function ClientWantsToListAllLogsByIp()
    {
        //TODO not true default!
        return true;
    }

    /**
     * @param string $type default, primary, success, info, warning, danger
     * @return html (button)
     */
    public function RenderTriggerButton($type)
    {
        $triggerURL = self::$triggerURL;

        return
        "
        <a href='?$triggerURL=\"$type\"'>
            <button type=\"button\" class=\"btn btn-$type\">$type</button>
        </a>
        "
        ;
    }

    public function RenderActionButtonListAllLogsByIp()
    {
        $action = self::$logsByIp;

        return
        "
        <a href='?action=\"$action\"'>
            <button type=\"button\" class=\"btn btn-primary\">Logs By Ip</button>
        </a>
        "
        ;
    }

    public function RenderActionButtonListAllLogsBySession()
    {
        $action = self::$logsBySession;

        return
            "
        <a href='?action=\"$action\"'>
            <button type=\"button\" class=\"btn btn-primary\">Logs By Session</button>
        </a>
        "
        ;
    }

    public function RenderActionButtonGoToTestInterfce()
    {
        $action = self::$testInterface;

        return
            "
        <a href='?action=\"$action\"'>
            <button type=\"button\" class=\"btn btn-primary\">*Test Interface</button>
        </a>
        "
        ;
    }
}
