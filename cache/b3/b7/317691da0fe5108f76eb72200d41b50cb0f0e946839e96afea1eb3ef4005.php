<?php

/* helpdesk/ticket_edit_comments.twig */
class __TwigTemplate_b3b7317691da0fe5108f76eb72200d41b50cb0f0e946839e96afea1eb3ef4005 extends Twig_Template
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
        echo "    ";
        $context["comments_count"] = twig_length_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "comments"));
        // line 2
        echo "    ";
        $context["autocomments_count"] = 0;
        // line 3
        echo "    ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "comments"));
        foreach ($context['_seq'] as $context["_key"] => $context["comment"]) {
            // line 4
            echo "        ";
            if (($this->getAttribute((isset($context["comment"]) ? $context["comment"] : null), "autocomment") == true)) {
                // line 5
                echo "            ";
                $context["autocomments_count"] = ((isset($context["autocomments_count"]) ? $context["autocomments_count"] : null) + 1);
                // line 6
                echo "        ";
            }
            // line 7
            echo "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['comment'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 8
        echo "
    ";
        // line 9
        if (((isset($context["comments_count"]) ? $context["comments_count"] : null) > 0)) {
            // line 10
            echo "        ";
            // line 11
            echo "            ";
            // line 12
            echo "        ";
            // line 13
            echo "            <span class=\"cutter pic\"></span>
            <label class=\"comments cutter\">Комментарии</label>

            <span class='cut_info'> (";
            // line 16
            echo twig_escape_filter($this->env, ((isset($context["comments_count"]) ? $context["comments_count"] : null) - (isset($context["autocomments_count"]) ? $context["autocomments_count"] : null)), "html", null, true);
            echo "):</span>
            <a class=\"button_show_autocomments\">
                <span class=\"showed_autocomments_text\">скрыть историю изменений</span>
                <span class=\"hidden_autocomments_text\">показать всю историю</span>
            </a>
            <span class='cut_info'> (";
            // line 21
            echo twig_escape_filter($this->env, (isset($context["autocomments_count"]) ? $context["autocomments_count"] : null), "html", null, true);
            echo ")</span>

            <div class=\"cut\">
                ";
            // line 24
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "comments"));
            foreach ($context['_seq'] as $context["id"] => $context["comment"]) {
                // line 25
                echo "                    ";
                if (((isset($context["id"]) ? $context["id"] : null) < (isset($context["comments_count"]) ? $context["comments_count"] : null))) {
                    // line 26
                    echo "                        <div class=\"";
                    echo ((($this->getAttribute((isset($context["comment"]) ? $context["comment"] : null), "creator") == (isset($context["admin_id"]) ? $context["admin_id"] : null))) ? ("my") : (""));
                    echo " comment ";
                    echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["comment"]) ? $context["comment"] : null), "autocomment")) ? (strtr($this->getAttribute((isset($context["comment"]) ? $context["comment"] : null), "autocomment"), array("1" => "autocomment"))) : ("")), "html", null, true);
                    echo "\">
                            <label class=\"commentator\">";
                    // line 27
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["users"]) ? $context["users"] : null), $this->getAttribute((isset($context["comment"]) ? $context["comment"] : null), "creator"), array(), "array"), "lastname"), "html", null, true);
                    echo " ";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["users"]) ? $context["users"] : null), $this->getAttribute((isset($context["comment"]) ? $context["comment"] : null), "creator"), array(), "array"), "firstname"), "html", null, true);
                    echo " </label>
                            <label class=\"comment_date\"> ";
                    // line 28
                    echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["comment"]) ? $context["comment"] : null), "date"), "d.m.Y H:i"), "html", null, true);
                    echo "</label>
                            <p class='comment_text'>";
                    // line 29
                    echo nl2br(twig_escape_filter($this->env, $this->getAttribute((isset($context["comment"]) ? $context["comment"] : null), "text"), "html", null, true));
                    echo "</p>
                        </div>
                    ";
                }
                // line 32
                echo "                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['id'], $context['comment'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 33
            echo "            </div>
        ";
            // line 35
            echo "        ";
            // line 36
            echo "            ";
            // line 37
            echo "            ";
            // line 38
            echo "                ";
            // line 39
            echo "            ";
            // line 40
            echo "        ";
            // line 41
            echo "    ";
        } else {
            // line 42
            echo "        <label class=\"comments\">Комментариев нет. </label>
    ";
        }
        // line 44
        echo "    <div class=\"new_comment_buttons ";
        if ((!$this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "comments"))) {
            echo " first_comment ";
        }
        echo "\">
        <a id=\"add_comment\" onclick=\"addComment()\">добавить</a>
    </div>
    <div id='new_comment_block'>
        <textarea id='new_comment_text' name='comment'></textarea>
        <a id='cancel_add_comment' onclick=\"cancelAddComment()\">отменить</a>&nbsp;
        <a id='save_comment' onclick=\"saveComment(0)\">сохранить</a>
    </div>";
    }

    public function getTemplateName()
    {
        return "helpdesk/ticket_edit_comments.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  133 => 44,  126 => 41,  124 => 40,  120 => 38,  116 => 36,  114 => 35,  111 => 33,  105 => 32,  99 => 29,  69 => 21,  61 => 16,  54 => 12,  50 => 10,  39 => 7,  25 => 3,  22 => 2,  19 => 1,  179 => 54,  168 => 46,  165 => 45,  160 => 42,  147 => 38,  145 => 37,  139 => 36,  132 => 35,  128 => 34,  122 => 39,  110 => 24,  104 => 22,  96 => 74,  94 => 73,  92 => 72,  86 => 67,  84 => 65,  80 => 63,  78 => 54,  73 => 51,  71 => 45,  68 => 44,  59 => 27,  57 => 22,  43 => 14,  36 => 6,  24 => 1,  415 => 167,  411 => 165,  409 => 164,  406 => 163,  404 => 162,  397 => 157,  386 => 154,  380 => 153,  377 => 152,  374 => 151,  370 => 150,  361 => 143,  346 => 141,  343 => 140,  339 => 139,  333 => 135,  328 => 132,  324 => 130,  318 => 128,  308 => 126,  306 => 125,  298 => 122,  294 => 121,  291 => 120,  289 => 119,  285 => 117,  279 => 115,  269 => 113,  267 => 112,  259 => 109,  255 => 108,  251 => 106,  249 => 105,  243 => 101,  225 => 85,  210 => 83,  206 => 82,  200 => 78,  196 => 66,  193 => 65,  182 => 55,  177 => 72,  175 => 71,  171 => 47,  169 => 68,  163 => 65,  153 => 40,  144 => 51,  136 => 49,  129 => 42,  125 => 33,  118 => 37,  107 => 23,  101 => 33,  95 => 28,  89 => 27,  82 => 26,  79 => 25,  75 => 24,  70 => 23,  66 => 32,  62 => 21,  56 => 13,  52 => 11,  48 => 9,  45 => 8,  40 => 4,  33 => 5,  30 => 4,  28 => 6,  26 => 2,);
    }
}
