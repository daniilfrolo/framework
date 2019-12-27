<?php
/**
 * Created by PhpStorm.
 * User: daniu
 * Date: 07.12.2019
 * Time: 20:57
 */

namespace Framework\Http\Pipeline;


use Framework\Container\Container;
use Framework\Http\Resolver\Resolver;
use Psr\Http\Message\ServerRequestInterface;


class Pipeline
{
    private $queue;
    private $container;

    public function __construct(Container $container)
    {
        $this->queue = new \SplQueue();
        $this->container = $container;
    }

    public function pipe($middleware)
    {
        $this->queue->enqueue($middleware);
    }

    public function __invoke(ServerRequestInterface $request, $next)
    {
        while (!$this->queue->isEmpty())
        {
            $delegate = new Next($this->queue,$next);
            $delegate = $delegate($request);
            if ($result = (new Resolver())->resolve($delegate, $this->container)) return $result;

        }


    }


}