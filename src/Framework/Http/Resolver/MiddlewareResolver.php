<?php
/**
 * Created by PhpStorm.
 * User: daniu
 * Date: 21.12.2019
 * Time: 21:06
 */

namespace Framework\Http\Resolver;


use Framework\Container\Container;
use Framework\Container\ServiceNotFoundException;

class MiddlewareResolver
{
    public function resolve(Container $container, $object)
    {
        $reflection = new \ReflectionClass($object);
        if (!$reflection->hasMethod('process')) throw new ServiceNotFoundException("Middleware ".$object." not found");
        $method=$reflection->getMethod('process');
        $args = $method->getParameters();
        $arguments = [];
        foreach ($args as $arg)
        {
            if ($argclass = $arg->getClass())
            {
                $arguments[] = $container->get($argclass->getName());
                continue;
            }
            if ($arg->isDefaultValueAvailable())
            {
                $arguments[] = $arg->getDefaultValue();
                continue;
            }
            if (!$arg->isOptional())
            {
                throw new ServiceNotFoundException($method->getName()." Can't resolve ".$arg->getName());
            }
        }

        return call_user_func_array([$object,"process"],$arguments);
    }
}