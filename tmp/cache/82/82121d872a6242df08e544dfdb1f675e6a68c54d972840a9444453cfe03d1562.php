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

/* layouts/default.php.twig */
class __TwigTemplate_cf63664f317906336b1c6bc9e172a3a39fafa56d1843354d5bf8e5d765729d53 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'test' => [$this, 'block_test'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "
";
        // line 2
        $this->displayBlock('test', $context, $blocks);
    }

    public function block_test($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo " <h1>Еще</h1>";
    }

    public function getTemplateName()
    {
        return "layouts/default.php.twig";
    }

    public function getDebugInfo()
    {
        return array (  41 => 2,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("
{% block test %} <h1>Еще</h1>{% endblock  %}", "layouts/default.php.twig", "C:\\OSPanel\\domains\\framework\\templates\\layouts\\default.php.twig");
    }
}
