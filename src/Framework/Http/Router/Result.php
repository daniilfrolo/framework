<?php
/**
 * Created by PhpStorm.
 * User: daniu
 * Date: 03.12.2019
 * Time: 21:26
 */

namespace Framework\Http\Router;


class Result
{

    private $name;
    private $handler;
    private $attributes;
    private $middleware;

    public function __construct($name, $handler, array $attributes, array $middleware)
    {
        $this->name = $name;
        $this->handler = $handler;
        $this->attributes = $attributes;
        $this->middleware= $middleware;
    }

    /**
     * @return mixed
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getHandler()
    {
        return $this->handler;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }


    public function getMiddlewares(): array
    {
        return $this->middleware;
    }

}