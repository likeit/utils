<?php

/* helpdesk/ticket_edit.twig */
class __TwigTemplate_683f13617dc97187c07b856b1cec15d5 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("/utils.twig");

        $this->blocks = array(
            'search' => array($this, 'block_search'),
            'content' => array($this, 'block_content'),
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
        // line 6
        if ($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "id")) {
            // line 7
            $context["header"] = ((("#" . $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "id")) . ". ") . $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "title"));
        } else {
            // line 9
            $context["header"] = "Новая заявка";
        }
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_search($context, array $blocks = array())
    {
    }

    // line 14
    public function block_content($context, array $blocks = array())
    {
        // line 15
        echo "
    <div class=\"edit_form\">
        <form id=\"ticket_edit\" name=\"ticket_edit\" action=\"/helpdesk/?stage=save&id=";
        // line 17
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "id"), "html", null, true);
        echo "\" method=\"post\">
        <input type=\"hidden\" id=\"ticket_id\" value=\"";
        // line 18
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "id"), "html", null, true);
        echo "\"/>
        <div class=\"form_block header\">
            <h3 class=\"title\" contenteditable=\"true\">
                <img src='/stat/img/helpdesk/status_";
        // line 21
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "status"), "html", null, true);
        echo ".png'>
                ";
        // line 22
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "id")) ? ((("#" . $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "id")) . ".")) : ("")), "html", null, true);
        echo "
                <input  name=\"title\" type=\"text\" value=\"";
        // line 23
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "title"), "html", null, true);
        echo "\" class=\"title_input\"/>
                <span class='ticket_edit_rating'>
                    ";
        // line 25
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable(range(1, 5));
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 26
            echo "                        ";
            if ((((isset($context["admin_id"]) ? $context["admin_id"] : null) == $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "creator")) || twig_in_filter((isset($context["admin_id"]) ? $context["admin_id"] : null), array(0 => 164, 1 => 177)))) {
                // line 27
                echo "                            <a href=\"javascript: rateTicket('";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "id"), "html", null, true);
                echo "', '";
                echo twig_escape_filter($this->env, (isset($context["i"]) ? $context["i"] : null), "html", null, true);
                echo "' )\">
                                <img src=\"/stat/img/helpdesk/rate_";
                // line 28
                echo ((($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "rate") >= (isset($context["i"]) ? $context["i"] : null))) ? (1) : (0));
                echo ".png\">
                            </a>
                        ";
            } else {
                // line 31
                echo "                            <img src=\"/stat/img/helpdesk/rate_";
                echo ((($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "rate") >= (isset($context["i"]) ? $context["i"] : null))) ? (1) : (0));
                echo ".png\">
                        ";
            }
            // line 33
            echo "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 34
        echo "                </span>
            </h3>
        </div>
        <div class=\"form_block details\">

            <div class=\"form_line\">
                    <div class=\"area\">
                        <label>Территория:
                            <a id=\"change-area\" class=\"popup_button\">
                                ";
        // line 43
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["areas"]) ? $context["areas"] : null), $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "area"), array(), "array"), "html", null, true);
        echo "
                            </a>
                            <div id=\"popup_change-area\" class=\"popup_menu\">
                                <ul>
                                ";
        // line 47
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["areas"]) ? $context["areas"] : null));
        foreach ($context['_seq'] as $context["id"] => $context["area"]) {
            // line 48
            echo "                                    <li><a data-id=\"";
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, (isset($context["area"]) ? $context["area"] : null), "html", null, true);
            echo "</a></li>
                                    ";
            // line 49
            echo ((((isset($context["id"]) ? $context["id"] : null) == 2)) ? ("<hr>") : (""));
            echo "
                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['id'], $context['area'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 51
        echo "                                </ul>
                            </div>
                        </label>
                    </div>
                    <div class=\"deadline\">
                        <label>Срок:
                            <a id=\"1hange-area\" class=\"popup_button calendar\" onclick=\"echo(this)\">
                                ";
        // line 58
        echo twig_escape_filter($this->env, ((($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "deadline") > 0)) ? (twig_date_format_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "deadline"), "d.m.Y")) : ("не указан")), "html", null, true);
        echo "
                            </a>
                        </label>
                    </div>
            </div>

            <div class=\"description\">
                <textarea style=\"margin-top: 10px; height: 250px\" name=\"description\" placeholder=\"Описание\">";
        // line 65
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "description"), "html", null, true);
        echo "</textarea>
            </div>

            ";
        // line 68
        if (twig_in_filter((isset($context["admin_id"]) ? $context["admin_id"] : null), array(0 => 164, 1 => 177))) {
            // line 69
            echo "                <div class=\"tags_container\">
                    <div id=\"tags\" class=\"form_line popup_button\">
                        ";
            // line 71
            if ($this->getAttribute((isset($context["tickets"]) ? $context["tickets"] : null), "tags")) {
                // line 72
                echo "                            ";
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable(twig_sort_filter($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "tags")));
                foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                    // line 73
                    echo "                                <a class=\"tag active weight_";
                    echo twig_escape_filter($this->env, (isset($context["tag"]) ? $context["tag"] : null), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, (isset($context["tag"]) ? $context["tag"] : null), "html", null, true);
                    echo "</a>
                            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
                $context = array_merge($_parent, array_intersect_key($context, $_parent));
                // line 75
                echo "                        ";
            } else {
                // line 76
                echo "                            <a class=\"tag active\">добавить метки</a>
                        ";
            }
            // line 78
            echo "                    </div>
                </div>

                <div id=\"popup_tags\" class=\"popup_menu unsensitive\">
                    ";
            // line 82
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["tags"]) ? $context["tags"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                // line 83
                echo "                        <a data-weight=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["tag"]) ? $context["tag"] : null), "weight"), "html", null, true);
                echo "\" data-id=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["tag"]) ? $context["tag"] : null), "id"), "html", null, true);
                echo "\"  class=\"tag weight_";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["tag"]) ? $context["tag"] : null), "weight"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["tag"]) ? $context["tag"] : null), "name"), "html", null, true);
                echo "</a>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 85
            echo "                    <hr>
                    <table class=\"buttons\">
                        <tr>
                            <td class=\"cancel-tags_container\">
                                <a id=\"cancel-tags\" class=\"sensitive\">отмена</a>
                            </td>
                            <td class=\"update-tags_container\">
                                <a id=\"update-tags\" class=\"sensitive\">выбрать</a>
                            </td>
                            <td class=\"add-tag_container\">
                                <a id=\"add-tag\">+</a>
                            </td>
                        </tr>
                    </table>
                </div>
            ";
        }
        // line 101
        echo "
        </div>

        <div class=\"form_block members\">
            ";
        // line 105
        if ($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "id")) {
            // line 106
            echo "                <div class=\"ticket_creator_and_changer\">
                    <label>Создал:</label>
                    <a class=\"ticket_creator\" data-id=\"";
            // line 108
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "creator"), "html", null, true);
            echo "\">
                        ";
            // line 109
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["users"]) ? $context["users"] : null), $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "creator"), array(), "array"), "lastname"), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["users"]) ? $context["users"] : null), $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "creator"), array(), "array"), "firstname"), "html", null, true);
            echo "
                    </a>
                    <span class=\"ticket_created\">
                        ";
            // line 112
            if ((twig_date_format_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "created"), "Y") == twig_date_format_filter($this->env, "now", "Y"))) {
                // line 113
                echo "                            ";
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "created"), "j"), "html", null, true);
                echo " ";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["MONTHS_G"]) ? $context["MONTHS_G"] : null), (twig_date_format_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "created"), "m") - 1), array(), "array"), "html", null, true);
                echo " в ";
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "created"), "H:i"), "html", null, true);
                echo "
                        ";
            } else {
                // line 115
                echo "                            ";
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "created"), "d.m.Y \\в H:i"), "html", null, true);
                echo "
                        ";
            }
            // line 117
            echo "                    </span>
                    <br>
                    ";
            // line 119
            if ($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "changer")) {
                // line 120
                echo "                        <label>Изменил:</label>
                        <a class=\"ticket_changer\" data-id=\"";
                // line 121
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "changer"), "html", null, true);
                echo "\">
                            ";
                // line 122
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["admins"]) ? $context["admins"] : null), $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "changer"), array(), "array"), "lastname"), "html", null, true);
                echo " ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["admins"]) ? $context["admins"] : null), $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "changer"), array(), "array"), "firstname"), "html", null, true);
                echo "
                        </a>
                        <span class=\"ticket_changed\">
                            ";
                // line 125
                if ((twig_date_format_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "changed"), "Y") == twig_date_format_filter($this->env, "now", "Y"))) {
                    // line 126
                    echo "                                ";
                    echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "changed"), "j"), "html", null, true);
                    echo " ";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["MONTHS_G"]) ? $context["MONTHS_G"] : null), (twig_date_format_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "changed"), "m") - 1), array(), "array"), "html", null, true);
                    echo " в ";
                    echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "changed"), "H:i"), "html", null, true);
                    echo "
                            ";
                } else {
                    // line 128
                    echo "                                ";
                    echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "changed"), "d.m.Y \\в H:i"), "html", null, true);
                    echo "
                            ";
                }
                // line 130
                echo "                        </span>
                    ";
            }
            // line 132
            echo "
                </div>
            ";
        }
        // line 135
        echo "
            <div class=\"contractor\">
                <label>Ответственный:<br>
                    <select name=\"contractor\">
                        ";
        // line 139
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["admins"]) ? $context["admins"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["admin"]) {
            // line 140
            echo "                            ";
            $context["selected"] = (((($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "id") == "") || (!$this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "contractor"))) && ($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "uid") == (isset($context["admin_id"]) ? $context["admin_id"] : null))) || ($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "contractor") == $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "uid")));
            // line 141
            echo "                            <option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "uid"), "html", null, true);
            echo "\" ";
            echo (((isset($context["selected"]) ? $context["selected"] : null)) ? ("selected") : (""));
            echo ">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "lastname"), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "firstname"), "html", null, true);
            echo "</option>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['admin'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 143
        echo "                    </select>
                </label>
            </div>
            <br>

            <div class=\"performers\">
                <label>Исполнители:</label>
                ";
        // line 150
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["admins"]) ? $context["admins"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["admin"]) {
            // line 151
            echo "                    ";
            $context["checked"] = (twig_in_filter($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "uid"), $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "performers")) || (($this->getAttribute($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "performers"), 0, array(), "array") == "") && ($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "uid") == (isset($context["admin_id"]) ? $context["admin_id"] : null))));
            // line 152
            echo "                    <label class=\"performer\">
                        <input class=\"performer\" type=\"checkbox\" data-performer=\"";
            // line 153
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "uid"), "html", null, true);
            echo "\" ";
            echo (((isset($context["checked"]) ? $context["checked"] : null)) ? ("checked") : (""));
            echo "/>
                        ";
            // line 154
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "lastname"), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "firstname"), "html", null, true);
            echo "
                    </label>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['admin'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 157
        echo "                <input type=\"hidden\" name=\"performers\"/>
            </div>

        </div>

        ";
        // line 162
        if ($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "id")) {
            // line 163
            echo "            <div id=\"comments_block\" class=\"form_block cut_block cutted\">
                ";
            // line 164
            $this->env->loadTemplate("helpdesk/ticket_edit_comments.twig")->display($context);
            // line 165
            echo "            </div>
        ";
        }
        // line 167
        echo "
        </form>
        <div class=\"spacer\"></div>
        <div class=\"buttons\">
            <a class=\"button red\" id=\"back\"  href=\"javascript: (history.length > 1) ? history.back() : location = '/helpdesk/'\">« Вернуться</a>
            <div class=\"right\">
                <a class=\"button green\" id=\"save_ticket\">Сохранить</a>
                <a class=\"button green\" id=\"save_ticket_and_back\">Сохранить и вернуться</a>
            </div>
        </div>
    </div>

";
    }

    public function getTemplateName()
    {
        return "helpdesk/ticket_edit.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  415 => 167,  411 => 165,  409 => 164,  406 => 163,  404 => 162,  397 => 157,  386 => 154,  380 => 153,  377 => 152,  374 => 151,  370 => 150,  361 => 143,  346 => 141,  343 => 140,  339 => 139,  333 => 135,  328 => 132,  324 => 130,  318 => 128,  308 => 126,  306 => 125,  298 => 122,  294 => 121,  291 => 120,  289 => 119,  285 => 117,  279 => 115,  269 => 113,  267 => 112,  259 => 109,  255 => 108,  251 => 106,  249 => 105,  243 => 101,  225 => 85,  210 => 83,  206 => 82,  200 => 78,  196 => 76,  193 => 75,  182 => 73,  177 => 72,  175 => 71,  171 => 69,  169 => 68,  163 => 65,  153 => 58,  144 => 51,  136 => 49,  129 => 48,  125 => 47,  118 => 43,  107 => 34,  101 => 33,  95 => 31,  89 => 28,  82 => 27,  79 => 26,  75 => 25,  70 => 23,  66 => 22,  62 => 21,  56 => 18,  52 => 17,  48 => 15,  45 => 14,  40 => 4,  33 => 9,  30 => 7,  28 => 6,  26 => 2,);
    }
}
