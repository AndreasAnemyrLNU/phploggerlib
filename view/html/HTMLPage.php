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

    private $nav;

    /**
     * HTMLPage constructor.
     */
    public function __construct(\view\Navigation $nav)
    {
        $this->nav = $nav;
    }

    public function getHTMLPage($main)
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
                <nav class=\"navbar navbar-default\">
                  <div class=\"container-fluid\">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class=\"navbar-header\">
                      <button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#bs-example-navbar-collapse-1\" aria-expanded=\"false\">
                    <span class=\"sr-only\">Toggle navigation</span>
                        <span class=\"icon-bar\"></span>
                        <span class=\"icon-bar\"></span>
                        <span class=\"icon-bar\"></span>
                      </button>
                      <a class=\"navbar-brand\" href=\"#\">phpLoggerLib beta 0.1</a>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">
                      <ul class=\"nav navbar-nav\">
                        <li>{$this->nav->RenderActionButtonListAllLogsByIp()}</li>
                        <li>{$this->nav->RenderActionButtonListAllLogsBySession()}</li>
                        <li>{$this->nav->RenderActionButtonGoToTestInterfce()}</li>
                      </ul>
                    </div><!-- /.navbar-collapse -->
                  </div><!-- /.container-fluid -->
                </nav>
                <main class=\"container-fluid well\">
                    $main
                </main>
            </body>
        </html>
        ";
    }
}