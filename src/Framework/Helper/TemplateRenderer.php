<?php
/**
 * Created by PhpStorm.
 * User: daniu
 * Date: 22.12.2019
 * Time: 19:51
 */

namespace Framework\Helper;
use Framework\Factory\ContainerFactory;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TemplateRenderer
{
    private $path;
    private $extends;
    private $blockNames;
    private $parameters;
    private $blocks = [];

    public function __construct(array $parameters = [])
    {
        $container = ContainerFactory::Create();
        $this->path = $container->get('temlatePath');
        $this->blockNames=new \SplStack;
        $this->parameters=$parameters;
    }

    public  function render(string $require)
    {
        $loader = new FilesystemLoader($this->path);
        $twig = new Environment($loader);
        $require = preg_replace('/[.]{1}/', '/', $require) . '.php.twig';

        return $twig->render($require);
    }
}