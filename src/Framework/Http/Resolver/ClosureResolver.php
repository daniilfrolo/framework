<?php


namespace Framework\Http\Resolver;


class ClosureResolver
{
    public function closureResolve(\Closure $closure)
    {
        return $closure();
    }
}