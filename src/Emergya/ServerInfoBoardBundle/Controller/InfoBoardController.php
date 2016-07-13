<?php

namespace Emergya\ServerInfoBoardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use COM;

class InfoBoardController extends Controller
{
    public function indexAction()
    {
        $cpu_load = $this->get_server_load();
        return $this->render('EmergyaServerInfoBoardBundle:InfoBoard:index.html.twig',
            array(
                "cpu_load" => $cpu_load
            )
        );
    }

    private function get_server_load() {
        if (stristr(PHP_OS, 'win')) {
            $wmi = new COM("Winmgmts://");
            $server = $wmi->execquery("SELECT LoadPercentage FROM Win32_Processor");

            $cpu_num = 0;
            $load_total = 0;

            foreach($server as $cpu){
                $cpu_num++;
                $load_total += $cpu->loadpercentage;
            }
            $load = round($load_total/$cpu_num);
        } else {
            $sys_load = sys_getloadavg();
            $load = $sys_load[0];
        }
        return (int) $load;
    }
}
