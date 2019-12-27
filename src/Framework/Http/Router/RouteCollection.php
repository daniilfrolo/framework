<?php
/**
 * Created by PhpStorm.
 * User: daniu
 * Date: 03.12.2019
 * Time: 21:15
 */

namespace Framework\Http\Router;


use Framework\Container\Container;
use Framework\Http\Router\Route\RegexpRoute;
use Framework\Http\Router\Route\RouteInterface;

class RouteCollection
{

    private $routes = [];

    public function addRouter(RouteInterface $route): void
    {
        $this->routes[] = $route;
    }

    public function any($name, $pattern, $handler, array $tokens = [])
    {
        $this->routes[] = (new RegexpRoute($name, $pattern, $handler, [], $tokens));
        return $this;
    }

    public function get($name, $pattern, $handler, array $tokens = [])
    {
        $this->routes[] = (new RegexpRoute($name, $pattern, $handler, ['GET'], $tokens));
        return $this;
    }

    public function post($name, $pattern, $handler, array $tokens = [])
    {
        $this->routes[] = (new RegexpRoute($name, $pattern, $handler, ['POST'], $tokens));
        return $this;
    }

    public function put($name, $pattern, $handler, array $tokens = [])
    {
        $this->routes[] = (new RegexpRoute($name, $pattern, $handler, ['PUT'], $tokens));
        return $this;
    }

    public function delete($name, $pattern, $handler, array $tokens = [])
    {
        $this->routes[] = (new RegexpRoute($name, $pattern, $handler, ['DELETE'], $tokens));
        return $this;
    }

    public function withTokens(array $tokens = [])
    {
        end($this->routes)->setTokens($tokens) ;
        return $this;
    }

    public function withMiddleware(string $middlewares)
    {

        end($this->routes)->addMiddleware($middlewares);
        return $this;

    }
    /**
     * @return Route[]
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }
}