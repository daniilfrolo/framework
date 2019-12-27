<?php
/**
 * Created by PhpStorm.
 * User: daniu
 * Date: 03.12.2019
 * Time: 21:24
 */

namespace Framework\Http\Router;



use Framework\Http\Router\Exception\RequestNotMatchedException;
use Framework\Http\Router\Exception\RouteNotFoundException;

use Framework\Http\Router\Route\RegexpRoute;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\ServerRequestFactory;

class Router
{

    private $routes;

    public function __construct(RouteCollection $routes)
    {
        $this->routes = $routes;
    }

    public function match(): Result
    {
        /** @var RegexpRoute $route */
        $request = ServerRequestFactory::fromGlobals();
        foreach ($this->routes->getRoutes() as $route)
        {

            if ($result = $route->match($request))
            {
                return $result;
            }
        }

        throw new RequestNotMatchedException($request);

    }

    public function generate($name, array  $params = []):string
    {
        /** @var RegexpRoute $route */
        foreach ($this->routes->getRoutes() as $route)
        {
            if (null !== $url = $route->generate($name, array_filter($params)))
            {
                return $url;
            }
        }

        throw new RouteNotFoundException($name,$params);
    }
}