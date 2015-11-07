<?php
/**
 * Created by PhpStorm.
 * User: AndreasAnemyr
 * Date: 2015-11-06
 * Time: 15:39
 */

namespace view;


class LogIpListSelectable
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
            $ret .= $this->nav->RenderGenericDoButtonWithAction($ip, 'logmanager', 'sessionlist', 'default');
            $ret .= $this->logCollection->countTracesFoSpecificIp($ip) .
                    ' traces for this ip in ' . $this->logCollection->countSessionsForSpecificIp($ip) .
                    ' different sessions(s)';
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
                $ret .= $this->nav->RenderGenericDoButtonWithAction($sess, 'logmanager', 'digdeeper', 'btn-sm btn-link', false);
                $ret .= '</tr></td>';
            }
        return $ret . '</tbody></table>';
    }

}