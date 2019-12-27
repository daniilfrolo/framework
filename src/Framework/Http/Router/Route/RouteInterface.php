<?php
/**
 * Created by PhpStorm.
 * User: daniu
 * Date: 04.12.2019
 * Time: 20:22
 */

namespace Framework\Http\Router\Route;


use Framework\Http\Router\Result;
use Psr\Http\Message\ServerRequestInterface;

interface RouteInterface
{
    /**
     * Find Routers that == url
     * @param ServerRequestInterface $request
     * @return Result|null
     */
    public function match(ServerRequestInterface $request): ?Result;

    /**
     * Generate route from name
     * @param $name
     * @param array $params
     * @return string|null
     * @
     */
    public function generate($name, array  $params = []): ?string;
}