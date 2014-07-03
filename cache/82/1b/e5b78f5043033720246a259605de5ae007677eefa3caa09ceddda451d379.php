<?php

/* helpdesk.twig */
class __TwigTemplate_821be5b78f5043033720246a259605de5ae007677eefa3caa09ceddda451d379 extends Twig_Template
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
        $context = array_intersect_key($context, $_parent) + $_parent;
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
        // line 41
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable(array(0 => 10, 1 => 20, 2 => 50, 3 => 100, 4 => 250));
        foreach ($context['_seq'] as $context["_key"] => $context["rows"]) {
            // line 42
            echo "            ";
            if (((isset($context["rows"]) ? $context["rows"] : null) == (isset($context["r"]) ? $context["r"] : null))) {
                // line 43
                echo "                <span>";
                echo twig_escape_filter($this->env, (isset($context["rows"]) ? $context["rows"] : null), "html", null, true);
                echo "</span>
            ";
            } else {
                // line 45
                echo "                <a href='/helpdesk?";
                echo twig_escape_filter($this->env, (isset($context["get_for_list_view"]) ? $context["get_for_list_view"] : null), "html", null, true);
                echo "r=";
                echo twig_escape_filter($this->env, (isset($context["rows"]) ? $context["rows"] : null), "html", null, true);
                echo "'>";
                echo twig_escape_filter($this->env, (isset($context["rows"]) ? $context["rows"] : null), "html", null, true);
                echo "</a>
            ";
            }
            // line 47
            echo "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['rows'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 48
        echo "        ";
        if (((isset($context["admin_id"]) ? $context["admin_id"] : null) == 164)) {
            // line 49
            echo "            <span class=\"block_button_show_timeline\">
                <a class=\"button_show_timeline\">+</a>
            </span>
        ";
        }
        // line 53
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
        // line 67
        list($context["col"], $context["class"], $context["order_desc"]) =         array("status", "", "");
        // line 68
        echo "            ";
        if (((isset($context["ob"]) ? $context["ob"] : null) == (isset($context["col"]) ? $context["col"] : null))) {
            // line 69
            echo "                ";
            $context["class"] = "ordered";
            // line 70
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
            // line 71
            echo "            ";
        }
        // line 72
        echo "            <th class=\"";
        echo twig_escape_filter($this->env, (isset($context["col"]) ? $context["col"] : null), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, (isset($context["class"]) ? $context["class"] : null), "html", null, true);
        echo " sort\">
                <a href='/helpdesk/?";
        // line 73
        echo twig_escape_filter($this->env, (isset($context["get_for_sorting_links"]) ? $context["get_for_sorting_links"] : null), "html", null, true);
        echo "ob=";
        echo twig_escape_filter($this->env, (isset($context["col"]) ? $context["col"] : null), "html", null, true);
        echo twig_escape_filter($this->env, (isset($context["order_desc"]) ? $context["order_desc"] : null), "html", null, true);
        echo "' title='Статус'>
                    <img class='icon' src='/stat/img/helpdesk/status_";
        // line 74
        echo twig_escape_filter($this->env, _twig_default_filter(strtr((isset($context["class"]) ? $context["class"] : null), array(" " => "_")), "0"), "html", null, true);
        echo ".png'>
                </a>
            </th>

            ";
        // line 78
        list($context["col"], $context["class"], $context["order_desc"]) =         array("weight", "", "&od=1");
        // line 79
        echo "            ";
        if (((isset($context["ob"]) ? $context["ob"] : null) == (isset($context["col"]) ? $context["col"] : null))) {
            // line 80
            echo "                ";
            $context["class"] = "ordered";
            // line 81
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
            // line 82
            echo "            ";
        }
        // line 83
        echo "            <th class=\"";
        echo twig_escape_filter($this->env, (isset($context["col"]) ? $context["col"] : null), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, (isset($context["class"]) ? $context["class"] : null), "html", null, true);
        echo " sort\">
                <a href='/helpdesk/?";
        // line 84
        echo twig_escape_filter($this->env, (isset($context["get_for_sorting_links"]) ? $context["get_for_sorting_links"] : null), "html", null, true);
        echo "ob=";
        echo twig_escape_filter($this->env, (isset($context["col"]) ? $context["col"] : null), "html", null, true);
        echo twig_escape_filter($this->env, (isset($context["order_desc"]) ? $context["order_desc"] : null), "html", null, true);
        echo "' title='Вес'>
                    <img class='icon' src='/stat/img/helpdesk/type_";
        // line 85
        echo twig_escape_filter($this->env, _twig_default_filter(strtr((isset($context["class"]) ? $context["class"] : null), array(" " => "_")), "0"), "html", null, true);
        echo ".png'>
                </a>
            </th>

            ";
        // line 89
        list($context["col"], $context["class"], $context["order_desc"]) =         array("title", "", "");
        // line 90
        echo "            ";
        if (((isset($context["ob"]) ? $context["ob"] : null) == (isset($context["col"]) ? $context["col"] : null))) {
            // line 91
            echo "                ";
            $context["class"] = "ordered";
            // line 92
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
            // line 93
            echo "            ";
        }
        // line 94
        echo "            <th class=\"";
        echo twig_escape_filter($this->env, (isset($context["class"]) ? $context["class"] : null), "html", null, true);
        echo " sort\">
                <a href='/helpdesk/?";
        // line 95
        echo twig_escape_filter($this->env, (isset($context["get_for_sorting_links"]) ? $context["get_for_sorting_links"] : null), "html", null, true);
        echo "ob=";
        echo twig_escape_filter($this->env, (isset($context["col"]) ? $context["col"] : null), "html", null, true);
        echo twig_escape_filter($this->env, (isset($context["order_desc"]) ? $context["order_desc"] : null), "html", null, true);
        echo "'><span>Тема</span></a>
            </th>

            ";
        // line 98
        list($context["col"], $context["class"], $context["order_desc"]) =         array("area", "", "");
        // line 99
        echo "            ";
        if (((isset($context["ob"]) ? $context["ob"] : null) == (isset($context["col"]) ? $context["col"] : null))) {
            // line 100
            echo "                ";
            $context["class"] = "ordered";
            // line 101
            echo "                ";
            if (((isset($context["od"]) ? $context["od"] : null) == 1)) {
                // line 102
                echo "                    ";
                $context["class"] = ((isset($context["class"]) ? $context["class"] : null) . " desc");
                // line 103
                echo "                ";
            } else {
                // line 104
                echo "                    ";
                $context["order_desc"] = "&od=1";
                // line 105
                echo "                ";
            }
            // line 106
            echo "            ";
        }
        // line 107
        echo "            <th class=\"";
        echo twig_escape_filter($this->env, (isset($context["class"]) ? $context["class"] : null), "html", null, true);
        echo " sort\">
                <a href='/helpdesk/?";
        // line 108
        echo twig_escape_filter($this->env, (isset($context["get_for_sorting_links"]) ? $context["get_for_sorting_links"] : null), "html", null, true);
        echo "ob=";
        echo twig_escape_filter($this->env, (isset($context["col"]) ? $context["col"] : null), "html", null, true);
        echo twig_escape_filter($this->env, (isset($context["order_desc"]) ? $context["order_desc"] : null), "html", null, true);
        echo "'><span>Территория</span></a>
            </th>

            ";
        // line 111
        list($context["col"], $context["class"], $context["order_desc"]) =         array("creator", "", "");
        // line 112
        echo "            ";
        if (((isset($context["ob"]) ? $context["ob"] : null) == (isset($context["col"]) ? $context["col"] : null))) {
            // line 113
            echo "                ";
            $context["class"] = "ordered";
            // line 114
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
            // line 115
            echo "            ";
        }
        // line 116
        echo "            <th class=\"";
        echo twig_escape_filter($this->env, (isset($context["col"]) ? $context["col"] : null), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, (isset($context["class"]) ? $context["class"] : null), "html", null, true);
        echo " sort\">
                <a href='/helpdesk/?";
        // line 117
        echo twig_escape_filter($this->env, (isset($context["get_for_sorting_links"]) ? $context["get_for_sorting_links"] : null), "html", null, true);
        echo "ob=";
        echo twig_escape_filter($this->env, (isset($context["col"]) ? $context["col"] : null), "html", null, true);
        echo twig_escape_filter($this->env, (isset($context["order_desc"]) ? $context["order_desc"] : null), "html", null, true);
        echo "'><span>Постановщик</span></a>
            </th>

            ";
        // line 120
        list($context["col"], $context["class"], $context["order_desc"]) =         array("performers", "", "");
        // line 121
        echo "            ";
        if (((isset($context["ob"]) ? $context["ob"] : null) == (isset($context["col"]) ? $context["col"] : null))) {
            // line 122
            echo "                ";
            $context["class"] = "ordered";
            // line 123
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
            // line 124
            echo "            ";
        }
        // line 125
        echo "            <th class=\"";
        echo twig_escape_filter($this->env, (isset($context["class"]) ? $context["class"] : null), "html", null, true);
        echo " sort\">
                <a href='/helpdesk/?";
        // line 126
        echo twig_escape_filter($this->env, (isset($context["get_for_sorting_links"]) ? $context["get_for_sorting_links"] : null), "html", null, true);
        echo "ob=";
        echo twig_escape_filter($this->env, (isset($context["col"]) ? $context["col"] : null), "html", null, true);
        echo twig_escape_filter($this->env, (isset($context["order_desc"]) ? $context["order_desc"] : null), "html", null, true);
        echo "'><span>Исполнители</span></a>
            </th>

            ";
        // line 129
        list($context["col"], $context["class"], $context["order_desc"]) =         array("created", "", "");
        // line 130
        echo "            ";
        if (((isset($context["ob"]) ? $context["ob"] : null) == (isset($context["col"]) ? $context["col"] : null))) {
            // line 131
            echo "                ";
            $context["class"] = "ordered";
            // line 132
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
            // line 133
            echo "            ";
        }
        // line 134
        echo "            <th class=\"";
        echo twig_escape_filter($this->env, (isset($context["class"]) ? $context["class"] : null), "html", null, true);
        echo " sort\">
                <a href='/helpdesk/?";
        // line 135
        echo twig_escape_filter($this->env, (isset($context["get_for_sorting_links"]) ? $context["get_for_sorting_links"] : null), "html", null, true);
        echo "ob=";
        echo twig_escape_filter($this->env, (isset($context["col"]) ? $context["col"] : null), "html", null, true);
        echo twig_escape_filter($this->env, (isset($context["order_desc"]) ? $context["order_desc"] : null), "html", null, true);
        echo "'><span>Создана</span></a>
            </th>

            ";
        // line 138
        list($context["col"], $context["class"], $context["order_desc"]) =         array("changed", "", "");
        // line 139
        echo "            ";
        if (((isset($context["ob"]) ? $context["ob"] : null) == (isset($context["col"]) ? $context["col"] : null))) {
            // line 140
            echo "                ";
            $context["class"] = "ordered";
            // line 141
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
            // line 142
            echo "            ";
        }
        // line 143
        echo "            <th class=\"";
        echo twig_escape_filter($this->env, (isset($context["col"]) ? $context["col"] : null), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, (isset($context["class"]) ? $context["class"] : null), "html", null, true);
        echo " sort\">
                <a href='/helpdesk/?";
        // line 144
        echo twig_escape_filter($this->env, (isset($context["get_for_sorting_links"]) ? $context["get_for_sorting_links"] : null), "html", null, true);
        echo "ob=";
        echo twig_escape_filter($this->env, (isset($context["col"]) ? $context["col"] : null), "html", null, true);
        echo twig_escape_filter($this->env, (isset($context["order_desc"]) ? $context["order_desc"] : null), "html", null, true);
        echo "'><span>Изменена</span></a>
            </th>

            ";
        // line 147
        list($context["col"], $context["class"], $context["order_desc"]) =         array("deadline", "", "");
        // line 148
        echo "            ";
        if (((isset($context["ob"]) ? $context["ob"] : null) == (isset($context["col"]) ? $context["col"] : null))) {
            // line 149
            echo "                ";
            $context["class"] = "ordered";
            // line 150
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
            // line 151
            echo "            ";
        }
        // line 152
        echo "            <th class=\"";
        echo twig_escape_filter($this->env, (isset($context["class"]) ? $context["class"] : null), "html", null, true);
        echo " sort\">
                <a href='/helpdesk/?";
        // line 153
        echo twig_escape_filter($this->env, (isset($context["get_for_sorting_links"]) ? $context["get_for_sorting_links"] : null), "html", null, true);
        echo "ob=";
        echo twig_escape_filter($this->env, (isset($context["col"]) ? $context["col"] : null), "html", null, true);
        echo twig_escape_filter($this->env, (isset($context["order_desc"]) ? $context["order_desc"] : null), "html", null, true);
        echo "' title=\"Планируемая дата следующих действий по заявке\"><span>Срок</span></a>
            </th>

            ";
        // line 156
        list($context["col"], $context["class"], $context["order_desc"]) =         array("rate", "", "");
        // line 157
        echo "            ";
        if (((isset($context["ob"]) ? $context["ob"] : null) == (isset($context["col"]) ? $context["col"] : null))) {
            // line 158
            echo "                ";
            $context["class"] = "ordered";
            // line 159
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
            // line 160
            echo "            ";
        }
        // line 161
        echo "            <th class=\"";
        echo twig_escape_filter($this->env, (isset($context["col"]) ? $context["col"] : null), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, (isset($context["class"]) ? $context["class"] : null), "html", null, true);
        echo " sort\">
                <a href='/helpdesk/?";
        // line 162
        echo twig_escape_filter($this->env, (isset($context["get_for_sorting_links"]) ? $context["get_for_sorting_links"] : null), "html", null, true);
        echo "ob=";
        echo twig_escape_filter($this->env, (isset($context["col"]) ? $context["col"] : null), "html", null, true);
        echo twig_escape_filter($this->env, (isset($context["order_desc"]) ? $context["order_desc"] : null), "html", null, true);
        echo "' title='Оценка'>
                    <img src='/stat/img/helpdesk/rate_";
        // line 163
        echo twig_escape_filter($this->env, _twig_default_filter(strtr((isset($context["class"]) ? $context["class"] : null), array(" " => "_")), "0"), "html", null, true);
        echo "_min.png'>
                </a>
            </th>
        </tr>
    ";
        // line 167
        if ((isset($context["tickets"]) ? $context["tickets"] : null)) {
            // line 168
            echo "        ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["tickets"]) ? $context["tickets"] : null));
            foreach ($context['_seq'] as $context["id"] => $context["ticket"]) {
                // line 169
                echo "
            ";
                // line 170
                list($context["unassigned"], $context["burning"]) =                 array("", "");
                // line 171
                echo "
            ";
                // line 172
                if ((!twig_join_filter($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "performers"), ", "))) {
                    // line 173
                    echo "                ";
                    $context["unassigned"] = "unassigned";
                    // line 174
                    echo "            ";
                }
                // line 175
                echo "            ";
                if (((($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "deadline") > 0) && (twig_date_converter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "deadline")) <= twig_date_converter($this->env, "now"))) && twig_in_filter($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "status"), array(0 => 1, 1 => 2, 2 => 3, 3 => 5, 4 => 7)))) {
                    // line 176
                    echo "                ";
                    $context["burning"] = "burning";
                    // line 177
                    echo "            ";
                }
                // line 178
                echo "
            <tr class='status_";
                // line 179
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
                // line 181
                echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                echo "\" class=\"popup_button noborder\">
                        <img class='icon' src='/stat/img/helpdesk/status_";
                // line 182
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "status"), "html", null, true);
                echo ".png' title='";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["statuses"]) ? $context["statuses"] : null), $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "status"), array(), "array"), "name"), "html", null, true);
                echo "'>
                    </a>
                    <div id=\"popup_ticket-status_";
                // line 184
                echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                echo "\" class=\"popup_menu\">
                        <ul>
                            ";
                // line 186
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["statuses"]) ? $context["statuses"] : null));
                foreach ($context['_seq'] as $context["status_id"] => $context["status"]) {
                    // line 187
                    echo "                                ";
                    if (((isset($context["status_id"]) ? $context["status_id"] : null) == $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "status"))) {
                        // line 188
                        echo "                                    <li class=\"current\">
                                        <img class=\"icon\" src='/stat/img/helpdesk/status_";
                        // line 189
                        echo twig_escape_filter($this->env, (isset($context["status_id"]) ? $context["status_id"] : null), "html", null, true);
                        echo ".png'>&nbsp;";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["status"]) ? $context["status"] : null), "name"), "html", null, true);
                        echo "</li>
                                ";
                    } else {
                        // line 191
                        echo "                                    <li>
                                        <a href=\"javascript: changeTicketStatus('";
                        // line 192
                        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                        echo "','";
                        echo twig_escape_filter($this->env, (isset($context["status_id"]) ? $context["status_id"] : null), "html", null, true);
                        echo "')\">
                                            <img class=\"icon\" src='/stat/img/helpdesk/status_";
                        // line 193
                        echo twig_escape_filter($this->env, (isset($context["status_id"]) ? $context["status_id"] : null), "html", null, true);
                        echo ".png'>&nbsp;";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["status"]) ? $context["status"] : null), "name"), "html", null, true);
                        echo "</a>
                                    </li>
                                ";
                    }
                    // line 196
                    echo "                            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['status_id'], $context['status'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 197
                echo "                        </ul>
                    </div>

                </td>
                <td class='weight'><img class='icon' src='/stat/img/helpdesk/weight_";
                // line 201
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "weight"), "html", null, true);
                echo ".png' title='Вес: ";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "weight"), "html", null, true);
                echo "'></td>
                <td class='title'>
                    <a href='./?stage=edit&id=";
                // line 203
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "id"), "html", null, true);
                echo "'><span class=\"ticket_id\">";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "id"), "html", null, true);
                echo ".</span>";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "title"), "html", null, true);
                echo "</a>
                </td>
                <td>";
                // line 205
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["areas"]) ? $context["areas"] : null), $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "area"), array(), "array"), "html", null, true);
                echo "</td>
                <td class='creator'>
                    <a class=\"ticket_creator\" data-id=\"";
                // line 207
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "creator"), "html", null, true);
                echo "\">
                        ";
                // line 208
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
                // line 212
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
                    // line 213
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
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 215
                echo "                </td>

                ";
                // line 217
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable(array(0 => "created", 1 => "changed", 2 => "deadline"));
                foreach ($context['_seq'] as $context["_key"] => $context["column"]) {
                    // line 218
                    echo "                    ";
                    list($context["y"], $context["m"], $context["d"], $context["y0"], $context["m0"], $context["d0"]) =                     array(twig_date_format_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), (isset($context["column"]) ? $context["column"] : null), array(), "array"), "Y"), twig_date_format_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), (isset($context["column"]) ? $context["column"] : null), array(), "array"), "m"), twig_date_format_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), (isset($context["column"]) ? $context["column"] : null), array(), "array"), "j"), twig_date_format_filter($this->env, "now", "Y"), twig_date_format_filter($this->env, "now", "m"), twig_date_format_filter($this->env, "now", "j"));
                    // line 219
                    echo "                        ";
                    if (($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), (isset($context["column"]) ? $context["column"] : null), array(), "array") > 0)) {
                        // line 220
                        echo "                            ";
                        if (((isset($context["y"]) ? $context["y"] : null) == (isset($context["y0"]) ? $context["y0"] : null))) {
                            // line 221
                            echo "                                ";
                            if (((isset($context["m"]) ? $context["m"] : null) == (isset($context["m0"]) ? $context["m0"] : null))) {
                                // line 222
                                echo "                                    ";
                                if (((isset($context["d"]) ? $context["d"] : null) == (isset($context["d0"]) ? $context["d0"] : null))) {
                                    // line 223
                                    echo "                                        ";
                                    $context["td"] = (((((isset($context["column"]) ? $context["column"] : null) == "created") || ((isset($context["column"]) ? $context["column"] : null) == "changed"))) ? (twig_date_format_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), (isset($context["column"]) ? $context["column"] : null), array(), "array"), "G:i")) : ("сегодня"));
                                    // line 224
                                    echo "                                        ";
                                    $context["title"] = (((((isset($context["column"]) ? $context["column"] : null) == "created") || ((isset($context["column"]) ? $context["column"] : null) == "changed"))) ? (("Сегодня в " . twig_date_format_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), (isset($context["column"]) ? $context["column"] : null), array(), "array"), "G:i"))) : (""));
                                    // line 225
                                    echo "                                    ";
                                } elseif (((isset($context["d"]) ? $context["d"] : null) == ((isset($context["d0"]) ? $context["d0"] : null) - 1))) {
                                    // line 226
                                    echo "                                        ";
                                    $context["td"] = "вчера";
                                    // line 227
                                    echo "                                        ";
                                    $context["title"] = (((((isset($context["column"]) ? $context["column"] : null) == "created") || ((isset($context["column"]) ? $context["column"] : null) == "changed"))) ? (("Вчера в " . twig_date_format_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), (isset($context["column"]) ? $context["column"] : null), array(), "array"), "G:i"))) : (""));
                                    // line 228
                                    echo "                                    ";
                                } elseif (((isset($context["d"]) ? $context["d"] : null) == ((isset($context["d0"]) ? $context["d0"] : null) + 1))) {
                                    // line 229
                                    echo "                                        ";
                                    $context["td"] = "завтра";
                                    // line 230
                                    echo "                                    ";
                                } else {
                                    // line 231
                                    echo "                                        ";
                                    $context["td"] = (((isset($context["d"]) ? $context["d"] : null) . " ") . twig_slice($this->env, $this->getAttribute((isset($context["MONTHS_G"]) ? $context["MONTHS_G"] : null), ((isset($context["m"]) ? $context["m"] : null) - 1), array(), "array"), 0, 3));
                                    // line 232
                                    echo "                                        ";
                                    $context["title"] = (((((isset($context["column"]) ? $context["column"] : null) == "created") || ((isset($context["column"]) ? $context["column"] : null) == "changed"))) ? ((((((isset($context["d"]) ? $context["d"] : null) . " ") . $this->getAttribute((isset($context["MONTHS_G"]) ? $context["MONTHS_G"] : null), ((isset($context["m"]) ? $context["m"] : null) - 1), array(), "array")) . " в ") . twig_date_format_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), (isset($context["column"]) ? $context["column"] : null), array(), "array"), "G:i"))) : (""));
                                    // line 233
                                    echo "                                    ";
                                }
                                // line 234
                                echo "                                ";
                            } else {
                                // line 235
                                echo "                                    ";
                                $context["td"] = (((isset($context["d"]) ? $context["d"] : null) . " ") . twig_slice($this->env, $this->getAttribute((isset($context["MONTHS_G"]) ? $context["MONTHS_G"] : null), ((isset($context["m"]) ? $context["m"] : null) - 1), array(), "array"), 0, 3));
                                // line 236
                                echo "                                    ";
                                $context["title"] = (((((isset($context["column"]) ? $context["column"] : null) == "created") || ((isset($context["column"]) ? $context["column"] : null) == "changed"))) ? ((((((isset($context["d"]) ? $context["d"] : null) . " ") . $this->getAttribute((isset($context["MONTHS_G"]) ? $context["MONTHS_G"] : null), ((isset($context["m"]) ? $context["m"] : null) - 1), array(), "array")) . " в ") . twig_date_format_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), (isset($context["column"]) ? $context["column"] : null), array(), "array"), "G:i"))) : (""));
                                // line 237
                                echo "                                ";
                            }
                            // line 238
                            echo "                            ";
                        } else {
                            // line 239
                            echo "                                ";
                            $context["td"] = (((((isset($context["d"]) ? $context["d"] : null) . ".") . (isset($context["m"]) ? $context["m"] : null)) . ".") . (isset($context["y"]) ? $context["y"] : null));
                            // line 240
                            echo "                                ";
                            $context["title"] = ((((((isset($context["d"]) ? $context["d"] : null) . " ") . $this->getAttribute((isset($context["MONTHS_G"]) ? $context["MONTHS_G"] : null), ((isset($context["m"]) ? $context["m"] : null) - 1), array(), "array")) . (isset($context["y"]) ? $context["y"] : null)) . "г. в ") . twig_date_format_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), (isset($context["column"]) ? $context["column"] : null), array(), "array"), "G:i"));
                            // line 241
                            echo "                            ";
                        }
                        // line 242
                        echo "                        ";
                    } else {
                        // line 243
                        echo "                            ";
                        $context["td"] = "—";
                        // line 244
                        echo "                        ";
                    }
                    // line 245
                    echo "                    <td class=\"c-align ";
                    echo twig_escape_filter($this->env, (isset($context["column"]) ? $context["column"] : null), "html", null, true);
                    echo " ";
                    echo ((((((isset($context["y"]) ? $context["y"] : null) == (isset($context["y0"]) ? $context["y0"] : null)) && ((isset($context["m"]) ? $context["m"] : null) == (isset($context["m0"]) ? $context["m0"] : null))) && ((isset($context["d"]) ? $context["d"] : null) == (isset($context["d0"]) ? $context["d0"] : null)))) ? ("today") : (""));
                    echo "\" title=\"";
                    echo twig_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
                    echo "\" >
                        ";
                    // line 246
                    echo twig_escape_filter($this->env, (isset($context["td"]) ? $context["td"] : null), "html", null, true);
                    echo "
                    </td>
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['column'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 249
                echo "

                ";
                // line 252
                echo "                ";
                // line 253
                echo "                    ";
                // line 254
                echo "                        ";
                // line 255
                echo "                            ";
                // line 256
                echo "                        ";
                // line 257
                echo "                            ";
                // line 258
                echo "                        ";
                // line 259
                echo "                    ";
                // line 260
                echo "                        ";
                // line 261
                echo "                    ";
                // line 262
                echo "                ";
                // line 263
                echo "
                ";
                // line 265
                echo "                    ";
                // line 266
                echo "                        ";
                // line 267
                echo "                            ";
                // line 268
                echo "                        ";
                // line 269
                echo "                            ";
                // line 270
                echo "                        ";
                // line 271
                echo "                    ";
                // line 272
                echo "                        ";
                // line 273
                echo "                    ";
                // line 274
                echo "                ";
                // line 275
                echo "
                <td class=\"c-align rate\">
                    <img src=\"/stat/img/helpdesk/rate_";
                // line 277
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
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 281
            echo "    ";
        } else {
            // line 282
            echo "        <tr>
            <td colspan='11' class='not_found'>Заявок не найдено.</td>
        </tr>
    ";
        }
        // line 286
        echo "
    </table>
    <div class='table-footer'>
        <span class='statusbar'>Заявок: ";
        // line 289
        echo twig_escape_filter($this->env, (isset($context["row_count"]) ? $context["row_count"] : null), "html", null, true);
        echo "</span>
        ";
        // line 290
        if (((isset($context["pages"]) ? $context["pages"] : null) > 1)) {
            // line 291
            echo "            <div class=\"pagenumbers\">
                ";
            // line 292
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable(range(0, ((isset($context["pages"]) ? $context["pages"] : null) - 1)));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 293
                echo "                    ";
                if (((((isset($context["i"]) ? $context["i"] : null) == 1) && ((isset($context["page"]) ? $context["page"] : null) > 3)) || (((isset($context["i"]) ? $context["i"] : null) == ((isset($context["page"]) ? $context["page"] : null) + 3)) && (((isset($context["pages"]) ? $context["pages"] : null) - (isset($context["page"]) ? $context["page"] : null)) > 4)))) {
                    // line 294
                    echo "                        <span class = 'pagespace'>…</span>
                    ";
                } else {
                    // line 296
                    echo "                        ";
                    if (((((isset($context["i"]) ? $context["i"] : null) == 0) || (((isset($context["i"]) ? $context["i"] : null) > ((isset($context["page"]) ? $context["page"] : null) - 3)) && ((isset($context["i"]) ? $context["i"] : null) < ((isset($context["page"]) ? $context["page"] : null) + 4)))) || ((isset($context["i"]) ? $context["i"] : null) == ((isset($context["pages"]) ? $context["pages"] : null) - 1)))) {
                        // line 297
                        echo "                            ";
                        if (((isset($context["page"]) ? $context["page"] : null) == (isset($context["i"]) ? $context["i"] : null))) {
                            // line 298
                            echo "                                <span class=\"page current\">";
                            echo twig_escape_filter($this->env, ((isset($context["i"]) ? $context["i"] : null) + 1), "html", null, true);
                            echo "</span>
                            ";
                        } else {
                            // line 300
                            echo "                                <a class=\"page\" href='/helpdesk?";
                            echo twig_escape_filter($this->env, (isset($context["get_for_pagenumbers"]) ? $context["get_for_pagenumbers"] : null), "html", null, true);
                            echo "page=";
                            echo twig_escape_filter($this->env, (isset($context["i"]) ? $context["i"] : null), "html", null, true);
                            echo "'>";
                            echo twig_escape_filter($this->env, ((isset($context["i"]) ? $context["i"] : null) + 1), "html", null, true);
                            echo "</a>
                            ";
                        }
                        // line 302
                        echo "                        ";
                    }
                    // line 303
                    echo "                    ";
                }
                // line 304
                echo "                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 305
            echo "            </div>
        ";
        }
        // line 307
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
        // line 325
        $this->env->loadTemplate("helpdesk/filters_block.twig")->display($context);
        // line 326
        echo "
        </div>

        <hr>

        ";
        // line 332
        echo "        <div class='params_block contractor cut_block cutted'>
            <span class=\"cutter pic\"></span>
            <span class='category_name cutter'>Ответственный</span>
            <span class=\"count\"></span>
            <div class='cut'>
                ";
        // line 337
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["admins"]) ? $context["admins"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["contractor"]) {
            // line 338
            echo "
                    ";
            // line 339
            $context["c_id"] = $this->getAttribute((isset($context["contractor"]) ? $context["contractor"] : null), "uid");
            // line 340
            echo "                    ";
            $context["c_fio"] = (($this->getAttribute((isset($context["contractor"]) ? $context["contractor"] : null), "lastname") . " ") . $this->getAttribute((isset($context["contractor"]) ? $context["contractor"] : null), "firstname"));
            // line 341
            echo "                    ";
            if (((isset($context["c_id"]) ? $context["c_id"] : null) == (isset($context["admin_id"]) ? $context["admin_id"] : null))) {
                echo "   ";
                list($context["its_me"], $context["c_id"], $context["c_fio"]) =                 array("its_me", 0, "Я");
                // line 342
                echo "                    ";
            } else {
                echo "                ";
                $context["its_me"] = "";
                // line 343
                echo "                    ";
            }
            // line 344
            echo "
                    <div class='param ";
            // line 345
            echo twig_escape_filter($this->env, (isset($context["its_me"]) ? $context["its_me"] : null), "html", null, true);
            echo "'>
                        <label><input class=\"filter_checkbox\" type='checkbox' data-contractor='";
            // line 346
            echo twig_escape_filter($this->env, (isset($context["c_id"]) ? $context["c_id"] : null), "html", null, true);
            echo "'/>";
            echo twig_escape_filter($this->env, (isset($context["c_fio"]) ? $context["c_fio"] : null), "html", null, true);
            echo "</label>
                    </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['contractor'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 349
        echo "            </div>
        </div>

        ";
        // line 353
        echo "        <div class='params_block performers cut_block cutted'>
            <span class=\"cutter pic\"></span>
            <span class='category_name cutter'>Исполнители</span>
            <span class=\"count\"></span>
            <div class='cut'>
                ";
        // line 358
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["admins"]) ? $context["admins"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["performer"]) {
            // line 359
            echo "
                    ";
            // line 360
            $context["p_id"] = $this->getAttribute((isset($context["performer"]) ? $context["performer"] : null), "uid");
            // line 361
            echo "                    ";
            $context["p_fio"] = (($this->getAttribute((isset($context["performer"]) ? $context["performer"] : null), "lastname") . " ") . $this->getAttribute((isset($context["performer"]) ? $context["performer"] : null), "firstname"));
            // line 362
            echo "                    ";
            if (((isset($context["p_id"]) ? $context["p_id"] : null) == (isset($context["admin_id"]) ? $context["admin_id"] : null))) {
                echo "   ";
                list($context["its_me"], $context["p_id"], $context["p_fio"]) =                 array("its_me", 0, "Я");
                // line 363
                echo "                    ";
            } else {
                echo "                ";
                $context["its_me"] = "";
                // line 364
                echo "                    ";
            }
            // line 365
            echo "
                    <div class='param ";
            // line 366
            echo twig_escape_filter($this->env, (isset($context["its_me"]) ? $context["its_me"] : null), "html", null, true);
            echo "'>
                        <label><input class=\"filter_checkbox\" type='checkbox' data-performers=\"@";
            // line 367
            echo twig_escape_filter($this->env, (isset($context["p_id"]) ? $context["p_id"] : null), "html", null, true);
            echo "@\"/>";
            echo twig_escape_filter($this->env, (isset($context["p_fio"]) ? $context["p_fio"] : null), "html", null, true);
            echo "</label>
                    </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['performer'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 370
        echo "            </div>
        </div>

        ";
        // line 374
        echo "        ";
        if ((isset($context["statuses"]) ? $context["statuses"] : null)) {
            // line 375
            echo "            <div class='params_block status cut_block cutted'>
                <span class=\"cutter pic\"></span>
                <span class='category_name cutter'>Статус</span>
                <span class=\"count\"></span>
                <div class='cut'>
                    ";
            // line 380
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["statuses"]) ? $context["statuses"] : null));
            foreach ($context['_seq'] as $context["status_id"] => $context["status"]) {
                // line 381
                echo "                        <div class='param'>
                            <label>
                                <input class=\"filter_checkbox\" type='checkbox' data-status='";
                // line 383
                echo twig_escape_filter($this->env, (isset($context["status_id"]) ? $context["status_id"] : null), "html", null, true);
                echo "'/>
                                ";
                // line 385
                echo "                                ";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["status"]) ? $context["status"] : null), "name"), "html", null, true);
                echo "</label>
                        </div>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['status_id'], $context['status'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 388
            echo "                </div>
            </div>
        ";
        }
        // line 391
        echo "
        ";
        // line 393
        echo "        ";
        if ((isset($context["areas"]) ? $context["areas"] : null)) {
            // line 394
            echo "            <div class='params_block area cut_block cutted'>
                <span class=\"cutter pic\"></span>
                <span class='category_name cutter'>Территория</span>
                <span class=\"count\"></span>
                <div class='cut'>
                    ";
            // line 399
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["areas"]) ? $context["areas"] : null));
            foreach ($context['_seq'] as $context["area_id"] => $context["area"]) {
                // line 400
                echo "                        <div class='param'>
                            <label><input class=\"filter_checkbox\" type='checkbox' data-area='";
                // line 401
                echo twig_escape_filter($this->env, (isset($context["area_id"]) ? $context["area_id"] : null), "html", null, true);
                echo "'/>";
                echo twig_escape_filter($this->env, (isset($context["area"]) ? $context["area"] : null), "html", null, true);
                echo "</label>
                        </div>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['area_id'], $context['area'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 404
            echo "                </div>
            </div>
        ";
        }
        // line 407
        echo "
        ";
        // line 409
        echo "        ";
        // line 410
        echo "            ";
        // line 411
        echo "            ";
        // line 412
        echo "            ";
        // line 413
        echo "            ";
        // line 414
        echo "                ";
        // line 415
        echo "                    ";
        // line 416
        echo "                        ";
        // line 417
        echo "                    ";
        // line 418
        echo "                ";
        // line 419
        echo "            ";
        // line 420
        echo "        ";
        // line 421
        echo "
        ";
        // line 423
        echo "        <div class='params_block rate cut_block cutted'>
            <span class=\"cutter pic\"></span>
            <span class='category_name cutter'>Оценка</span>
            <span class=\"count\"></span>
            <div class='cut'>
                ";
        // line 428
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable(range(5, 1));
        foreach ($context['_seq'] as $context["_key"] => $context["rate"]) {
            // line 429
            echo "                    <div class='param'>
                        <label><input class=\"filter_checkbox\" type='checkbox' data-rate='";
            // line 430
            echo twig_escape_filter($this->env, (isset($context["rate"]) ? $context["rate"] : null), "html", null, true);
            echo "'/>";
            echo twig_escape_filter($this->env, (isset($context["rate"]) ? $context["rate"] : null), "html", null, true);
            echo " балл";
            echo ((((isset($context["rate"]) ? $context["rate"] : null) == 5)) ? ("ов") : (((((isset($context["rate"]) ? $context["rate"] : null) > 1)) ? ("a") : (""))));
            echo "</label>
                    </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['rate'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 433
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
        return array (  1258 => 433,  1245 => 430,  1242 => 429,  1238 => 428,  1231 => 423,  1228 => 421,  1226 => 420,  1224 => 419,  1222 => 418,  1220 => 417,  1218 => 416,  1216 => 415,  1214 => 414,  1212 => 413,  1210 => 412,  1208 => 411,  1206 => 410,  1204 => 409,  1201 => 407,  1196 => 404,  1185 => 401,  1182 => 400,  1178 => 399,  1171 => 394,  1168 => 393,  1165 => 391,  1160 => 388,  1150 => 385,  1146 => 383,  1142 => 381,  1138 => 380,  1131 => 375,  1128 => 374,  1123 => 370,  1112 => 367,  1108 => 366,  1105 => 365,  1102 => 364,  1097 => 363,  1092 => 362,  1089 => 361,  1087 => 360,  1084 => 359,  1080 => 358,  1073 => 353,  1068 => 349,  1057 => 346,  1053 => 345,  1050 => 344,  1047 => 343,  1042 => 342,  1037 => 341,  1034 => 340,  1032 => 339,  1029 => 338,  1025 => 337,  1018 => 332,  1011 => 326,  1009 => 325,  989 => 307,  985 => 305,  979 => 304,  976 => 303,  973 => 302,  963 => 300,  957 => 298,  954 => 297,  951 => 296,  947 => 294,  944 => 293,  940 => 292,  937 => 291,  935 => 290,  931 => 289,  926 => 286,  920 => 282,  917 => 281,  905 => 277,  901 => 275,  899 => 274,  897 => 273,  895 => 272,  893 => 271,  891 => 270,  889 => 269,  887 => 268,  885 => 267,  883 => 266,  881 => 265,  878 => 263,  876 => 262,  874 => 261,  872 => 260,  870 => 259,  868 => 258,  866 => 257,  864 => 256,  862 => 255,  860 => 254,  858 => 253,  856 => 252,  852 => 249,  843 => 246,  834 => 245,  831 => 244,  828 => 243,  825 => 242,  822 => 241,  819 => 240,  816 => 239,  813 => 238,  810 => 237,  807 => 236,  804 => 235,  801 => 234,  798 => 233,  795 => 232,  792 => 231,  789 => 230,  786 => 229,  783 => 228,  780 => 227,  777 => 226,  774 => 225,  771 => 224,  768 => 223,  765 => 222,  762 => 221,  759 => 220,  756 => 219,  753 => 218,  749 => 217,  745 => 215,  722 => 213,  705 => 212,  694 => 208,  690 => 207,  685 => 205,  676 => 203,  669 => 201,  663 => 197,  657 => 196,  649 => 193,  643 => 192,  640 => 191,  633 => 189,  630 => 188,  627 => 187,  623 => 186,  618 => 184,  611 => 182,  607 => 181,  596 => 179,  593 => 178,  590 => 177,  587 => 176,  584 => 175,  581 => 174,  578 => 173,  576 => 172,  573 => 171,  571 => 170,  568 => 169,  563 => 168,  561 => 167,  554 => 163,  547 => 162,  540 => 161,  537 => 160,  526 => 159,  523 => 158,  520 => 157,  518 => 156,  509 => 153,  504 => 152,  501 => 151,  490 => 150,  487 => 149,  484 => 148,  482 => 147,  473 => 144,  466 => 143,  463 => 142,  452 => 141,  449 => 140,  446 => 139,  444 => 138,  435 => 135,  430 => 134,  427 => 133,  416 => 132,  413 => 131,  410 => 130,  408 => 129,  399 => 126,  394 => 125,  391 => 124,  380 => 123,  377 => 122,  374 => 121,  372 => 120,  363 => 117,  356 => 116,  353 => 115,  342 => 114,  339 => 113,  336 => 112,  334 => 111,  325 => 108,  320 => 107,  317 => 106,  314 => 105,  311 => 104,  308 => 103,  305 => 102,  302 => 101,  299 => 100,  296 => 99,  294 => 98,  285 => 95,  280 => 94,  277 => 93,  266 => 92,  263 => 91,  260 => 90,  258 => 89,  251 => 85,  244 => 84,  237 => 83,  234 => 82,  223 => 81,  220 => 80,  217 => 79,  215 => 78,  208 => 74,  201 => 73,  194 => 72,  191 => 71,  180 => 70,  177 => 69,  174 => 68,  172 => 67,  156 => 53,  150 => 49,  147 => 48,  141 => 47,  131 => 45,  125 => 43,  122 => 42,  118 => 41,  113 => 38,  110 => 37,  100 => 32,  95 => 31,  93 => 30,  84 => 23,  81 => 22,  75 => 19,  68 => 16,  66 => 15,  62 => 14,  60 => 12,  58 => 11,  56 => 10,  52 => 9,  48 => 8,  44 => 7,  40 => 6,  36 => 5,  32 => 4,  28 => 3,  26 => 2,);
    }
}
