<?php

/* helpdesk/filters_block.twig */
class __TwigTemplate_c65d446020264acf8c7507207cd57d86 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        ob_start();
        // line 2
        echo "<label>Личные фильтры</label>
    <ul class='personal_filter_list'>
        ";
        // line 4
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["filters"]) ? $context["filters"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["f"]) {
            // line 5
            echo "            ";
            if (($this->getAttribute((isset($context["f"]) ? $context["f"] : null), "user") == (isset($context["admin_id"]) ? $context["admin_id"] : null))) {
                // line 6
                echo "                <li>
                    ";
                // line 7
                if (($this->getAttribute((isset($context["f"]) ? $context["f"] : null), "id") == $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admins"]) ? $context["admins"] : null), (isset($context["admin_id"]) ? $context["admin_id"] : null), array(), "array"), "settings"), "helpdesk_def_filter"))) {
                    // line 8
                    echo "                        <span class=\"selected_by_default\">●</span>
                    ";
                } else {
                    // line 10
                    echo "                        <a title=\"Выбрать по умолчанию\" class=\"select_by_default\" onclick=\"setDefaultFilter('";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["f"]) ? $context["f"] : null), "id"), "html", null, true);
                    echo "')\">●</a>
                    ";
                }
                // line 12
                echo "                    ";
                if (($this->getAttribute((isset($context["f"]) ? $context["f"] : null), "filter") == (isset($context["filter"]) ? $context["filter"] : null))) {
                    // line 13
                    echo "                        <span class=\"current_filter\">";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["f"]) ? $context["f"] : null), "name"), "html", null, true);
                    echo "</span>
                    ";
                } else {
                    // line 15
                    echo "                        <a href=/helpdesk?";
                    echo twig_escape_filter($this->env, (isset($context["get_r"]) ? $context["get_r"] : null), "html", null, true);
                    echo "filter=";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["f"]) ? $context["f"] : null), "filter"), "html", null, true);
                    echo " class=\"filter_name\">";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["f"]) ? $context["f"] : null), "name"), "html", null, true);
                    echo "</a>
                    ";
                }
                // line 16
                echo "<!--
                    -->&nbsp;<span class=\"tickets_count\">";
                // line 17
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["f"]) ? $context["f"] : null), "count"), "html", null, true);
                echo "</span>
                    <a onclick='deleteFilter(";
                // line 18
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["f"]) ? $context["f"] : null), "id"), "html", null, true);
                echo ")' class='delete_filter'>
                        <img src='/stat/img/small_close_black.gif' title='удалить'>
                    </a>
                </li>
            ";
            }
            // line 23
            echo "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['f'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 24
        echo "    </ul>

    <hr>

    <label>Общие фильтры</label>
    <ul class='global_filter_list'>
        ";
        // line 30
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["filters"]) ? $context["filters"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["f"]) {
            // line 31
            echo "            ";
            if (($this->getAttribute((isset($context["f"]) ? $context["f"] : null), "user") == 0)) {
                // line 32
                echo "                <li>
                    ";
                // line 33
                if (($this->getAttribute((isset($context["f"]) ? $context["f"] : null), "id") == $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admins"]) ? $context["admins"] : null), (isset($context["admin_id"]) ? $context["admin_id"] : null), array(), "array"), "settings"), "helpdesk_def_filter"))) {
                    // line 34
                    echo "                        <span class=\"selected_by_default\">●</span>
                    ";
                } else {
                    // line 36
                    echo "                        <a title=\"Выбрать по умолчанию\" class=\"select_by_default\" onclick=\"setDefaultFilter('";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["f"]) ? $context["f"] : null), "id"), "html", null, true);
                    echo "')\">●</a>
                    ";
                }
                // line 38
                echo "                    ";
                if (($this->getAttribute((isset($context["f"]) ? $context["f"] : null), "filter") != (isset($context["filter"]) ? $context["filter"] : null))) {
                    // line 39
                    echo "                        <a href=/helpdesk?";
                    echo twig_escape_filter($this->env, (isset($context["get_r"]) ? $context["get_r"] : null), "html", null, true);
                    echo "filter=";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["f"]) ? $context["f"] : null), "filter"), "html", null, true);
                    echo " class=\"filter_name\">";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["f"]) ? $context["f"] : null), "name"), "html", null, true);
                    echo "</a>
                    ";
                } else {
                    // line 41
                    echo "                        <span class=\"current_filter\">";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["f"]) ? $context["f"] : null), "name"), "html", null, true);
                    echo "</span>
                    ";
                }
                // line 42
                echo "<!--
                    -->&nbsp;<span class=\"tickets_count\">";
                // line 43
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["f"]) ? $context["f"] : null), "count"), "html", null, true);
                echo "</span>
                    <a onclick='deleteFilter(";
                // line 44
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["f"]) ? $context["f"] : null), "id"), "html", null, true);
                echo ")' class='delete_filter'>
                        <img src='/stat/img/small_close_black.gif' title='удалить'>
                    </a>
                </li>
            ";
            }
            // line 49
            echo "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['f'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 50
        echo "    </ul>
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "helpdesk/filters_block.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  157 => 50,  151 => 49,  143 => 44,  139 => 43,  136 => 42,  130 => 41,  120 => 39,  117 => 38,  111 => 36,  107 => 34,  105 => 33,  102 => 32,  99 => 31,  95 => 30,  87 => 24,  81 => 23,  73 => 18,  69 => 17,  66 => 16,  56 => 15,  50 => 13,  47 => 12,  41 => 10,  37 => 8,  35 => 7,  32 => 6,  29 => 5,  25 => 4,  21 => 2,  19 => 1,);
    }
}
