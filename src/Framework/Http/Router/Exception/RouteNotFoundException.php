<?php
/**
 * Created by PhpStorm.
 * User: daniu
 * Date: 03.12.2019
 * Time: 21:40
 */

namespace Framework\Http\Router\Exception;


class RouteNotFoundException extends \LogicException
{

    private $name;
    private $params;

    public function __construct($name, array $params)
    {
        parent::__construct('Route "'.$name.'" not found');
        $this->name = $name;
        $this->params = $params;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getParams(): array
    {
        return $this->params;
    }
}