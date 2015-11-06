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

    private $nav;

    public function __construct(\view\Navigation $nav)
    {
        $this->nav = $nav;
    }

    public function getHTML()
    {

            $ret = "";
            foreach($this->nav->getTypes() as $type)
            {
                $ret .= $this->nav->RenderGenericDoButtonWithAction
                (
                    $type, 'logmanager', $type , $type
                );
            }

        return $ret;
    }

}