<?php
ignore_user_abort(true);
set_time_limit(0);
ob_start();
/**
 * @var \Framework\Application $app
 * @var \Framework\Container\Container $container
 * @var \Zend\Diactoros\ServerRequest $request
 */

require_once '../vendor/autoload.php';

### Configuration

define('ROOT',__DIR__);


$container = \Framework\Factory\ContainerFactory::Create();

### Inicialization
try{

$app = $container->get(\Framework\Application::class);
$app->start();


}catch (\Exception $exception)
{

    dd($exception->getMessage()) ;
}
header('Connection: '.'close');
header('Content-Length: '.ob_get_length());
ob_end_flush();
ob_flush();
flush();
/**
 * Программа для компиляции любого языка для проекта
 */
//$curl = curl_init();
//$program = "
//var
//x:integer;
//begin
//read(x);
//write(x,  '--- хахахахахахахаха');
//end.
//
//";
//
//$argv = ["LanguageChoice"=>9,
//    "Program"=>$program,
//    "Input"=>"123",
//    "CompilerArgs" =>""
//];
//curl_setopt($curl, CURLOPT_URL, 'https://rextester.com/rundotnet/api');
//curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($curl,CURLOPT_FOLLOWLOCATION, true);
//curl_setopt($curl,CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 YaBrowser/19.12.1.229 Yowser/2.5 Safari/537.36");
//curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,false);
//curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
//curl_setopt($curl,CURLOPT_POST, true);
//curl_setopt($curl,CURLOPT_POSTFIELDS,$argv);
//
//file_put_contents('curl.txt',curl_exec($curl));






