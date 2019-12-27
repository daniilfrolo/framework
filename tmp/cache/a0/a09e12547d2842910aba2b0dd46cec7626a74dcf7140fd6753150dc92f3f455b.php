<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* hello.php.twig */
class __TwigTemplate_307b8f03939ea6f402b562c9f9292cfa9f7e0721a8030dd29338804921d5b8c1 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        if (true) {
            // line 2
            echo " Удачsdа";
            echo "
";
        }
    }

    public function getTemplateName()
    {
        return "hello.php.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% if true  %}
{{ ' Удачsdа' }}
{% endif %}", "hello.php.twig", "C:\\OSPanel\\domains\\framework\\templates\\hello.php.twig");
    }
}
