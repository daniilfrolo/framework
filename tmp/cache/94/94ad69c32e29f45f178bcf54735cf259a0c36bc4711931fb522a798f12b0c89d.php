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
class __TwigTemplate_44680bd596cb6526d50bd5483cf40028f3a4bdefd360d084a43369aba73d8040 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'test' => [$this, 'block_test'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "layouts/default.php.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("layouts/default.php.twig", "hello.php.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_test($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 3
        echo "<h1> Тестовый блочек</h1>
    ";
        // line 4
        if (true) {
            // line 5
            echo "        ";
            echo " Удачsdа";
            echo "
    ";
        }
        // line 7
        echo "    ";
        $this->displayParentBlock("test", $context, $blocks);
        echo "
";
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
        return array (  61 => 7,  55 => 5,  53 => 4,  50 => 3,  46 => 2,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends ('layouts/default.php.twig') %}
{% block test %}
<h1> Тестовый блочек</h1>
    {% if true  %}
        {{ ' Удачsdа' }}
    {% endif %}
    {{ parent() }}
{% endblock %}
", "hello.php.twig", "C:\\OSPanel\\domains\\framework\\templates\\hello.php.twig");
    }
}
