<?php
/**
 * @var \Framework\Http\Router\RouteCollection $routes
 */

$routes->get('index','/',("\App\Http\Controllers\Hello::he"))->withMiddleware("Simple")->withMiddleware("Tv");

