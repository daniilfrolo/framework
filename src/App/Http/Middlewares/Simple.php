<?php
/**
 * Created by PhpStorm.
 * User: daniu
 * Date: 08.12.2019
 * Time: 16:15
 */

namespace App\Http\Middlewares;




class Simple
{
    public function process()
    {
        header("Developer: Daniil Frolov");
    }
}