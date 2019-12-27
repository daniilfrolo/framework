<?php
/**
 * Created by PhpStorm.
 * User: daniu
 * Date: 07.12.2019
 * Time: 9:31
 */

namespace App\Http\Controllers;


use Psr\Http\Message\RequestInterface;
use Zend\Diactoros\ServerRequest;


class Index
{
    private $test;

    public function __construct(Test $test)
    {
        $this->test=$test;
    }

    public function index()
    {
        return $this->test->test();
    }
}