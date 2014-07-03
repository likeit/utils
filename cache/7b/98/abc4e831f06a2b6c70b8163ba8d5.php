<?php

/* utils.twig */
class __TwigTemplate_7b98abc4e831f06a2b6c70b8163ba8d5 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>

<head>
    <meta charset='UTF-8'>
    <link href='/stat/css/utils.css' rel='stylesheet' media='screen'>
    <link href='/stat/css/";
        // line 7
        echo twig_escape_filter($this->env, (isset($context["dir"]) ? $context["dir"] : null), "html", null, true);
        echo ".css' rel='stylesheet' media='screen'>
    <script src='/stat/js/jquery.min.js'></script>
    <script src='/stat/js/utils.js'></script>
    <script src='/stat/js/";
        // line 10
        echo twig_escape_filter($this->env, (isset($context["dir"]) ? $context["dir"] : null), "html", null, true);
        echo ".js'></script>
    <link rel='shortcut icon' href='favicon.png' type='image/png'>
    <title>";
        // line 12
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["sections"]) ? $context["sections"] : null), (isset($context["dir"]) ? $context["dir"] : null), array(), "array"), "html", null, true);
        echo "</title>
</head>

<body>

    <div class='wrapper'>

        <div class='top-panel'>

            <menu class='nav-menu'>
                ";
        // line 22
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["sections"]) ? $context["sections"] : null));
        foreach ($context['_seq'] as $context["url"] => $context["section"]) {
            // line 23
            echo "                    ";
            if (((isset($context["url"]) ? $context["url"] : null) == (isset($context["dir"]) ? $context["dir"] : null))) {
                // line 24
                echo "                        <li class='active'><a href='/";
                echo twig_escape_filter($this->env, (isset($context["url"]) ? $context["url"] : null), "html", null, true);
                echo "' title='На главную'>";
                echo twig_escape_filter($this->env, (isset($context["section"]) ? $context["section"] : null), "html", null, true);
                echo "</a></li>
                    ";
            } else {
                // line 26
                echo "                        <li><a href=\"/";
                echo twig_escape_filter($this->env, (isset($context["url"]) ? $context["url"] : null), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, (isset($context["section"]) ? $context["section"] : null), "html", null, true);
                echo "</a>
                    ";
            }
            // line 28
            echo "                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['url'], $context['section'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 29
        echo "            </menu>

            <div class='personal'>";
        // line 31
        echo twig_escape_filter($this->env, (isset($context["admin_fio"]) ? $context["admin_fio"] : null), "html", null, true);
        echo " [<a href='/auth.php?stage=exit'>Выход</a>]</div>

            <div class='searchbox'>
                <form>
                    <input type='search' name='find_text' placeholder='Поиск' autofocus='autofocus'>
                    <input type='hidden' name='stage' value='find'>
                </form>
            </div>

        </div>

        <div class='msg \$msg_class'>\$msg</div>

        <div class='content'>
            ";
        // line 45
        $this->displayBlock('content', $context, $blocks);
        // line 47
        echo "        </div>

    </div>

</body>

</html>";
    }

    // line 45
    public function block_content($context, array $blocks = array())
    {
        // line 46
        echo "            ";
    }

    public function getTemplateName()
    {
        return "utils.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  117 => 46,  114 => 45,  104 => 47,  102 => 45,  85 => 31,  81 => 29,  75 => 28,  67 => 26,  59 => 24,  56 => 23,  52 => 22,  39 => 12,  34 => 10,  20 => 1,  77 => 24,  71 => 23,  62 => 19,  54 => 16,  48 => 14,  45 => 13,  41 => 12,  31 => 4,  28 => 7,);
    }
}
