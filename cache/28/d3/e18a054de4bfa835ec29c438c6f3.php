<?php

/* /utils.twig */
class __TwigTemplate_28d3e18a054de4bfa835ec29c438c6f3 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'msg' => array($this, 'block_msg'),
            'navigation' => array($this, 'block_navigation'),
            'personal' => array($this, 'block_personal'),
            'search' => array($this, 'block_search'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        ob_start();
        // line 2
        echo "<!DOCTYPE html>
<html>

<head>
    <meta charset='UTF-8'>
    <link href='/stat/jquery-ui/jquery-ui-1.10.3.custom.min.css' rel='stylesheet' media='screen'>
    <link href='/stat/css/utils.css' rel='stylesheet' media='screen'>
    <link href='/stat/css/print.css' rel='stylesheet' media='print'>
    <link href='/stat/css/";
        // line 10
        echo twig_escape_filter($this->env, (isset($context["dir"]) ? $context["dir"] : null), "html", null, true);
        echo ".css' rel='stylesheet' media='screen'>
    <script src='/stat/js/jquery.min.js'></script>
    <script src='/stat/jquery-ui/jquery-ui-1.10.3.custom.min.js'></script>
    <script src='/stat/js/utils.js'></script>
    <script src='/stat/js/";
        // line 14
        echo twig_escape_filter($this->env, (isset($context["dir"]) ? $context["dir"] : null), "html", null, true);
        echo ".js'></script>
    <link rel='shortcut icon' href='favicon.png' type='image/png'>
    <title>";
        // line 16
        echo twig_escape_filter($this->env, (isset($context["pagename"]) ? $context["pagename"] : null), "html", null, true);
        echo "</title>
</head>

<body>

    <div class='wrapper'>
        ";
        // line 22
        $this->displayBlock('msg', $context, $blocks);
        // line 27
        echo "
        <div class='top-panel'>
            <div class=\"logo\">
                <a href=\"/\"><img src=\"/stat/img/avto-start_logo.png\"/></a>
            </div>
            ";
        // line 32
        $this->displayBlock('navigation', $context, $blocks);
        // line 44
        echo "
            ";
        // line 45
        $this->displayBlock('personal', $context, $blocks);
        // line 51
        echo "
        </div>

        ";
        // line 54
        $this->displayBlock('search', $context, $blocks);
        // line 63
        echo "
        <div class='content'>
            ";
        // line 65
        $this->displayBlock('content', $context, $blocks);
        // line 67
        echo "        </div>

    </div>

    ";
        // line 72
        echo "        ";
        // line 73
        echo "    ";
        // line 74
        echo "</body>

</html>
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 22
    public function block_msg($context, array $blocks = array())
    {
        // line 23
        echo "            ";
        if ((twig_length_filter($this->env, (isset($context["msg"]) ? $context["msg"] : null)) > 0)) {
            // line 24
            echo "                <div class=\"msg ";
            echo twig_escape_filter($this->env, (isset($context["msg_type"]) ? $context["msg_type"] : null), "html", null, true);
            echo "\">";
            echo nl2br(twig_escape_filter($this->env, (isset($context["msg"]) ? $context["msg"] : null), "html", null, true));
            echo "</div>
            ";
        }
        // line 26
        echo "        ";
    }

    // line 32
    public function block_navigation($context, array $blocks = array())
    {
        // line 33
        echo "                <menu class='nav-menu'>
                    ";
        // line 34
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["sections"]) ? $context["sections"] : null));
        foreach ($context['_seq'] as $context["url"] => $context["section"]) {
            // line 35
            echo "                        <li class=\"section ";
            echo ((((isset($context["url"]) ? $context["url"] : null) == (isset($context["dir"]) ? $context["dir"] : null))) ? ("active") : (""));
            echo "\" data-section_name=\"";
            echo twig_escape_filter($this->env, (isset($context["url"]) ? $context["url"] : null), "html", null, true);
            echo "\">
                            <a href=\"/";
            // line 36
            echo twig_escape_filter($this->env, (isset($context["url"]) ? $context["url"] : null), "html", null, true);
            echo "/\">";
            echo twig_escape_filter($this->env, (isset($context["section"]) ? $context["section"] : null), "html", null, true);
            echo "</a>
                            ";
            // line 37
            if ($this->getAttribute((isset($context["notify"]) ? $context["notify"] : null), (isset($context["url"]) ? $context["url"] : null), array(), "array")) {
                // line 38
                echo "                                <span class=\"notify_number\">";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["notify"]) ? $context["notify"] : null), (isset($context["url"]) ? $context["url"] : null), array(), "array"), "html", null, true);
                echo "</span>
                            ";
            }
            // line 40
            echo "                        </li>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['url'], $context['section'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 42
        echo "                </menu>
            ";
    }

    // line 45
    public function block_personal($context, array $blocks = array())
    {
        // line 46
        echo "                <div class='personal'>
                    <span class=\"data\">";
        // line 47
        echo twig_escape_filter($this->env, (isset($context["admin_fio"]) ? $context["admin_fio"] : null), "html", null, true);
        echo "</span>
                    [<a href='/auth.php?stage=exit'>Выход</a>]
                </div>
            ";
    }

    // line 54
    public function block_search($context, array $blocks = array())
    {
        // line 55
        echo "            <div class='searchbox'>
                <form>
                    <input type='search' name='find_text' placeholder='Поиск' autofocus='autofocus'>
                    <input type='submit' id='search_button' value=''/>
                    <input type='hidden' name='stage' value='find'>
                </form>
            </div>
        ";
    }

    // line 65
    public function block_content($context, array $blocks = array())
    {
        // line 66
        echo "            ";
    }

    public function getTemplateName()
    {
        return "/utils.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  196 => 66,  193 => 65,  182 => 55,  179 => 54,  171 => 47,  168 => 46,  165 => 45,  160 => 42,  153 => 40,  147 => 38,  145 => 37,  139 => 36,  132 => 35,  128 => 34,  125 => 33,  122 => 32,  118 => 26,  110 => 24,  107 => 23,  104 => 22,  96 => 74,  94 => 73,  92 => 72,  86 => 67,  84 => 65,  80 => 63,  78 => 54,  73 => 51,  71 => 45,  68 => 44,  66 => 32,  59 => 27,  57 => 22,  48 => 16,  43 => 14,  36 => 10,  26 => 2,  24 => 1,);
    }
}
