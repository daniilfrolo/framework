<?php
/**
 * Created by PhpStorm.
 * User: daniu
 * Date: 22.12.2019
 * Time: 16:40
 */

namespace Framework\Factory;


class ContainerFactory
{

    /**
     * @return mixed
     * Заполнение контейнера
     */
    public static function Create()
    {
        $container = require ROOT.'/../config/container.php';
        $container->setTemp(\Framework\Container\Container::class,$container);
        $container->setTemp(\Zend\Diactoros\ServerRequest::class,\Zend\Diactoros\ServerRequestFactory::fromGlobals());
        $container->setTemp(\Framework\Http\Pipeline\Pipeline::class,require ROOT.'/../config/middlewares.php');
        $container->getService(\Framework\Http\Router\Router::class);
        return $container;
    }
}