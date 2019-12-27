<?php
/**
 * Created by PhpStorm.
 * User: daniu
 * Date: 15.12.2019
 * Time: 16:56
 */

namespace Framework;

use Framework\Container\Container;
use Framework\Http\Pipeline\Pipeline;
use Framework\Http\Resolver\Resolver;
use Framework\Http\Router\Result;
use Framework\Http\Router\Router;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequest;
use Zend\HttpHandlerRunner\Emitter\SapiEmitter;


class Application
{

    private $resolver;
    private $response;
    private $request;
    private $router;
    private $pipeline;
    private $container;
    private $emitter;

    public function __construct(SapiEmitter $emitter, Resolver $resolver, Response $response,Router $router, ServerRequest $request,Pipeline $pipeline,Container $container)
    {
        $this->response=$response;
        $this->resolver=$resolver;
        $this->request = $request;
        $this->router=$router;
        $this->pipeline = $pipeline;
        $this->container=$container;
        $this->emitter=$emitter;
    }

    public function start(): void
    {
        $result = $this->routeRender();
        $this->fillPipelineResult($result);
        $this->resolve();

        $this->emmit();
    }

    private function routeRender()
    {
        $result = $this->router->match();
        $this->fillRequest($result);
        return $result;
    }

    private function fillRequest($result):void
    {
        /**
         * @var ServerRequest $result
         */
        foreach ($result->getAttributes() as $attribute=>$value)
        {
            $this->request = $this->request->withAttribute($attribute,$value);
        }
        $this->container->setTemp(ServerRequest::class,$this->request);

    }

    private function fillPipelineResult(Result $result):void
    {
        $middlewares = $result->getMiddlewares();
        foreach ($middlewares as $middleware)
        {
            $this->pipeline->pipe($middleware);
        }

        $this->pipeline->pipe($result->getHandler());
    }

    public function resolve()
    {
        $this->response = (($this->pipeline)($this->request,"NotFoundHandler")) ;
    }

    public function pipe($middleware)
    {
        $this->pipeline->pipe($middleware);
    }

    public function emmit()
    {
        if ($this->response instanceof ResponseInterface)
        {
            return $this->emitter->emit($this->response);
        }
        return $this->response;

    }



}