<?php
/**
 * Created by PhpStorm.
 * User: daniu
 * Date: 24.11.2019
 * Time: 19:07
 */

namespace Framework\Http;

use Psr\Http\Message\ResponseInterface;

class ResponseSender
{

    public static function send(ResponseInterface $response)
    {
        header(sprintf(
            'HTTP/%s %d %s',
            $response->getProtocolVersion(),
            $response->getStatusCode(),
            $response->getStatusCode()
        ));

        foreach ($response->getHeaders() as $name => $values)
        {
            foreach ($values as $value)
            {
                header(sprintf('%s %s',$name,$value),false);
            }
        }

        return $response->getBody()->getContents();
    }
}