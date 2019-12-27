<?php
/**
 * Created by PhpStorm.
 * User: daniu
 * Date: 26.12.2019
 * Time: 20:33
 */

namespace Framework\Http\Renderer;


use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigRenderer
{
    private $templatePath;
    private $file;
    private $parameters;

    public function __construct(string $templatePath,string $file,array $parameters=[])
    {
        $this->templatePath = $templatePath;
        $this->file = $file;
        $this->parameters = $parameters;
    }

    public function render()
    {
        $loader = new FilesystemLoader();
        $loader->addPath($this->templatePath);
        $twig = new Environment($loader,[
            "cache" =>"../tmp/cache/",
            "debug" => "../tmp/debug/"

        ]);
        return $twig->render($this->file,$this->parameters).PHP_EOL ;

    }
}