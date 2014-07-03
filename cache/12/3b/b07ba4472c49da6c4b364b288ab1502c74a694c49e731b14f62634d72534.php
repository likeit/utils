<?php

/* helpdesk/ticket_edit.twig */
class __TwigTemplate_123bb07ba4472c49da6c4b364b288ab1502c74a694c49e731b14f62634d72534 extends Twig_Template
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
            <h3 class=\"title\">
                <a id=\"change-status\" class=\"popup_button\">
                    <img src='/stat/img/helpdesk/status_";
        // line 22
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "status"), "html", null, true);
        echo ".png'>
                </a>
                <input type=\"hidden\" id=\"input-status\" name=\"status\" value=\"";
        // line 24
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "status"), "html", null, true);
        echo "\">
                <div id=\"popup_change-status\" class=\"popup_menu\">
                    <ul>
                    ";
        // line 27
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["statuses"]) ? $context["statuses"] : null));
        foreach ($context['_seq'] as $context["id"] => $context["status"]) {
            // line 28
            echo "                        <li class=\"i-change-status ";
            echo ((((isset($context["id"]) ? $context["id"] : null) == $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "status"))) ? ("current") : (""));
            echo "\">
                            <a data-status=\"";
            // line 29
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo "\" onclick=\"changeStatus('";
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo "')\">
                                <img class=\"icon\" src=\"/stat/img/helpdesk/status_";
            // line 30
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo ".png\">";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["statuses"]) ? $context["statuses"] : null), (isset($context["id"]) ? $context["id"] : null), array(), "array"), "name"), "html", null, true);
            echo "</a>
                        </li>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['id'], $context['status'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 33
        echo "                    </ul>
                </div>
                &nbsp;";
        // line 35
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "id")) ? ((("#" . $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "id")) . ".")) : ("")), "html", null, true);
        echo "&nbsp;
                <input  name=\"title\" type=\"text\" value=\"";
        // line 36
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "title"), "html", null, true);
        echo "\" class=\"title_input\" ";
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "id")) ? ($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "id")) : ("autofocus=autofocus")), "html", null, true);
        echo " placeholder=\"Новая заявка\"/>
                ";
        // line 37
        if ($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "id")) {
            // line 38
            echo "                    <span class='ticket_edit_rating'>
                        ";
            // line 39
            if ((((isset($context["admin_id"]) ? $context["admin_id"] : null) == $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "creator")) || twig_in_filter((isset($context["admin_id"]) ? $context["admin_id"] : null), array(0 => 164, 1 => 177)))) {
                // line 40
                echo "                            ";
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable(range(1, 5));
                foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                    // line 41
                    echo "                                <a href=\"javascript: rateTicket('";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "id"), "html", null, true);
                    echo "', '";
                    echo twig_escape_filter($this->env, (isset($context["i"]) ? $context["i"] : null), "html", null, true);
                    echo "' )\">
                                    <img src=\"/stat/img/helpdesk/rate_";
                    // line 42
                    echo ((($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "rate") >= (isset($context["i"]) ? $context["i"] : null))) ? (1) : (0));
                    echo ".png\">
                                </a>
                            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 45
                echo "                        ";
            } else {
                // line 46
                echo "                            ";
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable(range(1, 5));
                foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                    // line 47
                    echo "                                <img src=\"/stat/img/helpdesk/rate_";
                    echo ((($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "rate") >= (isset($context["i"]) ? $context["i"] : null))) ? (1) : (0));
                    echo ".png\">
                            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 49
                echo "                        ";
            }
            // line 50
            echo "                    </span>
                ";
        }
        // line 52
        echo "            </h3>
        </div>

        <div class=\"form_block details\">

            <div class=\"form_line\">
                    <div class=\"area\">
                        <label>Территория:
                            <a id=\"change-area\" class=\"popup_button\">
                                ";
        // line 61
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "area")) ? ($this->getAttribute((isset($context["areas"]) ? $context["areas"] : null), $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "area"), array(), "array")) : ($this->getAttribute((isset($context["areas"]) ? $context["areas"] : null), 6, array(), "array"))), "html", null, true);
        echo "
                            </a>
                        </label>

                        <input type=\"hidden\" id=\"input-area\" name=\"area\" value=\"";
        // line 65
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "area")) ? ($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "area")) : ($this->getAttribute((isset($context["areas"]) ? $context["areas"] : null), 6, array(), "array"))), "html", null, true);
        echo "\">

                        <div id=\"popup_change-area\" class=\"popup_menu\">
                            <ul>
                            ";
        // line 69
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["areas"]) ? $context["areas"] : null));
        foreach ($context['_seq'] as $context["id"] => $context["area"]) {
            // line 70
            echo "                                <li class=\"i-change-area ";
            echo ((((isset($context["id"]) ? $context["id"] : null) == $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "area"))) ? ("current") : (""));
            echo "\">
                                    <a data-area=\"";
            // line 71
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo "\" onclick=\"changeArea('";
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo "')\">";
            echo twig_escape_filter($this->env, (isset($context["area"]) ? $context["area"] : null), "html", null, true);
            echo "</a>
                                </li>
                                ";
            // line 73
            echo ((((isset($context["id"]) ? $context["id"] : null) == 2)) ? ("<hr>") : (""));
            echo "
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['id'], $context['area'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 75
        echo "                            </ul>
                        </div>

                    </div>
                    <div class=\"deadline\">
                        <label>Срок:
                            <input id=\"input-deadline\" name=\"deadline\" class=\"popup_button calendar\" readonly
                                   value=\"";
        // line 82
        echo twig_escape_filter($this->env, ((($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "deadline") > 0)) ? (twig_date_format_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "deadline"), "d.m.Y")) : ("не указан")), "html", null, true);
        echo "\"/>
                        </label>
                        <a class=\"clear-deadline ";
        // line 84
        echo twig_escape_filter($this->env, ((($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "deadline") > 0)) ? (($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "deadline") > 0)) : ("hidden")), "html", null, true);
        echo "\" onclick=\"clearDeadline()\">
                            <img class=\"icon clear-deadline-icon\" src=\"/stat/img/small_close.gif\" alt=\"\"/>
                        </a>
                    </div>
            </div>

            <div class=\"description\">
                <textarea class=\"edit_description\" name=\"description\" placeholder=\"Описание\">";
        // line 91
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "description"), "html", null, true);
        echo "</textarea>
            </div>

            <div class=\"tags_container\">
                <div id=\"tags\" class=\"form_line popup_button\">
                    ";
        // line 96
        if (($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "tags") > 0)) {
            // line 97
            echo "                        ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "tags"));
            foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                // line 98
                echo "                            <a class=\"tag active weight_";
                echo twig_escape_filter($this->env, twig_round(($this->getAttribute($this->getAttribute((isset($context["tags"]) ? $context["tags"] : null), (isset($context["tag"]) ? $context["tag"] : null), array(), "array"), "weight") * 5)), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["tags"]) ? $context["tags"] : null), (isset($context["tag"]) ? $context["tag"] : null), array(), "array"), "name"), "html", null, true);
                echo "</a>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 100
            echo "                    ";
        } else {
            // line 101
            echo "                        <a class=\"tag active\">добавить метки</a>
                    ";
        }
        // line 103
        echo "                </div>

                <input type=\"hidden\" id=\"input-tags\" name=\"tags\" value=\"";
        // line 105
        echo twig_escape_filter($this->env, twig_join_filter($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "tags"), ","), "html", null, true);
        echo "\"/>

            </div>

            <div id=\"popup_tags\" class=\"popup_menu unsensitive\">
                ";
        // line 110
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["tags"]) ? $context["tags"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
            // line 111
            echo "                    <a data-weight=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["tag"]) ? $context["tag"] : null), "weight"), "html", null, true);
            echo "\" data-id=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["tag"]) ? $context["tag"] : null), "id"), "html", null, true);
            echo "\"  class=\"tag sensitive weight_";
            echo twig_escape_filter($this->env, twig_round(($this->getAttribute((isset($context["tag"]) ? $context["tag"] : null), "weight") * 5)), "html", null, true);
            echo " ";
            echo ((twig_in_filter($this->getAttribute((isset($context["tag"]) ? $context["tag"] : null), "id"), $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "tags"))) ? ("active") : (""));
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["tag"]) ? $context["tag"] : null), "name"), "html", null, true);
            echo "</a>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 113
        echo "                ";
        // line 114
        echo "                ";
        // line 115
        echo "                    ";
        // line 116
        echo "                        ";
        // line 117
        echo "                            ";
        // line 118
        echo "                        ";
        // line 119
        echo "                        ";
        // line 120
        echo "                            ";
        // line 121
        echo "                        ";
        // line 122
        echo "                        ";
        // line 123
        echo "                            ";
        // line 124
        echo "                        ";
        // line 125
        echo "                    ";
        // line 126
        echo "                ";
        // line 127
        echo "            </div>

        </div>

        <div class=\"form_block members\">
            ";
        // line 132
        if ($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "id")) {
            // line 133
            echo "                <div class=\"ticket_creator_and_changer\">
                    <label>Создал</label>
                    <span class=\"ticket_created\">
                        ";
            // line 136
            if ((twig_date_format_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "created"), "Y") == twig_date_format_filter($this->env, "now", "Y"))) {
                // line 137
                echo "                            ";
                echo twig_escape_filter($this->env, ("(" . twig_date_format_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "created"), "j")), "html", null, true);
                echo " ";
                echo twig_escape_filter($this->env, twig_slice($this->env, $this->getAttribute((isset($context["MONTHS_G"]) ? $context["MONTHS_G"] : null), (twig_date_format_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "created"), "m") - 1), array(), "array"), 0, 3), "html", null, true);
                echo " в ";
                echo twig_escape_filter($this->env, (twig_date_format_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "created"), "H:i") . "):"), "html", null, true);
                echo "
                        ";
            } else {
                // line 139
                echo "                            ";
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "created"), "d.m.Y \\в H:i"), "html", null, true);
                echo "
                        ";
            }
            // line 141
            echo "                    </span>
                    <a class=\"ticket_creator\" data-id=\"";
            // line 142
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "creator"), "html", null, true);
            echo "\">
                        ";
            // line 143
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["users"]) ? $context["users"] : null), $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "creator"), array(), "array"), "lastname"), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["users"]) ? $context["users"] : null), $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "creator"), array(), "array"), "firstname"), "html", null, true);
            echo "
                    </a>
                    <br>
                    <br>
                    ";
            // line 147
            if ($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "changer")) {
                // line 148
                echo "                        <label>Изменил</label>
                        <span class=\"ticket_changed\">
                            ";
                // line 150
                if ((twig_date_format_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "changed"), "Y") == twig_date_format_filter($this->env, "now", "Y"))) {
                    // line 151
                    echo "                                ";
                    echo twig_escape_filter($this->env, ("(" . twig_date_format_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "changed"), "j")), "html", null, true);
                    echo " ";
                    echo twig_escape_filter($this->env, twig_slice($this->env, $this->getAttribute((isset($context["MONTHS_G"]) ? $context["MONTHS_G"] : null), (twig_date_format_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "changed"), "m") - 1), array(), "array"), 0, 3), "html", null, true);
                    echo " в ";
                    echo twig_escape_filter($this->env, (twig_date_format_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "changed"), "H:i") . "):"), "html", null, true);
                    echo "
                            ";
                } else {
                    // line 153
                    echo "                                ";
                    echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "changed"), "d.m.Y \\в H:i"), "html", null, true);
                    echo "
                            ";
                }
                // line 155
                echo "                        </span>
                        <a class=\"ticket_changer\" data-id=\"";
                // line 156
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "changer"), "html", null, true);
                echo "\">
                            ";
                // line 157
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["admins"]) ? $context["admins"] : null), $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "changer"), array(), "array"), "lastname"), "html", null, true);
                echo " ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["admins"]) ? $context["admins"] : null), $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "changer"), array(), "array"), "firstname"), "html", null, true);
                echo "
                        </a>
                    ";
            }
            // line 160
            echo "
                </div>
            ";
        }
        // line 163
        echo "
            <div class=\"contractor\">
                <label>Ответственный:<br>
                    <select name=\"contractor\">
                        ";
        // line 167
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["admins"]) ? $context["admins"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["admin"]) {
            // line 168
            echo "                            ";
            $context["selected"] = (((($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "id") == "") || (!$this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "contractor"))) && ($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "uid") == (isset($context["admin_id"]) ? $context["admin_id"] : null))) || ($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "contractor") == $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "uid")));
            // line 169
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
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 171
        echo "                    </select>
                </label>
            </div>
            <br>

            <div class=\"performers\">
                <label>Исполнители:</label>
                ";
        // line 178
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["admins"]) ? $context["admins"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["admin"]) {
            // line 179
            echo "                    ";
            $context["checked"] = (twig_in_filter($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "uid"), $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "performers")) || (($this->getAttribute($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "performers"), 0, array(), "array") == "") && ($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "uid") == (isset($context["admin_id"]) ? $context["admin_id"] : null))));
            // line 180
            echo "                    <label class=\"performer\">
                        <input class=\"performer\" type=\"checkbox\" data-performer=\"";
            // line 181
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "uid"), "html", null, true);
            echo "\" ";
            echo (((isset($context["checked"]) ? $context["checked"] : null)) ? ("checked") : (""));
            echo "/>
                        ";
            // line 182
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "lastname"), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "firstname"), "html", null, true);
            echo "
                    </label>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['admin'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 185
        echo "                <input type=\"hidden\" name=\"performers\"/>
            </div>

        </div>

        ";
        // line 190
        if ($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "id")) {
            // line 191
            echo "            <div id=\"comments_block\" class=\"form_block cut_block cutted\">
                ";
            // line 192
            $this->env->loadTemplate("helpdesk/ticket_edit_comments.twig")->display($context);
            // line 193
            echo "            </div>
        ";
        }
        // line 195
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
        return array (  509 => 195,  505 => 193,  503 => 192,  500 => 191,  498 => 190,  491 => 185,  480 => 182,  474 => 181,  471 => 180,  468 => 179,  464 => 178,  455 => 171,  440 => 169,  437 => 168,  433 => 167,  427 => 163,  422 => 160,  414 => 157,  410 => 156,  407 => 155,  401 => 153,  391 => 151,  389 => 150,  385 => 148,  383 => 147,  374 => 143,  370 => 142,  367 => 141,  361 => 139,  351 => 137,  349 => 136,  344 => 133,  342 => 132,  335 => 127,  333 => 126,  331 => 125,  329 => 124,  327 => 123,  325 => 122,  323 => 121,  321 => 120,  319 => 119,  317 => 118,  315 => 117,  313 => 116,  311 => 115,  309 => 114,  307 => 113,  290 => 111,  286 => 110,  278 => 105,  274 => 103,  270 => 101,  267 => 100,  256 => 98,  251 => 97,  249 => 96,  241 => 91,  231 => 84,  226 => 82,  217 => 75,  209 => 73,  200 => 71,  195 => 70,  191 => 69,  184 => 65,  177 => 61,  166 => 52,  162 => 50,  159 => 49,  150 => 47,  145 => 46,  142 => 45,  133 => 42,  126 => 41,  121 => 40,  119 => 39,  116 => 38,  114 => 37,  108 => 36,  104 => 35,  100 => 33,  89 => 30,  83 => 29,  78 => 28,  74 => 27,  68 => 24,  63 => 22,  56 => 18,  52 => 17,  48 => 15,  45 => 14,  40 => 4,  33 => 9,  30 => 7,  28 => 6,  26 => 2,);
    }
}
