<?php
/**
 * Created by PhpStorm.
 * User: daniu
 * Date: 26.12.2019
 * Time: 20:26
 */

namespace Framework\Http\Renderer;


use Framework\Factory\ContainerFactory;

class Renderer
{


    private $templatePath;
    private $container;
    private $renderer;


    public function __construct()
    {
        $this->container = ContainerFactory::Create();
        $this->templatePath=$this->container->get('templatePath');
        $this->renderer = $this->container->get('templateRenderer');

    }

    public function render(string $file, array $parameters = [])
    {
        $file = preg_replace('/[.]{1}/','/',$file).'.php.twig';
        if (strtolower($this->renderer) == 'twig')
            return ((new TwigRenderer($this->templatePath,$file,$parameters))->render());
    }
}