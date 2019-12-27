<?php
/**
 * Created by PhpStorm.
 * User: daniu
 * Date: 16.12.2019
 * Time: 19:05
 */

namespace Framework\Http;


use Framework\Container\Container;
use http\Exception\InvalidArgumentException;
use Zend\Diactoros\Request;
use Zend\Diactoros\ServerRequest;

class MiddlewaresResolver
{
    public function resolve($handler,$container)
    {

        if (\is_string($handler))
        {

            if (preg_match('/[:]{2}/m',$handler))
            {
                list($controller,$method) = preg_split('/[:]{2}/m',$handler);
                $controller = $container->get($controller);
                $reflex = new  \ReflectionClass($controller);
                $method = $reflex->getMethod($method);
                $params = $method->getParameters();
                $resparams = [];

                foreach ($params as $param)
                {

                    if ($param->isOptional()) {continue;}
                    else if ($param->isDefaultValueAvailable()){ $resparams[] = $param->getDefaultValue();}
                    else if (($param->getClass() !== null))  {
                        if ($res = $container->get($param->getClass()->getName())){ $resparams[] = $res;}
                        else throw new InvalidArgumentException();
                    }
                    else if (array_key_exists($param->getName(),($container->get(ServerRequest::class))->getAttributes())){

                        $resparams[] = ($container->get(ServerRequest::class))->getAttribute($param->getName());
                    }


                }
                $method = $method->getName();
                $func = function () use ($resparams){
                    foreach ($resparams as $resparam)
                    {
                        echo $resparam;
                    }
                };
                return call_user_func_array([$controller,$method],$resparams);




            }
        }
    }
}