<?php
/**
 * Created by PhpStorm.
 * User: AndreasAnemyr
 * Date: 2015-11-04
 * Time: 15:36
 */

namespace view;


class LogInterfaceView
{

    private static $types =
                        [
                            'primary',
                            'default',
                            'success',
                            'info',
                            'warning',
                            'danger'
                        ];
    private $nav;

    public function __construct(\view\Navigation $nav)
    {
        $this->nav = $nav;
    }

    public function getHTML()
    {

            $ret = "";
            foreach(self::$types as $type)
            {
                $ret .= $this->nav->RenderTriggerButton($type);
            }

        return $ret;
    }

}