<?php
/**
 * Created by PhpStorm.
 * User: strato
 * Date: 13/09/16
 * Time: 20:33
 */

namespace AppBundle\Services;
use Parsedown;




class ParserMarkdown extends Parsedown
{

    var $url;
    private $container;

    public function __construct($urlReadme){
        $this->url = $urlReadme;
    }

    public function parseReadme(){
        // Crea un nuevo recurso cURL
        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //Establecer un tiempo de espera
        curl_setopt( $ch, CURLOPT_TIMEOUT, 5 );
        curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 5 );

        // Captura la URL y la envía al navegador
        $contenido_fichero =  curl_exec($ch);

        //Obtener el código de respuesta
        $httpcode = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
        // Cierrar el recurso cURLy libera recursos del sistema
        curl_close($ch);

        $accepted_response = array( 200);
        if( in_array( $httpcode, $accepted_response ) ) {
            return $this->text($contenido_fichero);
        } else {
            //Recurso local
           return false;
        }
    }

}