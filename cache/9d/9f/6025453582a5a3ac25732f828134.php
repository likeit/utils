<?php

/* helpdesk.twig */
class __TwigTemplate_9d9f6025453582a5a3ac25732f828134 extends Twig_Template
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
        // line 3
        if ((isset($context["stage"]) ? $context["stage"] : null)) {
            $context["get_stage"] = (("stage=" . (isset($context["stage"]) ? $context["stage"] : null)) . "&");
        }
        // line 4
        if ((isset($context["filter"]) ? $context["filter"] : null)) {
            $context["get_filter"] = (("filter=" . (isset($context["filter"]) ? $context["filter"] : null)) . "&");
        }
        // line 5
        if ((isset($context["search"]) ? $context["search"] : null)) {
            $context["get_search"] = (("search=" . (isset($context["search"]) ? $context["search"] : null)) . "&");
        }
        // line 6
        if ((isset($context["page"]) ? $context["page"] : null)) {
            $context["get_page"] = (("page=" . (isset($context["page"]) ? $context["page"] : null)) . "&");
        }
        // line 7
        if ((isset($context["r"]) ? $context["r"] : null)) {
            $context["get_r"] = (("r=" . (isset($context["r"]) ? $context["r"] : null)) . "&");
        }
        // line 8
        if ((isset($context["ob"]) ? $context["ob"] : null)) {
            $context["get_ob"] = (("ob=" . (isset($context["ob"]) ? $context["ob"] : null)) . "&");
        }
        // line 9
        if ((isset($context["od"]) ? $context["od"] : null)) {
            $context["get_od"] = (("od=" . (isset($context["od"]) ? $context["od"] : null)) . "&");
        }
        // line 10
        $context["get_for_sorting_links"] = ((((isset($context["get_stage"]) ? $context["get_stage"] : null) . (isset($context["get_filter"]) ? $context["get_filter"] : null)) . (isset($context["get_search"]) ? $context["get_search"] : null)) . (isset($context["get_r"]) ? $context["get_r"] : null));
        // line 11
        $context["get_for_pagenumbers"] = ((((((isset($context["get_stage"]) ? $context["get_stage"] : null) . (isset($context["get_filter"]) ? $context["get_filter"] : null)) . (isset($context["get_search"]) ? $context["get_search"] : null)) . (isset($context["get_r"]) ? $context["get_r"] : null)) . (isset($context["get_ob"]) ? $context["get_ob"] : null)) . (isset($context["get_od"]) ? $context["get_od"] : null));
        // line 12
        $context["get_for_list_view"] = (((((isset($context["get_stage"]) ? $context["get_stage"] : null) . (isset($context["get_filter"]) ? $context["get_filter"] : null)) . (isset($context["get_search"]) ? $context["get_search"] : null)) . (isset($context["get_ob"]) ? $context["get_ob"] : null)) . (isset($context["get_od"]) ? $context["get_od"] : null));
        // line 14
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["filters"]) ? $context["filters"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["f"]) {
            // line 15
            if (((($this->getAttribute((isset($context["f"]) ? $context["f"] : null), "user") == (isset($context["admin_id"]) ? $context["admin_id"] : null)) || ($this->getAttribute((isset($context["f"]) ? $context["f"] : null), "user") == 0)) && ($this->getAttribute((isset($context["f"]) ? $context["f"] : null), "filter") == (isset($context["filter"]) ? $context["filter"] : null)))) {
                // line 16
                $context["pagename"] = ($this->getAttribute((isset($context["f"]) ? $context["f"] : null), "name") . " — Задачник");
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['f'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 19
        $context["pagename"] = ((((isset($context["pagename"]) ? $context["pagename"] : null) != "helpdesk")) ? ((isset($context["pagename"]) ? $context["pagename"] : null)) : ("Пользовательский фильтр — Задачник"));
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 22
    public function block_search($context, array $blocks = array())
    {
        // line 23
        echo "    <div class='searchbox'>
        <form action='/helpdesk/' method=\"get\" name='search_form'>
            <input type='search' name='search' placeholder='Поиск заявок' autofocus='autofocus'>
            <input type='submit' id='search_button' value=\"\"/>
            <input type=\"hidden\" name=\"stage\" value=\"search\">
        </form>
    </div>
    ";
        // line 30
        if ((isset($context["changedSearchText"]) ? $context["changedSearchText"] : null)) {
            // line 31
            echo "        <div class='search_hint'>Показаны результаты поиска по запросу \"";
            echo twig_escape_filter($this->env, (isset($context["search"]) ? $context["search"] : null), "html", null, true);
            echo "\". Возможно, вы имели ввиду
                <a href='/helpdesk/?stage=search&ob=changed&od=1&search=";
            // line 32
            echo twig_escape_filter($this->env, (isset($context["changedSearchText"]) ? $context["changedSearchText"] : null), "html", null, true);
            echo "'>";
            echo twig_escape_filter($this->env, (isset($context["changedSearchText"]) ? $context["changedSearchText"] : null), "html", null, true);
            echo "</a>?
        </div>
    ";
        }
    }

    // line 37
    public function block_content($context, array $blocks = array())
    {
        // line 38
        echo "

<div class='data_container'>
    <div class='list_view_buttons'>
        ";
        // line 42
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable(array(0 => 10, 1 => 20, 2 => 50, 3 => 100, 4 => 250));
        foreach ($context['_seq'] as $context["_key"] => $context["rows"]) {
            // line 43
            echo "            ";
            if (((isset($context["rows"]) ? $context["rows"] : null) == (isset($context["r"]) ? $context["r"] : null))) {
                // line 44
                echo "                <span>";
                echo twig_escape_filter($this->env, (isset($context["rows"]) ? $context["rows"] : null), "html", null, true);
                echo "</span>
            ";
            } else {
                // line 46
                echo "                <a href='/helpdesk?";
                echo twig_escape_filter($this->env, (isset($context["get_for_list_view"]) ? $context["get_for_list_view"] : null), "html", null, true);
                echo "r=";
                echo twig_escape_filter($this->env, (isset($context["rows"]) ? $context["rows"] : null), "html", null, true);
                echo "'>";
                echo twig_escape_filter($this->env, (isset($context["rows"]) ? $context["rows"] : null), "html", null, true);
                echo "</a>
            ";
            }
            // line 48
            echo "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['rows'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 49
        echo "        ";
        if (((isset($context["admin_id"]) ? $context["admin_id"] : null) == 164)) {
            // line 50
            echo "            <span class=\"block_button_show_timeline\">
                <a class=\"button_show_timeline\">+</a>
            </span>
        ";
        }
        // line 54
        echo "    </div>
    <table class='tickets list'>
        <col class='col-status'/>
        <col class='col-weight'/>
        <col class='col-title'/>
        <col class='col-area'/>
        <col class='col-creator'/>
        <col class='col-performers'/>
        <col class='col-created'/>
        <col class='col-changed'/>
        <col class='col-deadline'/>
        <col class='col-rate'/>

        <tr>
            ";
        // line 68
        list($context["col"], $context["class"], $context["order_desc"]) =         array("status", "", "");
        // line 69
        echo "            ";
        if (((isset($context["ob"]) ? $context["ob"] : null) == (isset($context["col"]) ? $context["col"] : null))) {
            // line 70
            echo "                ";
            $context["class"] = "ordered";
            // line 71
            echo "                ";
            if (((isset($context["od"]) ? $context["od"] : null) == 1)) {
                echo "                     ";
                $context["class"] = ((isset($context["class"]) ? $context["class"] : null) . " desc");
                echo "                 ";
            } else {
                echo "                     ";
                $context["order_desc"] = "&od=1";
                echo "                 ";
            }
            // line 72
            echo "            ";
        }
        // line 73
        echo "            <th class=\"";
        echo twig_escape_filter($this->env, (isset($context["col"]) ? $context["col"] : null), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, (isset($context["class"]) ? $context["class"] : null), "html", null, true);
        echo " sort\">
                <a href='/helpdesk/?";
        // line 74
        echo twig_escape_filter($this->env, (isset($context["get_for_sorting_links"]) ? $context["get_for_sorting_links"] : null), "html", null, true);
        echo "ob=";
        echo twig_escape_filter($this->env, (isset($context["col"]) ? $context["col"] : null), "html", null, true);
        echo twig_escape_filter($this->env, (isset($context["order_desc"]) ? $context["order_desc"] : null), "html", null, true);
        echo "' title='Статус'>
                    <img class='icon' src='/stat/img/helpdesk/status_";
        // line 75
        echo twig_escape_filter($this->env, _twig_default_filter(strtr((isset($context["class"]) ? $context["class"] : null), array(" " => "_")), "0"), "html", null, true);
        echo ".png'>
                </a>
            </th>

            ";
        // line 79
        list($context["col"], $context["class"], $context["order_desc"]) =         array("weight", "", "&od=1");
        // line 80
        echo "            ";
        if (((isset($context["ob"]) ? $context["ob"] : null) == (isset($context["col"]) ? $context["col"] : null))) {
            // line 81
            echo "                ";
            $context["class"] = "ordered";
            // line 82
            echo "                ";
            if (((!(isset($context["od"]) ? $context["od"] : null)) == 1)) {
                echo "                     ";
                $context["class"] = ((isset($context["class"]) ? $context["class"] : null) . " desc");
                echo "                 ";
            } else {
                echo "                     ";
                $context["order_desc"] = "";
                echo "                 ";
            }
            // line 83
            echo "            ";
        }
        // line 84
        echo "            <th class=\"";
        echo twig_escape_filter($this->env, (isset($context["col"]) ? $context["col"] : null), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, (isset($context["class"]) ? $context["class"] : null), "html", null, true);
        echo " sort\">
                <a href='/helpdesk/?";
        // line 85
        echo twig_escape_filter($this->env, (isset($context["get_for_sorting_links"]) ? $context["get_for_sorting_links"] : null), "html", null, true);
        echo "ob=";
        echo twig_escape_filter($this->env, (isset($context["col"]) ? $context["col"] : null), "html", null, true);
        echo twig_escape_filter($this->env, (isset($context["order_desc"]) ? $context["order_desc"] : null), "html", null, true);
        echo "' title='Вес'>
                    <img class='icon' src='/stat/img/helpdesk/type_";
        // line 86
        echo twig_escape_filter($this->env, _twig_default_filter(strtr((isset($context["class"]) ? $context["class"] : null), array(" " => "_")), "0"), "html", null, true);
        echo ".png'>
                </a>
            </th>

            ";
        // line 90
        list($context["col"], $context["class"], $context["order_desc"]) =         array("title", "", "");
        // line 91
        echo "            ";
        if (((isset($context["ob"]) ? $context["ob"] : null) == (isset($context["col"]) ? $context["col"] : null))) {
            // line 92
            echo "                ";
            $context["class"] = "ordered";
            // line 93
            echo "                ";
            if (((isset($context["od"]) ? $context["od"] : null) == 1)) {
                echo "                     ";
                $context["class"] = ((isset($context["class"]) ? $context["class"] : null) . " desc");
                echo "                 ";
            } else {
                echo "                     ";
                $context["order_desc"] = "&od=1";
                echo "                 ";
            }
            // line 94
            echo "            ";
        }
        // line 95
        echo "            <th class=\"";
        echo twig_escape_filter($this->env, (isset($context["class"]) ? $context["class"] : null), "html", null, true);
        echo " sort\">
                <a href='/helpdesk/?";
        // line 96
        echo twig_escape_filter($this->env, (isset($context["get_for_sorting_links"]) ? $context["get_for_sorting_links"] : null), "html", null, true);
        echo "ob=";
        echo twig_escape_filter($this->env, (isset($context["col"]) ? $context["col"] : null), "html", null, true);
        echo twig_escape_filter($this->env, (isset($context["order_desc"]) ? $context["order_desc"] : null), "html", null, true);
        echo "'><span>Тема</span></a>
            </th>

            ";
        // line 99
        list($context["col"], $context["class"], $context["order_desc"]) =         array("area", "", "");
        // line 100
        echo "            ";
        if (((isset($context["ob"]) ? $context["ob"] : null) == (isset($context["col"]) ? $context["col"] : null))) {
            // line 101
            echo "                ";
            $context["class"] = "ordered";
            // line 102
            echo "                ";
            if (((isset($context["od"]) ? $context["od"] : null) == 1)) {
                // line 103
                echo "                    ";
                $context["class"] = ((isset($context["class"]) ? $context["class"] : null) . " desc");
                // line 104
                echo "                ";
            } else {
                // line 105
                echo "                    ";
                $context["order_desc"] = "&od=1";
                // line 106
                echo "                ";
            }
            // line 107
            echo "            ";
        }
        // line 108
        echo "            <th class=\"";
        echo twig_escape_filter($this->env, (isset($context["class"]) ? $context["class"] : null), "html", null, true);
        echo " sort\">
                <a href='/helpdesk/?";
        // line 109
        echo twig_escape_filter($this->env, (isset($context["get_for_sorting_links"]) ? $context["get_for_sorting_links"] : null), "html", null, true);
        echo "ob=";
        echo twig_escape_filter($this->env, (isset($context["col"]) ? $context["col"] : null), "html", null, true);
        echo twig_escape_filter($this->env, (isset($context["order_desc"]) ? $context["order_desc"] : null), "html", null, true);
        echo "'><span>Территория</span></a>
            </th>

            ";
        // line 112
        list($context["col"], $context["class"], $context["order_desc"]) =         array("creator", "", "");
        // line 113
        echo "            ";
        if (((isset($context["ob"]) ? $context["ob"] : null) == (isset($context["col"]) ? $context["col"] : null))) {
            // line 114
            echo "                ";
            $context["class"] = "ordered";
            // line 115
            echo "                ";
            if (((isset($context["od"]) ? $context["od"] : null) == 1)) {
                echo "                     ";
                $context["class"] = ((isset($context["class"]) ? $context["class"] : null) . " desc");
                echo "                 ";
            } else {
                echo "                     ";
                $context["order_desc"] = "&od=1";
                echo "                 ";
            }
            // line 116
            echo "            ";
        }
        // line 117
        echo "            <th class=\"";
        echo twig_escape_filter($this->env, (isset($context["col"]) ? $context["col"] : null), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, (isset($context["class"]) ? $context["class"] : null), "html", null, true);
        echo " sort\">
                <a href='/helpdesk/?";
        // line 118
        echo twig_escape_filter($this->env, (isset($context["get_for_sorting_links"]) ? $context["get_for_sorting_links"] : null), "html", null, true);
        echo "ob=";
        echo twig_escape_filter($this->env, (isset($context["col"]) ? $context["col"] : null), "html", null, true);
        echo twig_escape_filter($this->env, (isset($context["order_desc"]) ? $context["order_desc"] : null), "html", null, true);
        echo "'><span>Постановщик</span></a>
            </th>

            ";
        // line 121
        list($context["col"], $context["class"], $context["order_desc"]) =         array("performers", "", "");
        // line 122
        echo "            ";
        if (((isset($context["ob"]) ? $context["ob"] : null) == (isset($context["col"]) ? $context["col"] : null))) {
            // line 123
            echo "                ";
            $context["class"] = "ordered";
            // line 124
            echo "                ";
            if (((isset($context["od"]) ? $context["od"] : null) == 1)) {
                echo "                     ";
                $context["class"] = ((isset($context["class"]) ? $context["class"] : null) . " desc");
                echo "                 ";
            } else {
                echo "                     ";
                $context["order_desc"] = "&od=1";
                echo "                 ";
            }
            // line 125
            echo "            ";
        }
        // line 126
        echo "            <th class=\"";
        echo twig_escape_filter($this->env, (isset($context["class"]) ? $context["class"] : null), "html", null, true);
        echo " sort\">
                <a href='/helpdesk/?";
        // line 127
        echo twig_escape_filter($this->env, (isset($context["get_for_sorting_links"]) ? $context["get_for_sorting_links"] : null), "html", null, true);
        echo "ob=";
        echo twig_escape_filter($this->env, (isset($context["col"]) ? $context["col"] : null), "html", null, true);
        echo twig_escape_filter($this->env, (isset($context["order_desc"]) ? $context["order_desc"] : null), "html", null, true);
        echo "'><span>Исполнители</span></a>
            </th>

            ";
        // line 130
        list($context["col"], $context["class"], $context["order_desc"]) =         array("created", "", "");
        // line 131
        echo "            ";
        if (((isset($context["ob"]) ? $context["ob"] : null) == (isset($context["col"]) ? $context["col"] : null))) {
            // line 132
            echo "                ";
            $context["class"] = "ordered";
            // line 133
            echo "                ";
            if (((isset($context["od"]) ? $context["od"] : null) == 1)) {
                echo "                     ";
                $context["class"] = ((isset($context["class"]) ? $context["class"] : null) . " desc");
                echo "                 ";
            } else {
                echo "                     ";
                $context["order_desc"] = "&od=1";
                echo "                 ";
            }
            // line 134
            echo "            ";
        }
        // line 135
        echo "            <th class=\"";
        echo twig_escape_filter($this->env, (isset($context["class"]) ? $context["class"] : null), "html", null, true);
        echo " sort\">
                <a href='/helpdesk/?";
        // line 136
        echo twig_escape_filter($this->env, (isset($context["get_for_sorting_links"]) ? $context["get_for_sorting_links"] : null), "html", null, true);
        echo "ob=";
        echo twig_escape_filter($this->env, (isset($context["col"]) ? $context["col"] : null), "html", null, true);
        echo twig_escape_filter($this->env, (isset($context["order_desc"]) ? $context["order_desc"] : null), "html", null, true);
        echo "'><span>Создана</span></a>
            </th>

            ";
        // line 139
        list($context["col"], $context["class"], $context["order_desc"]) =         array("changed", "", "");
        // line 140
        echo "            ";
        if (((isset($context["ob"]) ? $context["ob"] : null) == (isset($context["col"]) ? $context["col"] : null))) {
            // line 141
            echo "                ";
            $context["class"] = "ordered";
            // line 142
            echo "                ";
            if (((isset($context["od"]) ? $context["od"] : null) == 1)) {
                echo "                     ";
                $context["class"] = ((isset($context["class"]) ? $context["class"] : null) . " desc");
                echo "                 ";
            } else {
                echo "                     ";
                $context["order_desc"] = "&od=1";
                echo "                 ";
            }
            // line 143
            echo "            ";
        }
        // line 144
        echo "            <th class=\"";
        echo twig_escape_filter($this->env, (isset($context["col"]) ? $context["col"] : null), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, (isset($context["class"]) ? $context["class"] : null), "html", null, true);
        echo " sort\">
                <a href='/helpdesk/?";
        // line 145
        echo twig_escape_filter($this->env, (isset($context["get_for_sorting_links"]) ? $context["get_for_sorting_links"] : null), "html", null, true);
        echo "ob=";
        echo twig_escape_filter($this->env, (isset($context["col"]) ? $context["col"] : null), "html", null, true);
        echo twig_escape_filter($this->env, (isset($context["order_desc"]) ? $context["order_desc"] : null), "html", null, true);
        echo "'><span>Изменена</span></a>
            </th>

            ";
        // line 148
        list($context["col"], $context["class"], $context["order_desc"]) =         array("deadline", "", "");
        // line 149
        echo "            ";
        if (((isset($context["ob"]) ? $context["ob"] : null) == (isset($context["col"]) ? $context["col"] : null))) {
            // line 150
            echo "                ";
            $context["class"] = "ordered";
            // line 151
            echo "                ";
            if (((isset($context["od"]) ? $context["od"] : null) == 1)) {
                echo "                     ";
                $context["class"] = ((isset($context["class"]) ? $context["class"] : null) . " desc");
                echo "                 ";
            } else {
                echo "                     ";
                $context["order_desc"] = "&od=1";
                echo "                 ";
            }
            // line 152
            echo "            ";
        }
        // line 153
        echo "            <th class=\"";
        echo twig_escape_filter($this->env, (isset($context["class"]) ? $context["class"] : null), "html", null, true);
        echo " sort\">
                <a href='/helpdesk/?";
        // line 154
        echo twig_escape_filter($this->env, (isset($context["get_for_sorting_links"]) ? $context["get_for_sorting_links"] : null), "html", null, true);
        echo "ob=";
        echo twig_escape_filter($this->env, (isset($context["col"]) ? $context["col"] : null), "html", null, true);
        echo twig_escape_filter($this->env, (isset($context["order_desc"]) ? $context["order_desc"] : null), "html", null, true);
        echo "' title=\"Планируемая дата следующих действий по заявке\"><span>Срок</span></a>
            </th>

            ";
        // line 157
        list($context["col"], $context["class"], $context["order_desc"]) =         array("rate", "", "");
        // line 158
        echo "            ";
        if (((isset($context["ob"]) ? $context["ob"] : null) == (isset($context["col"]) ? $context["col"] : null))) {
            // line 159
            echo "                ";
            $context["class"] = "ordered";
            // line 160
            echo "                ";
            if (((isset($context["od"]) ? $context["od"] : null) == 1)) {
                echo "                     ";
                $context["class"] = ((isset($context["class"]) ? $context["class"] : null) . " desc");
                echo "                 ";
            } else {
                echo "                     ";
                $context["order_desc"] = "&od=1";
                echo "                 ";
            }
            // line 161
            echo "            ";
        }
        // line 162
        echo "            <th class=\"";
        echo twig_escape_filter($this->env, (isset($context["col"]) ? $context["col"] : null), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, (isset($context["class"]) ? $context["class"] : null), "html", null, true);
        echo " sort\">
                <a href='/helpdesk/?";
        // line 163
        echo twig_escape_filter($this->env, (isset($context["get_for_sorting_links"]) ? $context["get_for_sorting_links"] : null), "html", null, true);
        echo "ob=";
        echo twig_escape_filter($this->env, (isset($context["col"]) ? $context["col"] : null), "html", null, true);
        echo twig_escape_filter($this->env, (isset($context["order_desc"]) ? $context["order_desc"] : null), "html", null, true);
        echo "' title='Оценка'>
                    <img src='/stat/img/helpdesk/rate_";
        // line 164
        echo twig_escape_filter($this->env, _twig_default_filter(strtr((isset($context["class"]) ? $context["class"] : null), array(" " => "_")), "0"), "html", null, true);
        echo "_min.png'>
                </a>
            </th>
        </tr>
    ";
        // line 168
        if ((isset($context["tickets"]) ? $context["tickets"] : null)) {
            // line 169
            echo "        ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["tickets"]) ? $context["tickets"] : null));
            foreach ($context['_seq'] as $context["id"] => $context["ticket"]) {
                // line 170
                echo "
            ";
                // line 171
                list($context["unassigned"], $context["burning"]) =                 array("", "");
                // line 172
                echo "
            ";
                // line 173
                if ((!twig_join_filter($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "performers"), ", "))) {
                    // line 174
                    echo "                ";
                    $context["unassigned"] = "unassigned";
                    // line 175
                    echo "            ";
                }
                // line 176
                echo "            ";
                if (((($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "deadline") > 0) && (twig_date_converter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "deadline")) <= twig_date_converter($this->env, "now"))) && twig_in_filter($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "status"), array(0 => 1, 1 => 2, 2 => 3, 3 => 5, 4 => 7)))) {
                    // line 177
                    echo "                ";
                    $context["burning"] = "burning";
                    // line 178
                    echo "            ";
                }
                // line 179
                echo "
            <tr class='status_";
                // line 180
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "status"), "html", null, true);
                echo " ";
                echo twig_escape_filter($this->env, (isset($context["unassigned"]) ? $context["unassigned"] : null), "html", null, true);
                echo " ";
                echo twig_escape_filter($this->env, (isset($context["burning"]) ? $context["burning"] : null), "html", null, true);
                echo "' data-id='";
                echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                echo "'>
                <td>
                    <a id=\"ticket-status_";
                // line 182
                echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                echo "\" class=\"popup_button noborder\">
                        <img class='icon' src='/stat/img/helpdesk/status_";
                // line 183
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "status"), "html", null, true);
                echo ".png' title='";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["statuses"]) ? $context["statuses"] : null), $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "status"), array(), "array"), "name"), "html", null, true);
                echo "'>
                    </a>
                    <div id=\"popup_ticket-status_";
                // line 185
                echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                echo "\" class=\"popup_menu\">
                        <ul>
                            ";
                // line 187
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["statuses"]) ? $context["statuses"] : null));
                foreach ($context['_seq'] as $context["status_id"] => $context["status"]) {
                    // line 188
                    echo "                                ";
                    if (((isset($context["status_id"]) ? $context["status_id"] : null) == $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "status"))) {
                        // line 189
                        echo "                                    <li class=\"current\">
                                        <img class=\"icon\" src='/stat/img/helpdesk/status_";
                        // line 190
                        echo twig_escape_filter($this->env, (isset($context["status_id"]) ? $context["status_id"] : null), "html", null, true);
                        echo ".png'>&nbsp;";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["status"]) ? $context["status"] : null), "name"), "html", null, true);
                        echo "</li>
                                ";
                    } else {
                        // line 192
                        echo "                                    <li>
                                        <a href=\"javascript: changeTicketStatus('";
                        // line 193
                        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                        echo "','";
                        echo twig_escape_filter($this->env, (isset($context["status_id"]) ? $context["status_id"] : null), "html", null, true);
                        echo "')\">
                                            <img class=\"icon\" src='/stat/img/helpdesk/status_";
                        // line 194
                        echo twig_escape_filter($this->env, (isset($context["status_id"]) ? $context["status_id"] : null), "html", null, true);
                        echo ".png'>&nbsp;";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["status"]) ? $context["status"] : null), "name"), "html", null, true);
                        echo "</a>
                                    </li>
                                ";
                    }
                    // line 197
                    echo "                            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['status_id'], $context['status'], $context['_parent'], $context['loop']);
                $context = array_merge($_parent, array_intersect_key($context, $_parent));
                // line 198
                echo "                        </ul>
                    </div>

                </td>
                <td class='weight'><img class='icon' src='/stat/img/helpdesk/weight_";
                // line 202
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "weight"), "html", null, true);
                echo ".png' title='Вес: ";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "weight"), "html", null, true);
                echo "'></td>
                <td class='title'>
                    <a href='./?stage=edit&id=";
                // line 204
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "id"), "html", null, true);
                echo "'><span class=\"ticket_id\">";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "id"), "html", null, true);
                echo ".</span>";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "title"), "html", null, true);
                echo "</a>
                </td>
                <td>";
                // line 206
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["areas"]) ? $context["areas"] : null), $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "area"), array(), "array"), "html", null, true);
                echo "</td>
                <td class='creator'>
                    <a class=\"ticket_creator\" data-id=\"";
                // line 208
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "creator"), "html", null, true);
                echo "\">
                        ";
                // line 209
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["users"]) ? $context["users"] : null), $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "creator"), array(), "array"), "lastname"), "html", null, true);
                echo " ";
                echo twig_escape_filter($this->env, twig_slice($this->env, $this->getAttribute($this->getAttribute((isset($context["users"]) ? $context["users"] : null), $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "creator"), array(), "array"), "firstname"), 0, 1), "html", null, true);
                echo ".";
                echo twig_escape_filter($this->env, twig_slice($this->env, $this->getAttribute($this->getAttribute((isset($context["users"]) ? $context["users"] : null), $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "creator"), array(), "array"), "middlename"), 0, 1), "html", null, true);
                echo ".
                    </a>
                </td>
                <td>
                    ";
                // line 213
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "performers"));
                $context['loop'] = array(
                  'parent' => $context['_parent'],
                  'index0' => 0,
                  'index'  => 1,
                  'first'  => true,
                );
                if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                    $length = count($context['_seq']);
                    $context['loop']['revindex0'] = $length - 1;
                    $context['loop']['revindex'] = $length;
                    $context['loop']['length'] = $length;
                    $context['loop']['last'] = 1 === $length;
                }
                foreach ($context['_seq'] as $context["_key"] => $context["p"]) {
                    // line 214
                    echo "                        <span>";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["p"]) ? $context["p"] : null), "lastname"), "html", null, true);
                    echo " ";
                    echo twig_escape_filter($this->env, twig_slice($this->env, $this->getAttribute((isset($context["p"]) ? $context["p"] : null), "firstname"), 0, 1), "html", null, true);
                    echo ".";
                    echo twig_escape_filter($this->env, twig_slice($this->env, $this->getAttribute((isset($context["p"]) ? $context["p"] : null), "middlename"), 0, 1), "html", null, true);
                    echo ".";
                    echo ((($this->getAttribute((isset($context["loop"]) ? $context["loop"] : null), "index") != twig_length_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "performers")))) ? (", ") : (""));
                    echo "</span>
                    ";
                    ++$context['loop']['index0'];
                    ++$context['loop']['index'];
                    $context['loop']['first'] = false;
                    if (isset($context['loop']['length'])) {
                        --$context['loop']['revindex0'];
                        --$context['loop']['revindex'];
                        $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['p'], $context['_parent'], $context['loop']);
                $context = array_merge($_parent, array_intersect_key($context, $_parent));
                // line 216
                echo "                </td>

                ";
                // line 218
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable(array(0 => "created", 1 => "changed", 2 => "deadline"));
                foreach ($context['_seq'] as $context["_key"] => $context["column"]) {
                    // line 219
                    echo "                    ";
                    list($context["y"], $context["m"], $context["d"], $context["y0"], $context["m0"], $context["d0"]) =                     array(twig_date_format_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), (isset($context["column"]) ? $context["column"] : null), array(), "array"), "Y"), twig_date_format_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), (isset($context["column"]) ? $context["column"] : null), array(), "array"), "m"), twig_date_format_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), (isset($context["column"]) ? $context["column"] : null), array(), "array"), "j"), twig_date_format_filter($this->env, "now", "Y"), twig_date_format_filter($this->env, "now", "m"), twig_date_format_filter($this->env, "now", "j"));
                    // line 220
                    echo "                        ";
                    if (($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), (isset($context["column"]) ? $context["column"] : null), array(), "array") > 0)) {
                        // line 221
                        echo "                            ";
                        if (((isset($context["y"]) ? $context["y"] : null) == (isset($context["y0"]) ? $context["y0"] : null))) {
                            // line 222
                            echo "                                ";
                            if (((isset($context["m"]) ? $context["m"] : null) == (isset($context["m0"]) ? $context["m0"] : null))) {
                                // line 223
                                echo "                                    ";
                                if (((isset($context["d"]) ? $context["d"] : null) == (isset($context["d0"]) ? $context["d0"] : null))) {
                                    // line 224
                                    echo "                                        ";
                                    $context["td"] = (((((isset($context["column"]) ? $context["column"] : null) == "created") || ((isset($context["column"]) ? $context["column"] : null) == "changed"))) ? (twig_date_format_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), (isset($context["column"]) ? $context["column"] : null), array(), "array"), "G:i")) : ("сегодня"));
                                    // line 225
                                    echo "                                        ";
                                    $context["title"] = (((((isset($context["column"]) ? $context["column"] : null) == "created") || ((isset($context["column"]) ? $context["column"] : null) == "changed"))) ? (("Сегодня в " . twig_date_format_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), (isset($context["column"]) ? $context["column"] : null), array(), "array"), "G:i"))) : (""));
                                    // line 226
                                    echo "                                    ";
                                } elseif (((isset($context["d"]) ? $context["d"] : null) == ((isset($context["d0"]) ? $context["d0"] : null) - 1))) {
                                    // line 227
                                    echo "                                        ";
                                    $context["td"] = "вчера";
                                    // line 228
                                    echo "                                        ";
                                    $context["title"] = (((((isset($context["column"]) ? $context["column"] : null) == "created") || ((isset($context["column"]) ? $context["column"] : null) == "changed"))) ? (("Вчера в " . twig_date_format_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), (isset($context["column"]) ? $context["column"] : null), array(), "array"), "G:i"))) : (""));
                                    // line 229
                                    echo "                                    ";
                                } elseif (((isset($context["d"]) ? $context["d"] : null) == ((isset($context["d0"]) ? $context["d0"] : null) + 1))) {
                                    // line 230
                                    echo "                                        ";
                                    $context["td"] = "завтра";
                                    // line 231
                                    echo "                                    ";
                                } else {
                                    // line 232
                                    echo "                                        ";
                                    $context["td"] = (((isset($context["d"]) ? $context["d"] : null) . " ") . twig_slice($this->env, $this->getAttribute((isset($context["MONTHS_G"]) ? $context["MONTHS_G"] : null), ((isset($context["m"]) ? $context["m"] : null) - 1), array(), "array"), 0, 3));
                                    // line 233
                                    echo "                                        ";
                                    $context["title"] = (((((isset($context["column"]) ? $context["column"] : null) == "created") || ((isset($context["column"]) ? $context["column"] : null) == "changed"))) ? ((((((isset($context["d"]) ? $context["d"] : null) . " ") . $this->getAttribute((isset($context["MONTHS_G"]) ? $context["MONTHS_G"] : null), ((isset($context["m"]) ? $context["m"] : null) - 1), array(), "array")) . " в ") . twig_date_format_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), (isset($context["column"]) ? $context["column"] : null), array(), "array"), "G:i"))) : (""));
                                    // line 234
                                    echo "                                    ";
                                }
                                // line 235
                                echo "                                ";
                            } else {
                                // line 236
                                echo "                                    ";
                                $context["td"] = (((isset($context["d"]) ? $context["d"] : null) . " ") . twig_slice($this->env, $this->getAttribute((isset($context["MONTHS_G"]) ? $context["MONTHS_G"] : null), ((isset($context["m"]) ? $context["m"] : null) - 1), array(), "array"), 0, 3));
                                // line 237
                                echo "                                    ";
                                $context["title"] = (((((isset($context["column"]) ? $context["column"] : null) == "created") || ((isset($context["column"]) ? $context["column"] : null) == "changed"))) ? ((((((isset($context["d"]) ? $context["d"] : null) . " ") . $this->getAttribute((isset($context["MONTHS_G"]) ? $context["MONTHS_G"] : null), ((isset($context["m"]) ? $context["m"] : null) - 1), array(), "array")) . " в ") . twig_date_format_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), (isset($context["column"]) ? $context["column"] : null), array(), "array"), "G:i"))) : (""));
                                // line 238
                                echo "                                ";
                            }
                            // line 239
                            echo "                            ";
                        } else {
                            // line 240
                            echo "                                ";
                            $context["td"] = (((((isset($context["d"]) ? $context["d"] : null) . ".") . (isset($context["m"]) ? $context["m"] : null)) . ".") . (isset($context["y"]) ? $context["y"] : null));
                            // line 241
                            echo "                                ";
                            $context["title"] = ((((((isset($context["d"]) ? $context["d"] : null) . " ") . $this->getAttribute((isset($context["MONTHS_G"]) ? $context["MONTHS_G"] : null), ((isset($context["m"]) ? $context["m"] : null) - 1), array(), "array")) . (isset($context["y"]) ? $context["y"] : null)) . "г. в ") . twig_date_format_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), (isset($context["column"]) ? $context["column"] : null), array(), "array"), "G:i"));
                            // line 242
                            echo "                            ";
                        }
                        // line 243
                        echo "                        ";
                    } else {
                        // line 244
                        echo "                            ";
                        $context["td"] = "—";
                        // line 245
                        echo "                        ";
                    }
                    // line 246
                    echo "                    <td class=\"c-align ";
                    echo twig_escape_filter($this->env, (isset($context["column"]) ? $context["column"] : null), "html", null, true);
                    echo " ";
                    echo ((((((isset($context["y"]) ? $context["y"] : null) == (isset($context["y0"]) ? $context["y0"] : null)) && ((isset($context["m"]) ? $context["m"] : null) == (isset($context["m0"]) ? $context["m0"] : null))) && ((isset($context["d"]) ? $context["d"] : null) == (isset($context["d0"]) ? $context["d0"] : null)))) ? ("today") : (""));
                    echo "\" title=\"";
                    echo twig_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
                    echo "\" >
                        ";
                    // line 247
                    echo twig_escape_filter($this->env, (isset($context["td"]) ? $context["td"] : null), "html", null, true);
                    echo "
                    </td>
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['column'], $context['_parent'], $context['loop']);
                $context = array_merge($_parent, array_intersect_key($context, $_parent));
                // line 250
                echo "

                ";
                // line 253
                echo "                ";
                // line 254
                echo "                    ";
                // line 255
                echo "                        ";
                // line 256
                echo "                            ";
                // line 257
                echo "                        ";
                // line 258
                echo "                            ";
                // line 259
                echo "                        ";
                // line 260
                echo "                    ";
                // line 261
                echo "                        ";
                // line 262
                echo "                    ";
                // line 263
                echo "                ";
                // line 264
                echo "
                ";
                // line 266
                echo "                    ";
                // line 267
                echo "                        ";
                // line 268
                echo "                            ";
                // line 269
                echo "                        ";
                // line 270
                echo "                            ";
                // line 271
                echo "                        ";
                // line 272
                echo "                    ";
                // line 273
                echo "                        ";
                // line 274
                echo "                    ";
                // line 275
                echo "                ";
                // line 276
                echo "
                <td class=\"c-align rate\">
                    <img src=\"/stat/img/helpdesk/rate_";
                // line 278
                echo twig_escape_filter($this->env, ((twig_test_empty($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "rate"))) ? ("0") : ($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "rate"))), "html", null, true);
                echo "_min.png\" title=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "rate"), "html", null, true);
                echo "\">
                </td>
            </tr>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['id'], $context['ticket'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 282
            echo "    ";
        } else {
            // line 283
            echo "        <tr>
            <td colspan='11' class='not_found'>Заявок не найдено.</td>
        </tr>
    ";
        }
        // line 287
        echo "
    </table>
    <div class='table-footer'>
        <span class='statusbar'>Заявок: ";
        // line 290
        echo twig_escape_filter($this->env, (isset($context["row_count"]) ? $context["row_count"] : null), "html", null, true);
        echo "</span>
        ";
        // line 291
        if (((isset($context["pages"]) ? $context["pages"] : null) > 1)) {
            // line 292
            echo "            <div class=\"pagenumbers\">
                ";
            // line 293
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable(range(0, ((isset($context["pages"]) ? $context["pages"] : null) - 1)));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 294
                echo "                    ";
                if (((((isset($context["i"]) ? $context["i"] : null) == 1) && ((isset($context["page"]) ? $context["page"] : null) > 3)) || (((isset($context["i"]) ? $context["i"] : null) == ((isset($context["page"]) ? $context["page"] : null) + 3)) && (((isset($context["pages"]) ? $context["pages"] : null) - (isset($context["page"]) ? $context["page"] : null)) > 4)))) {
                    // line 295
                    echo "                        <span class = 'pagespace'>…</span>
                    ";
                } else {
                    // line 297
                    echo "                        ";
                    if (((((isset($context["i"]) ? $context["i"] : null) == 0) || (((isset($context["i"]) ? $context["i"] : null) > ((isset($context["page"]) ? $context["page"] : null) - 3)) && ((isset($context["i"]) ? $context["i"] : null) < ((isset($context["page"]) ? $context["page"] : null) + 4)))) || ((isset($context["i"]) ? $context["i"] : null) == ((isset($context["pages"]) ? $context["pages"] : null) - 1)))) {
                        // line 298
                        echo "                            ";
                        if (((isset($context["page"]) ? $context["page"] : null) == (isset($context["i"]) ? $context["i"] : null))) {
                            // line 299
                            echo "                                <span class=\"page current\">";
                            echo twig_escape_filter($this->env, ((isset($context["i"]) ? $context["i"] : null) + 1), "html", null, true);
                            echo "</span>
                            ";
                        } else {
                            // line 301
                            echo "                                <a class=\"page\" href='/helpdesk?";
                            echo twig_escape_filter($this->env, (isset($context["get_for_pagenumbers"]) ? $context["get_for_pagenumbers"] : null), "html", null, true);
                            echo "page=";
                            echo twig_escape_filter($this->env, (isset($context["i"]) ? $context["i"] : null), "html", null, true);
                            echo "'>";
                            echo twig_escape_filter($this->env, ((isset($context["i"]) ? $context["i"] : null) + 1), "html", null, true);
                            echo "</a>
                            ";
                        }
                        // line 303
                        echo "                        ";
                    }
                    // line 304
                    echo "                    ";
                }
                // line 305
                echo "                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 306
            echo "            </div>
        ";
        }
        // line 308
        echo "    </div>

    <div class='buttons'>
        <div class='right'>
            <a class='button green' href='./?stage=new'>Новая заявка</a>
        </div>
    </div>

</div>
    <div class='float filter'>
        <div class='header'>Фильтры
            <a class=\"settings\">
                <img id=\"button_filters_settings\" src=\"/stat/img/settings.png\">
            </a>
        </div>

        <div class='filters_block'>

            ";
        // line 326
        $this->env->loadTemplate("helpdesk/filters_block.twig")->display($context);
        // line 327
        echo "
        </div>

        <hr>

        ";
        // line 333
        echo "        <div class='params_block contractor cut_block cutted'>
            <span class=\"cutter pic\"></span>
            <span class='category_name cutter'>Ответственный</span>
            <span class=\"count\"></span>
            <div class='cut'>
                ";
        // line 338
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["admins"]) ? $context["admins"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["contractor"]) {
            // line 339
            echo "
                    ";
            // line 340
            $context["c_id"] = $this->getAttribute((isset($context["contractor"]) ? $context["contractor"] : null), "uid");
            // line 341
            echo "                    ";
            $context["c_fio"] = (($this->getAttribute((isset($context["contractor"]) ? $context["contractor"] : null), "lastname") . " ") . $this->getAttribute((isset($context["contractor"]) ? $context["contractor"] : null), "firstname"));
            // line 342
            echo "                    ";
            if (((isset($context["c_id"]) ? $context["c_id"] : null) == (isset($context["admin_id"]) ? $context["admin_id"] : null))) {
                echo "   ";
                list($context["its_me"], $context["c_id"], $context["c_fio"]) =                 array("its_me", 0, "Я");
                // line 343
                echo "                    ";
            } else {
                echo "                ";
                $context["its_me"] = "";
                // line 344
                echo "                    ";
            }
            // line 345
            echo "
                    <div class='param ";
            // line 346
            echo twig_escape_filter($this->env, (isset($context["its_me"]) ? $context["its_me"] : null), "html", null, true);
            echo "'>
                        <label><input class=\"filter_checkbox\" type='checkbox' data-contractor='";
            // line 347
            echo twig_escape_filter($this->env, (isset($context["c_id"]) ? $context["c_id"] : null), "html", null, true);
            echo "'/>";
            echo twig_escape_filter($this->env, (isset($context["c_fio"]) ? $context["c_fio"] : null), "html", null, true);
            echo "</label>
                    </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['contractor'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 350
        echo "            </div>
        </div>

        ";
        // line 354
        echo "        <div class='params_block performers cut_block cutted'>
            <span class=\"cutter pic\"></span>
            <span class='category_name cutter'>Исполнители</span>
            <span class=\"count\"></span>
            <div class='cut'>
                ";
        // line 359
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["admins"]) ? $context["admins"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["performer"]) {
            // line 360
            echo "
                    ";
            // line 361
            $context["p_id"] = $this->getAttribute((isset($context["performer"]) ? $context["performer"] : null), "uid");
            // line 362
            echo "                    ";
            $context["p_fio"] = (($this->getAttribute((isset($context["performer"]) ? $context["performer"] : null), "lastname") . " ") . $this->getAttribute((isset($context["performer"]) ? $context["performer"] : null), "firstname"));
            // line 363
            echo "                    ";
            if (((isset($context["p_id"]) ? $context["p_id"] : null) == (isset($context["admin_id"]) ? $context["admin_id"] : null))) {
                echo "   ";
                list($context["its_me"], $context["p_id"], $context["p_fio"]) =                 array("its_me", 0, "Я");
                // line 364
                echo "                    ";
            } else {
                echo "                ";
                $context["its_me"] = "";
                // line 365
                echo "                    ";
            }
            // line 366
            echo "
                    <div class='param ";
            // line 367
            echo twig_escape_filter($this->env, (isset($context["its_me"]) ? $context["its_me"] : null), "html", null, true);
            echo "'>
                        <label><input class=\"filter_checkbox\" type='checkbox' data-performers=\"@";
            // line 368
            echo twig_escape_filter($this->env, (isset($context["p_id"]) ? $context["p_id"] : null), "html", null, true);
            echo "@\"/>";
            echo twig_escape_filter($this->env, (isset($context["p_fio"]) ? $context["p_fio"] : null), "html", null, true);
            echo "</label>
                    </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['performer'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 371
        echo "            </div>
        </div>

        ";
        // line 375
        echo "        ";
        if ((isset($context["statuses"]) ? $context["statuses"] : null)) {
            // line 376
            echo "            <div class='params_block status cut_block cutted'>
                <span class=\"cutter pic\"></span>
                <span class='category_name cutter'>Статус</span>
                <span class=\"count\"></span>
                <div class='cut'>
                    ";
            // line 381
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["statuses"]) ? $context["statuses"] : null));
            foreach ($context['_seq'] as $context["status_id"] => $context["status"]) {
                // line 382
                echo "                        <div class='param'>
                            <label>
                                <input class=\"filter_checkbox\" type='checkbox' data-status='";
                // line 384
                echo twig_escape_filter($this->env, (isset($context["status_id"]) ? $context["status_id"] : null), "html", null, true);
                echo "'/>
                                ";
                // line 386
                echo "                                ";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["status"]) ? $context["status"] : null), "name"), "html", null, true);
                echo "</label>
                        </div>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['status_id'], $context['status'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 389
            echo "                </div>
            </div>
        ";
        }
        // line 392
        echo "
        ";
        // line 394
        echo "        ";
        if ((isset($context["areas"]) ? $context["areas"] : null)) {
            // line 395
            echo "            <div class='params_block area cut_block cutted'>
                <span class=\"cutter pic\"></span>
                <span class='category_name cutter'>Территория</span>
                <span class=\"count\"></span>
                <div class='cut'>
                    ";
            // line 400
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["areas"]) ? $context["areas"] : null));
            foreach ($context['_seq'] as $context["area_id"] => $context["area"]) {
                // line 401
                echo "                        <div class='param'>
                            <label><input class=\"filter_checkbox\" type='checkbox' data-area='";
                // line 402
                echo twig_escape_filter($this->env, (isset($context["area_id"]) ? $context["area_id"] : null), "html", null, true);
                echo "'/>";
                echo twig_escape_filter($this->env, (isset($context["area"]) ? $context["area"] : null), "html", null, true);
                echo "</label>
                        </div>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['area_id'], $context['area'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 405
            echo "                </div>
            </div>
        ";
        }
        // line 408
        echo "
        ";
        // line 410
        echo "        ";
        // line 411
        echo "            ";
        // line 412
        echo "                ";
        // line 413
        echo "                ";
        // line 414
        echo "                    ";
        // line 415
        echo "                        ";
        // line 416
        echo "                            ";
        // line 417
        echo "                        ";
        // line 418
        echo "                    ";
        // line 419
        echo "                ";
        // line 420
        echo "            ";
        // line 421
        echo "        ";
        // line 422
        echo "
        ";
        // line 424
        echo "        <div class='params_block type cut_block cutted'>
            <span class=\"cutter pic\"></span>
            <span class='category_name cutter'>Тип</span>
            <span class=\"count\"></span>
            <div class='cut'>
                ";
        // line 429
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["types"]) ? $context["types"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["type"]) {
            // line 430
            echo "                    <div class='param'>
                        <label><input class=\"filter_checkbox\" type='checkbox' data-type='";
            // line 431
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["type"]) ? $context["type"] : null), "id"), "html", null, true);
            echo "'/>";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["type"]) ? $context["type"] : null), "name"), "html", null, true);
            echo "</label>
                    </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['type'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 434
        echo "            </div>
        </div>


        ";
        // line 439
        echo "        <div class='params_block category cut_block cutted'>
            <span class=\"cutter pic\"></span>
            <span class='category_name cutter'>Категория</span>
            <span class=\"count\"></span>
            <div class='cut'>
                ";
        // line 444
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["categories"]) ? $context["categories"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
            // line 445
            echo "                    <div class='param'>
                        <label><input class=\"filter_checkbox\" type='checkbox' data-category='";
            // line 446
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["category"]) ? $context["category"] : null), "id"), "html", null, true);
            echo "'/>";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["category"]) ? $context["category"] : null), "name"), "html", null, true);
            echo "</label>
                    </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 449
        echo "            </div>
        </div>

        ";
        // line 453
        echo "        <div class='params_block rate cut_block cutted'>
            <span class=\"cutter pic\"></span>
            <span class='category_name cutter'>Оценка</span>
            <span class=\"count\"></span>
            <div class='cut'>
                ";
        // line 458
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable(range(5, 1));
        foreach ($context['_seq'] as $context["_key"] => $context["rate"]) {
            // line 459
            echo "                    <div class='param'>
                        <label><input class=\"filter_checkbox\" type='checkbox' data-rate='";
            // line 460
            echo twig_escape_filter($this->env, (isset($context["rate"]) ? $context["rate"] : null), "html", null, true);
            echo "'/>";
            echo twig_escape_filter($this->env, (isset($context["rate"]) ? $context["rate"] : null), "html", null, true);
            echo " баллов</label>
                    </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['rate'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 463
        echo "
                <div class='param'>
                    <label><input class=\"filter_checkbox\" type='checkbox' data-rate='0'/>без оценки</label>
                </div>
            </div>
        </div>


        <div class='filter_buttons'>
            <a class='apply_filter' onclick=\"applyFilter()\">Показать</a>
            <a class='reset_filter' onclick=\"resetFilter()\">Очистить</a>
            <a class='save_filter'  onclick=\"saveFilter()\" >Сохранить</a>
        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "helpdesk.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1318 => 463,  1307 => 460,  1304 => 459,  1300 => 458,  1293 => 453,  1288 => 449,  1277 => 446,  1274 => 445,  1270 => 444,  1263 => 439,  1257 => 434,  1246 => 431,  1243 => 430,  1239 => 429,  1232 => 424,  1229 => 422,  1227 => 421,  1225 => 420,  1223 => 419,  1221 => 418,  1219 => 417,  1217 => 416,  1215 => 415,  1213 => 414,  1211 => 413,  1209 => 412,  1207 => 411,  1205 => 410,  1202 => 408,  1197 => 405,  1186 => 402,  1183 => 401,  1179 => 400,  1172 => 395,  1169 => 394,  1166 => 392,  1161 => 389,  1151 => 386,  1147 => 384,  1143 => 382,  1139 => 381,  1132 => 376,  1129 => 375,  1124 => 371,  1113 => 368,  1109 => 367,  1106 => 366,  1103 => 365,  1098 => 364,  1093 => 363,  1090 => 362,  1088 => 361,  1085 => 360,  1081 => 359,  1074 => 354,  1069 => 350,  1058 => 347,  1054 => 346,  1051 => 345,  1048 => 344,  1043 => 343,  1038 => 342,  1035 => 341,  1033 => 340,  1030 => 339,  1026 => 338,  1019 => 333,  1012 => 327,  1010 => 326,  990 => 308,  986 => 306,  980 => 305,  977 => 304,  974 => 303,  964 => 301,  958 => 299,  955 => 298,  952 => 297,  948 => 295,  945 => 294,  941 => 293,  938 => 292,  936 => 291,  932 => 290,  927 => 287,  921 => 283,  918 => 282,  906 => 278,  902 => 276,  900 => 275,  898 => 274,  896 => 273,  894 => 272,  892 => 271,  890 => 270,  888 => 269,  886 => 268,  884 => 267,  882 => 266,  879 => 264,  877 => 263,  875 => 262,  873 => 261,  871 => 260,  869 => 259,  867 => 258,  865 => 257,  863 => 256,  861 => 255,  859 => 254,  857 => 253,  853 => 250,  844 => 247,  835 => 246,  832 => 245,  829 => 244,  826 => 243,  823 => 242,  820 => 241,  817 => 240,  814 => 239,  811 => 238,  808 => 237,  805 => 236,  802 => 235,  799 => 234,  796 => 233,  793 => 232,  790 => 231,  787 => 230,  784 => 229,  781 => 228,  778 => 227,  775 => 226,  772 => 225,  769 => 224,  766 => 223,  763 => 222,  760 => 221,  757 => 220,  754 => 219,  750 => 218,  746 => 216,  723 => 214,  706 => 213,  695 => 209,  691 => 208,  686 => 206,  677 => 204,  670 => 202,  664 => 198,  658 => 197,  650 => 194,  644 => 193,  641 => 192,  634 => 190,  631 => 189,  628 => 188,  624 => 187,  619 => 185,  612 => 183,  608 => 182,  597 => 180,  594 => 179,  591 => 178,  588 => 177,  585 => 176,  582 => 175,  579 => 174,  577 => 173,  574 => 172,  572 => 171,  569 => 170,  564 => 169,  562 => 168,  555 => 164,  548 => 163,  541 => 162,  538 => 161,  527 => 160,  524 => 159,  521 => 158,  519 => 157,  510 => 154,  505 => 153,  502 => 152,  491 => 151,  488 => 150,  485 => 149,  483 => 148,  474 => 145,  467 => 144,  464 => 143,  453 => 142,  450 => 141,  447 => 140,  445 => 139,  436 => 136,  431 => 135,  428 => 134,  417 => 133,  414 => 132,  411 => 131,  409 => 130,  400 => 127,  395 => 126,  392 => 125,  381 => 124,  378 => 123,  375 => 122,  373 => 121,  364 => 118,  357 => 117,  354 => 116,  343 => 115,  340 => 114,  337 => 113,  335 => 112,  326 => 109,  321 => 108,  318 => 107,  315 => 106,  312 => 105,  309 => 104,  306 => 103,  303 => 102,  300 => 101,  297 => 100,  295 => 99,  286 => 96,  281 => 95,  278 => 94,  267 => 93,  264 => 92,  261 => 91,  259 => 90,  252 => 86,  245 => 85,  238 => 84,  235 => 83,  224 => 82,  221 => 81,  218 => 80,  216 => 79,  209 => 75,  202 => 74,  195 => 73,  192 => 72,  181 => 71,  178 => 70,  175 => 69,  173 => 68,  157 => 54,  151 => 50,  148 => 49,  142 => 48,  132 => 46,  126 => 44,  123 => 43,  119 => 42,  113 => 38,  110 => 37,  100 => 32,  95 => 31,  93 => 30,  84 => 23,  81 => 22,  75 => 19,  68 => 16,  66 => 15,  62 => 14,  60 => 12,  58 => 11,  56 => 10,  52 => 9,  48 => 8,  44 => 7,  40 => 6,  36 => 5,  32 => 4,  28 => 3,  26 => 2,);
    }
}
