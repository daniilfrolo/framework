<?php
/**
 * Created by PhpStorm.
 * User: daniu
 * Date: 07.12.2019
 * Time: 9:42
 */

namespace Framework\Http;





class MiddlewareResolver
{
    public function resolve($handler,$request)
    {
        if (\is_callable($handler))
        {
            return $handler($request);
        }
        if (\is_object($handler))
        {
            return $handler;
        }
        return null;

    }
}