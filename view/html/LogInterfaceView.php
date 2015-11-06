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

            $ret .= "
                    <div class=\"panel panel-default\">
                        {$this->RenderExceptionButtons()}
                    </div>
                    <p class=\"text-muted\">
                        ...after yoy've triggerd an exception you can analyze because it's saved into a database....
                    </p>
                    "
                    ;



        return $ret;
    }

    private function RenderExceptionButtons()
    {
        $exceptionButtons = "<p class=\"bg-info\">
                                If you cklick any of these buttons an ecxeption is thrown and also saved into db.
                            </p>";
        foreach($this->nav->getTypes() as $type)
        {
            $exceptionButtons .= $this->nav->RenderGenericDoButtonWithAction
            (
                $type, 'logmanager', $type , $type
            );
        }
        return $exceptionButtons;
    }

}