<?php
/**
 * Created by PhpStorm.
 * User: daniu
 * Date: 08.12.2019
 * Time: 16:55
 */

namespace App\Http\Controllers;


use Zend\Diactoros\Response\HtmlResponse;

class Test
{
    public function test()
    {
        return new HtmlResponse('111222');
    }
}