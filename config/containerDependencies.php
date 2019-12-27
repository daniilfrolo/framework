<?php
return [
    "Config"=>[
        "sb"=>["sk"=>'br'],
        "templatePath" => "../templates",
        "templateRenderer" => "Twig"
    ],
    "Dependencies" => [

        "Middlewares" => [
            "Simple" => \App\Http\Middlewares\Simple::class,
            "Tv" => \App\Http\Middlewares\Tv::class,
            "NotFoundHandler"=> \App\Http\Middlewares\NotFoundHandler::class,

        ],

        "Services" => [
            \Zend\Diactoros\ServerRequest::class,
            \Framework\Application::class,
            \Framework\Http\Router\Router::class => function (){
                $routes = new \Framework\Http\Router\RouteCollection();
                require_once 'routes.php';
                return new Framework\Http\Router\Router($routes);
}
        ]
    ]
];