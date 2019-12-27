<?php /** @noinspection PhpMethodParametersCountMismatchInspection */


namespace Framework\Http\Resolver;


use Framework\Container\Container;

use phpDocumentor\Reflection\Types\String_;
use Zend\Diactoros\ServerRequest;

class Resolver
{
    /**
     * @param $item
     * @param Container $container
     * @return ClosureResolver
     * @throws \ReflectionException
     */
    public function resolve($item, Container $container)
    {
        if ($item instanceof \Closure)
        {

            return (new ClosureResolver())->closureResolve($item);
        }
        if (preg_match("/\w+[:]{2}\w+/",$item))
        {
            list($class,$method) = preg_split("/[:]{2}/",$item);

            if ($object = $container->get($class))
            {

                return (new ObjectResolver())->resolve($container,$object,$method,$container->get(ServerRequest::class));
            }


        }
        if ($result = $container->getMiddleware($item))
        {
            if (\is_string($result))
            {
                return self::resolve($result.'::process',$container);
            }
            $result = $container->get($result);
            return (new MiddlewareResolver())->resolve($container,$result);
        }

    }
}