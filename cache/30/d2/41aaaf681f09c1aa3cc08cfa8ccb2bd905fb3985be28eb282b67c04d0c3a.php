<?php

/* tools.twig */
class __TwigTemplate_30d241aaaf681f09c1aa3cc08cfa8ccb2bd905fb3985be28eb282b67c04d0c3a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("/utils.twig");

        $this->blocks = array(
            'search' => array($this, 'block_search'),
            'content' => array($this, 'block_content'),
            'breadcrumbs' => array($this, 'block_breadcrumbs'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "/utils.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        ob_start();
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_search($context, array $blocks = array())
    {
    }

    // line 6
    public function block_content($context, array $blocks = array())
    {
        // line 7
        echo "
    ";
        // line 8
        $this->displayBlock('breadcrumbs', $context, $blocks);
        // line 26
        echo "
    ";
        // line 27
        if ((isset($context["model"]) ? $context["model"] : null)) {
            // line 28
            echo "    ";
        }
        // line 29
        echo "    ";
        // line 30
        echo "    <ul id=\"select-cat\">
        ";
        // line 31
        if (((isset($context["link"]) ? $context["link"] : null) == "modification")) {
            // line 32
            echo "            ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["list"]) ? $context["list"] : null));
            foreach ($context['_seq'] as $context["id"] => $context["item"]) {
                // line 33
                echo "                <li>";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "name"), "html", null, true);
                echo " (";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "start_year"), "html", null, true);
                echo " - ";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "end_year"), "html", null, true);
                echo ")</li>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['id'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 35
            echo "        ";
        } else {
            // line 36
            echo "            ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["list"]) ? $context["list"] : null));
            foreach ($context['_seq'] as $context["id"] => $context["item"]) {
                // line 37
                echo "                <li><a href=\"";
                echo twig_escape_filter($this->env, ((((isset($context["uri"]) ? $context["uri"] : null) == "/tools/")) ? (((isset($context["uri"]) ? $context["uri"] : null) . "?")) : ((isset($context["uri"]) ? $context["uri"] : null))), "html", null, true);
                echo "&";
                echo twig_escape_filter($this->env, (isset($context["link"]) ? $context["link"] : null), "html", null, true);
                echo "=";
                echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "name"), "html", null, true);
                echo "</a></li>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['id'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 39
            echo "        ";
        }
        // line 40
        echo "
    </ul>

    <br/>
    ";
        // line 44
        if (((isset($context["uri"]) ? $context["uri"] : null) != "/tools/")) {
            // line 45
            echo "        <a class=\"button red\" href=\"javascript: history.back()\">« Назад</a>
    ";
        }
        // line 47
        echo "    <br/>
    <br/>
    <hr/>
    <br/>
    <a class=\"button green\" href=\"/tools?update_catalog=1\">Обновить каталог</a>
";
    }

    // line 8
    public function block_breadcrumbs($context, array $blocks = array())
    {
        // line 9
        echo "        <div class=\"breadcrumbs\">
            <a class=\"_popup_button\" href=\"/tools/\">Каталог</a>
            ";
        // line 11
        if ((isset($context["cat"]) ? $context["cat"] : null)) {
            // line 12
            echo "                \\ <a class=\"_popup_button\" href=\"/tools/?cat=";
            echo twig_escape_filter($this->env, (isset($context["cat"]) ? $context["cat"] : null), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["current_cat"]) ? $context["current_cat"] : null), (isset($context["cat"]) ? $context["cat"] : null), array(), "array"), "name"), "html", null, true);
            echo "</a>
                ";
            // line 13
            if ((isset($context["mark"]) ? $context["mark"] : null)) {
                // line 14
                echo "                    \\ <a class=\"_popup_button\" href=\"/tools/?cat=";
                echo twig_escape_filter($this->env, (isset($context["cat"]) ? $context["cat"] : null), "html", null, true);
                echo "&mark=";
                echo twig_escape_filter($this->env, (isset($context["mark"]) ? $context["mark"] : null), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["current_mark"]) ? $context["current_mark"] : null), (isset($context["mark"]) ? $context["mark"] : null), array(), "array"), "name"), "html", null, true);
                echo "</a>
                    ";
                // line 15
                if ((isset($context["group"]) ? $context["group"] : null)) {
                    // line 16
                    echo "                      \\  <a class=\"_popup_button\" href=\"/tools/?cat=";
                    echo twig_escape_filter($this->env, (isset($context["cat"]) ? $context["cat"] : null), "html", null, true);
                    echo "&mark=";
                    echo twig_escape_filter($this->env, (isset($context["mark"]) ? $context["mark"] : null), "html", null, true);
                    echo "&group=";
                    echo twig_escape_filter($this->env, (isset($context["group"]) ? $context["group"] : null), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["current_group"]) ? $context["current_group"] : null), (isset($context["group"]) ? $context["group"] : null), array(), "array"), "name"), "html", null, true);
                    echo "</a>
                        ";
                    // line 17
                    if ((isset($context["model"]) ? $context["model"] : null)) {
                        // line 18
                        echo "                            \\  <a class=\"_popup_button\" href=\"/tools/?cat=";
                        echo twig_escape_filter($this->env, (isset($context["cat"]) ? $context["cat"] : null), "html", null, true);
                        echo "&mark=";
                        echo twig_escape_filter($this->env, (isset($context["mark"]) ? $context["mark"] : null), "html", null, true);
                        echo "&group=";
                        echo twig_escape_filter($this->env, (isset($context["group"]) ? $context["group"] : null), "html", null, true);
                        echo "&model=";
                        echo twig_escape_filter($this->env, (isset($context["model"]) ? $context["model"] : null), "html", null, true);
                        echo "\">";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["current_model"]) ? $context["current_model"] : null), (isset($context["model"]) ? $context["model"] : null), array(), "array"), "name"), "html", null, true);
                        echo "</a>
                        ";
                    }
                    // line 20
                    echo "                    ";
                }
                // line 21
                echo "                ";
            }
            // line 22
            echo "            ";
        }
        // line 23
        echo "        </div>
        <br/>
    ";
    }

    public function getTemplateName()
    {
        return "tools.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  191 => 23,  188 => 22,  185 => 21,  182 => 20,  168 => 18,  166 => 17,  155 => 16,  153 => 15,  144 => 14,  142 => 13,  135 => 12,  133 => 11,  129 => 9,  126 => 8,  117 => 47,  113 => 45,  111 => 44,  105 => 40,  102 => 39,  87 => 37,  82 => 36,  79 => 35,  66 => 33,  61 => 32,  59 => 31,  56 => 30,  54 => 29,  51 => 28,  49 => 27,  46 => 26,  44 => 8,  41 => 7,  38 => 6,  33 => 4,  27 => 2,);
    }
}
