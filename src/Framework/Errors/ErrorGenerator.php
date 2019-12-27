<?php
/**
 * Created by PhpStorm.
 * User: daniu
 * Date: 26.12.2019
 * Time: 22:57
 */

namespace Framework\Errors;


use Zend\Diactoros\ServerRequest;

class ErrorGenerator
{
    private $request;

    public function __construct(ServerRequest $request)
    {
        $this->request=$request;
    }

    public function class()
    {
        return $this->request;
    }

}