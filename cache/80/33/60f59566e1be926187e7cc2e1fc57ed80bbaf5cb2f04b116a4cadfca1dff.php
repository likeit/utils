<?php

/* /utils.twig */
class __TwigTemplate_803360f59566e1be926187e7cc2e1fc57ed80bbaf5cb2f04b116a4cadfca1dff extends Twig_Template
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
    <script src='/lib/jquery.autosize.min.js'></script>
    <script src='/lib/jquery.inputmask.js'></script>
    <script src='/lib/zclip/jquery.zclip.min.js'></script>
    <script src='/stat/js/utils.js'></script>
    ";
        // line 17
        if ((!(isset($context["nojs"]) ? $context["nojs"] : null))) {
            echo "<script src='/stat/js/";
            echo twig_escape_filter($this->env, (isset($context["dir"]) ? $context["dir"] : null), "html", null, true);
            echo ".js'></script>";
        }
        // line 18
        echo "    <link rel='shortcut icon' href='favicon.png' type='image/png'>
    <title>";
        // line 19
        echo twig_escape_filter($this->env, (isset($context["pagename"]) ? $context["pagename"] : null), "html", null, true);
        echo "</title>
</head>

<body>

    <div class='wrapper'>
        ";
        // line 25
        $this->displayBlock('msg', $context, $blocks);
        // line 30
        echo "
        <div class='top-panel'>
            <div class=\"logo\">
                <a href=\"/\"><img src=\"/stat/img/avto-start_logo.png\"/></a>
            </div>
            ";
        // line 35
        $this->displayBlock('navigation', $context, $blocks);
        // line 47
        echo "
            ";
        // line 48
        $this->displayBlock('personal', $context, $blocks);
        // line 54
        echo "
        </div>

        ";
        // line 57
        $this->displayBlock('search', $context, $blocks);
        // line 66
        echo "
        <div class='content'>
            ";
        // line 68
        $this->displayBlock('content', $context, $blocks);
        // line 70
        echo "        </div>

    </div>

    ";
        // line 75
        echo "        ";
        // line 76
        echo "    ";
        // line 77
        echo "</body>

</html>
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 25
    public function block_msg($context, array $blocks = array())
    {
        // line 26
        echo "            ";
        if ((twig_length_filter($this->env, (isset($context["msg"]) ? $context["msg"] : null)) > 0)) {
            // line 27
            echo "                <div class=\"msg ";
            echo twig_escape_filter($this->env, (isset($context["msg_type"]) ? $context["msg_type"] : null), "html", null, true);
            echo "\">";
            echo nl2br(twig_escape_filter($this->env, (isset($context["msg"]) ? $context["msg"] : null), "html", null, true));
            echo "</div>
            ";
        }
        // line 29
        echo "        ";
    }

    // line 35
    public function block_navigation($context, array $blocks = array())
    {
        // line 36
        echo "                <menu class='nav-menu'>
                    ";
        // line 37
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["sections"]) ? $context["sections"] : null));
        foreach ($context['_seq'] as $context["url"] => $context["section"]) {
            // line 38
            echo "                        <li class=\"section ";
            echo ((((isset($context["url"]) ? $context["url"] : null) == (isset($context["dir"]) ? $context["dir"] : null))) ? ("active") : (""));
            echo "\" data-section_name=\"";
            echo twig_escape_filter($this->env, (isset($context["url"]) ? $context["url"] : null), "html", null, true);
            echo "\">
                            ";
            // line 39
            if ($this->getAttribute((isset($context["notify"]) ? $context["notify"] : null), (isset($context["url"]) ? $context["url"] : null), array(), "array")) {
                // line 40
                echo "                                <span class=\"notify_number\">";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["notify"]) ? $context["notify"] : null), (isset($context["url"]) ? $context["url"] : null), array(), "array"), "html", null, true);
                echo "</span>
                            ";
            }
            // line 42
            echo "                            <a href=\"/";
            echo twig_escape_filter($this->env, (isset($context["url"]) ? $context["url"] : null), "html", null, true);
            echo "/\">";
            echo twig_escape_filter($this->env, (isset($context["section"]) ? $context["section"] : null), "html", null, true);
            echo "</a>
                        </li>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['url'], $context['section'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 45
        echo "                </menu>
            ";
    }

    // line 48
    public function block_personal($context, array $blocks = array())
    {
        // line 49
        echo "                <div class='personal'>
                    <span class=\"data\">";
        // line 50
        echo twig_escape_filter($this->env, (isset($context["admin_fio"]) ? $context["admin_fio"] : null), "html", null, true);
        echo "</span>
                    [<a href='/auth.php?stage=exit'>Выход</a>]
                </div>
            ";
    }

    // line 57
    public function block_search($context, array $blocks = array())
    {
        // line 58
        echo "            <div class='searchbox'>
                <form>
                    <input type='search' name='find_text' placeholder='Поиск' autofocus='autofocus'>
                    <input type='submit' id='search_button' value=''/>
                    <input type='hidden' name='stage' value='find'>
                </form>
            </div>
        ";
    }

    // line 68
    public function block_content($context, array $blocks = array())
    {
        // line 69
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
        return array (  202 => 69,  199 => 68,  188 => 58,  185 => 57,  177 => 50,  174 => 49,  171 => 48,  166 => 45,  154 => 42,  148 => 40,  146 => 39,  139 => 38,  135 => 37,  132 => 36,  129 => 35,  125 => 29,  117 => 27,  114 => 26,  111 => 25,  103 => 77,  101 => 76,  99 => 75,  93 => 70,  91 => 68,  87 => 66,  85 => 57,  80 => 54,  78 => 48,  75 => 47,  73 => 35,  66 => 30,  64 => 25,  55 => 19,  52 => 18,  46 => 17,  36 => 10,  26 => 2,  24 => 1,);
    }
}
