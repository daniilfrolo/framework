<?php
/**
 * Created by PhpStorm.
 * User: daniu
 * Date: 03.12.2019
 * Time: 21:33
 */

namespace Framework\Http\Router\Exception;


use Psr\Http\Message\ServerRequestInterface;

class RequestNotMatchedException extends  \LogicException
{
    private $request;

    public function __construct(ServerRequestInterface $request)
    {
        parent::__construct('Route not found');
        $this->request = $request;
    }

    public function getRequest(): ServerRequestInterface
    {
        return $this->request;
    }
}