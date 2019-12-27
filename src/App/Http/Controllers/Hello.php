<?php
/**
 * Created by PhpStorm.
 * User: daniu
 * Date: 15.12.2019
 * Time: 18:44
 */

namespace App\Http\Controllers;



use Framework\Helper\TemplateRenderer;
use Framework\Http\Renderer\Renderer;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\ServerRequest;

class Hello
{


    public function __construct()
    {

    }

    public function he(ServerRequest $name)
    {

        $page = (new Renderer())->render('hello',['name'=>'daniil']);
        return new HtmlResponse($page);
    }
}