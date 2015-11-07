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

        $ret =
        "
            <h4 class=\"h4\">Welcome to phpLoggerLib (Beta 0.1)</h4>
            <p>Start test trace by going to the interace that simulates how exceptions can be saved into a database</p>
        "
        ;


        return $ret;
    }

}