<?php
/**
 * Created by PhpStorm.
 * User: AndreasAnemyr
 * Date: 2015-11-07
 * Time: 02:56
 */

namespace view;


class LogSessionListSelectable
{
    private $logCollection = Array();

    private $nav;

    public function __construct(\model\LogCollection $logCollection, Navigation $nav)
    {
        $this->logCollection = $logCollection;
        $this->nav = $nav;
    }

    public function getHTML()
    {
        $ret = "<div class=\"panel panel-default\"><div class=\"panel-body\">";
        foreach($this->logCollection->getUniqueIPList() as $ip)
        {
            $ret .= '<h5 class=\"h5\">' . $ip . '<h5>';
            $ret .= $this->RenderSessionButtons($ip);
        }
        return $ret . '</div></div>';
    }

    private function RenderSessionButtons($ip)
    {
        $ret = "</br><table class=\"table\">";
        $ret .= '<thead><tr><td>Press session and analyze...</td></tr></thead>';
        $ret .= '<tbody>';
        foreach($this->logCollection->GetSessionsForSpecificIp($ip) as $sess)
        {
            $ret .= '<tr><td>';
            $ret .= $this->nav->RenderGenericDoButtonWithAction($sess, 'logmanager', 'digdeeper', 'btn-sm btn-link', '&sess=' . $sess  );
            $ret .= '</tr></td>';
        }
        return $ret . '</tbody></table>';
    }
}