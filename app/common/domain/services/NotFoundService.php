<?php 

namespace Raledge\Domain\Services;

use Phalcon\Http\Response;

class NotFoundService
{
    public static function NotFound404(){
        $response = new Response();
        $response->setStatusCode(404);
        $response->setJsonContent( ["message" => "url not found."] );
        $response->setContentType("application/json");

        return $response;   
    }
}

?>