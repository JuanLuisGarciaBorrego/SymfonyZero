<?php

namespace AppBundle\Services;

use Parsedown;


class ParserMarkdown extends Parsedown
{

    var $url;

    public function __construct($urlReadme){
        $this->url = $urlReadme;
    }

    public function parseReadmeFile($file = false){
        return $this->text($file);
    }

    public function parseReadmeUrl(){

        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        $content_file = curl_exec($ch);
        $http_code_response = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $accepted_response = array(200);
        if (in_array($http_code_response, $accepted_response)) {
            return $this->text($content_file);
        } else {
            return false;
        }
    }

}