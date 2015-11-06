<?php
/**
 * Created by PhpStorm.
 * User: AndreasAnemyr
 * Date: 2015-11-05
 * Time: 11:29
 */

namespace view;


class LogWelcomeView
{

    private $nav;

    public function __construct(\view\Navigation $nav)
    {
        $this->nav = $nav;
    }

    public function getHTML()
    {

        $ret = "Welcome to phpLoggerLig Beta 0.1";


        return $ret;
    }

}