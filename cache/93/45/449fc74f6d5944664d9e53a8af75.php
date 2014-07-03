<?php

/* dashboard.twig */
class __TwigTemplate_9345449fc74f6d5944664d9e53a8af75 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("utils.twig");

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "utils.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "<div class='widget'>
    <div class='wrapper'>
        <div class='widget-header'>
            <h5>Пользователи</h5>
        </div>

        <div class='widget-content'>
            <table>
                ";
        // line 12
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["statuses"]) ? $context["statuses"] : null));
        foreach ($context['_seq'] as $context["k"] => $context["v"]) {
            // line 13
            echo "                    ";
            if (($this->getAttribute((isset($context["users_cnt"]) ? $context["users_cnt"] : null), (isset($context["k"]) ? $context["k"] : null), array(), "array") > 0)) {
                // line 14
                echo "                        <tr  class='status_";
                echo twig_escape_filter($this->env, (isset($context["k"]) ? $context["k"] : null), "html", null, true);
                echo "'>
                            <td class='l-align'>
                                <a href='/users?status_id=";
                // line 16
                echo twig_escape_filter($this->env, (isset($context["k"]) ? $context["k"] : null), "html", null, true);
                echo "'>";
                echo twig_escape_filter($this->env, (isset($context["v"]) ? $context["v"] : null), "html", null, true);
                echo "</a>:
                            </td>
                            <td class='r-align'>
                                <a href='/users?status_id=";
                // line 19
                echo twig_escape_filter($this->env, (isset($context["k"]) ? $context["k"] : null), "html", null, true);
                echo "'>";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["users_cnt"]) ? $context["users_cnt"] : null), (isset($context["k"]) ? $context["k"] : null), array(), "array"), "html", null, true);
                echo "</a>
                            </td>
                        </tr>
                    ";
            }
            // line 23
            echo "                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['k'], $context['v'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 24
        echo "            </table>
        </div>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "dashboard.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  77 => 24,  71 => 23,  62 => 19,  54 => 16,  48 => 14,  45 => 13,  41 => 12,  31 => 4,  28 => 3,);
    }
}
