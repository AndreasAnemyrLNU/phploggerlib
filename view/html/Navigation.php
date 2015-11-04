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
    private static $triggerURL = "trigger";

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
}
