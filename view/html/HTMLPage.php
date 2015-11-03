<?php
/**
 * Created by PhpStorm.
 * User: AndreasAnemyr
 * Date: 2015-11-03
 * Time: 22:47
 */

namespace view;

class HTMLPage
{

    public function getHTMLPage()
    {
        return
        "<!DOCTYPE html>
        <html>
            <head>
                <meta charset=\"utf-8\"/>
                <title>phpLoggerLig assignment4 Re-exam</title>
                <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css\">
            </head>
            <body>
                <ul class=\"nav nav-pills\">
                    <li role=\"presentation\"><a href=\"#\">Home</a></li>
                    <li role=\"presentation\"><a href=\"#\">Log</a></li>
                </ul>
            </body>
        </html>
        ";
    }
}