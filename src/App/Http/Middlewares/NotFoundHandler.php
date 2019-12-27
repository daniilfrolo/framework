<?php
/**
 * Created by PhpStorm.
 * User: daniu
 * Date: 15.12.2019
 * Time: 14:12
 */

namespace App\Http\Middlewares;


use Zend\Diactoros\Response\HtmlResponse;

class NotFoundHandler
{
    public function process()
    {
        return new HtmlResponse('Undefined Page', 404);
    }
}