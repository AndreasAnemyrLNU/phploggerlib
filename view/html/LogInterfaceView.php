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
    public function getHTML()
    {
        return
        "
            <a href='?trigger=\"defaultLog\"'>
               <button type=\"button\" class=\"btn btn-default\">Default</button>
            </a>

            <button type=\"button\" class=\"btn btn-primary\">Primary</button>

            <button type=\"button\" class=\"btn btn-success\">Success</button>

            <button type=\"button\" class=\"btn btn-info\">Info</button>

            <button type=\"button\" class=\"btn btn-warning\">Warning</button>

            <button type=\"button\" class=\"btn btn-danger\">Danger</button>
        ";
    }
}