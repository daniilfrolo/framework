<?php
/**
 * Created by PhpStorm.
 * User: daniu
 * Date: 15.12.2019
 * Time: 12:31
 */

namespace Framework\Http\Pipeline;


use Psr\Http\Message\ServerRequestInterface;

class Next
{

    private $default;
    private $queue;

    public function __construct(\SplQueue $queue, $default)
    {
        $this->default = $default;
        $this->queue=$queue;
    }

    public function __invoke(ServerRequestInterface $request)
    {
        if($this->queue->isEmpty())
        {
            return ($this->default)($request);
        }
        $current = $this->queue->dequeue();

        return $current;

    }
}