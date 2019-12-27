<?php
/**
 * Created by PhpStorm.
 * User: daniu
 * Date: 04.12.2019
 * Time: 20:30
 */

namespace Framework\Http\Router\Route;


use Framework\Http\Router\Result;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\RequestFactory;
use Zend\Diactoros\ServerRequest;
use Zend\Diactoros\ServerRequestFactory;

class RegexpRoute implements RouteInterface
{
    public $name;
    public $pattern;
    public $handler;
    public $tokens;
    public $methods;
    public $middleware;

    public function __construct($name, $pattern, $handler, array $methods, array $tokens= [], array $middleware = [])
    {
        $this->name=$name;
        $this->pattern=$pattern;
        $this->handler=$handler;
        $this->tokens=$tokens;
        $this->methods=$methods;
        $this->middleware=$middleware;
    }

    public function match( $request): ?Result
    {
        if ($this->methods && !\in_array($request->getMethod(), $this->methods, true))
        {
            return null;
        }

        $pattern = preg_replace_callback('~\{([^\}]+)\}~', function ($matches) {
            $argument = $matches[1];
            $replace = $this->tokens[$argument] ?? '[^}]+';
            return '(?P<'.$argument. '>' . $replace .')';
        }, $this->pattern);


        $path = $request->getUri()->getPath();
        if (preg_match('~^'.$pattern . '$~i', $path, $matches))
        {
            return new Result(
                $this->name,
                $this->handler,
                array_filter($matches, '\is_string', ARRAY_FILTER_USE_KEY),
                $this->middleware
            );
        }

        return null;
    }

    public function  generate($name, array  $params = []): ?string
    {
        $arguments = array_filter($params);

        if ($name !== $this->name)
        {
            return null;
        }

        $url = preg_replace_callback('~\{([^\}]+)\}~', function ($matches) use (&$arguments){
            $argument = $matches[1];
            if(!array_key_exists($argument,$arguments))
            {
                throw new \InvalidArgumentException('Missing parameter"'.$argument.'"');
            }
            return $arguments[$argument];
        }, $this->pattern);

        return $url;
    }

    /**
     * @param array $tokens
     */
    public function setTokens(array $tokens = []): void
    {
        $this->tokens = $tokens;
    }

    /**
     * @param mixed $middleware
     */
    public function addMiddleware(string $middleware): void
    {
        $this->middleware[] = $middleware;
    }

}