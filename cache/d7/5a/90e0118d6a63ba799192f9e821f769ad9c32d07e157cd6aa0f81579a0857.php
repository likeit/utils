<?php

/* helpdesk/filters_block.twig */
class __TwigTemplate_d75a90e0118d6a63ba799192f9e821f769ad9c32d07e157cd6aa0f81579a0857 extends Twig_Template
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
        $context = array_intersect_key($context, $_parent) + $_parent;
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
        $context = array_intersect_key($context, $_parent) + $_parent;
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
        return array (  143 => 44,  139 => 43,  136 => 42,  130 => 41,  120 => 39,  117 => 38,  111 => 36,  107 => 34,  105 => 33,  102 => 32,  99 => 31,  87 => 24,  73 => 18,  69 => 17,  50 => 13,  47 => 12,  41 => 10,  37 => 8,  35 => 7,  29 => 5,  25 => 4,  21 => 2,  19 => 1,  1318 => 463,  1307 => 460,  1304 => 459,  1300 => 458,  1293 => 453,  1288 => 449,  1277 => 446,  1274 => 445,  1270 => 444,  1263 => 439,  1257 => 434,  1246 => 431,  1243 => 430,  1239 => 429,  1232 => 424,  1229 => 422,  1227 => 421,  1225 => 420,  1223 => 419,  1221 => 418,  1219 => 417,  1217 => 416,  1215 => 415,  1213 => 414,  1211 => 413,  1209 => 412,  1207 => 411,  1205 => 410,  1202 => 408,  1197 => 405,  1186 => 402,  1183 => 401,  1179 => 400,  1172 => 395,  1169 => 394,  1166 => 392,  1161 => 389,  1151 => 386,  1147 => 384,  1143 => 382,  1139 => 381,  1132 => 376,  1129 => 375,  1124 => 371,  1113 => 368,  1109 => 367,  1106 => 366,  1103 => 365,  1098 => 364,  1093 => 363,  1090 => 362,  1088 => 361,  1085 => 360,  1081 => 359,  1074 => 354,  1069 => 350,  1058 => 347,  1054 => 346,  1051 => 345,  1048 => 344,  1043 => 343,  1038 => 342,  1035 => 341,  1033 => 340,  1030 => 339,  1026 => 338,  1019 => 333,  1012 => 327,  1010 => 326,  990 => 308,  986 => 306,  980 => 305,  977 => 304,  974 => 303,  964 => 301,  958 => 299,  955 => 298,  952 => 297,  948 => 295,  945 => 294,  941 => 293,  938 => 292,  936 => 291,  932 => 290,  927 => 287,  921 => 283,  918 => 282,  906 => 278,  902 => 276,  900 => 275,  898 => 274,  896 => 273,  894 => 272,  892 => 271,  890 => 270,  888 => 269,  886 => 268,  884 => 267,  882 => 266,  879 => 264,  877 => 263,  875 => 262,  873 => 261,  871 => 260,  869 => 259,  867 => 258,  865 => 257,  863 => 256,  861 => 255,  859 => 254,  857 => 253,  853 => 250,  844 => 247,  835 => 246,  832 => 245,  829 => 244,  826 => 243,  823 => 242,  820 => 241,  817 => 240,  814 => 239,  811 => 238,  808 => 237,  805 => 236,  802 => 235,  799 => 234,  796 => 233,  793 => 232,  790 => 231,  787 => 230,  784 => 229,  781 => 228,  778 => 227,  775 => 226,  772 => 225,  769 => 224,  766 => 223,  763 => 222,  760 => 221,  757 => 220,  754 => 219,  750 => 218,  746 => 216,  723 => 214,  706 => 213,  695 => 209,  691 => 208,  686 => 206,  677 => 204,  670 => 202,  664 => 198,  658 => 197,  650 => 194,  644 => 193,  641 => 192,  634 => 190,  631 => 189,  628 => 188,  624 => 187,  619 => 185,  612 => 183,  608 => 182,  597 => 180,  594 => 179,  591 => 178,  588 => 177,  585 => 176,  582 => 175,  579 => 174,  577 => 173,  574 => 172,  572 => 171,  569 => 170,  564 => 169,  562 => 168,  555 => 164,  548 => 163,  541 => 162,  538 => 161,  527 => 160,  524 => 159,  521 => 158,  519 => 157,  510 => 154,  505 => 153,  502 => 152,  491 => 151,  488 => 150,  485 => 149,  483 => 148,  474 => 145,  467 => 144,  464 => 143,  453 => 142,  450 => 141,  447 => 140,  445 => 139,  436 => 136,  431 => 135,  428 => 134,  417 => 133,  414 => 132,  411 => 131,  409 => 130,  400 => 127,  395 => 126,  392 => 125,  381 => 124,  378 => 123,  375 => 122,  373 => 121,  364 => 118,  357 => 117,  354 => 116,  343 => 115,  340 => 114,  337 => 113,  335 => 112,  326 => 109,  321 => 108,  318 => 107,  315 => 106,  312 => 105,  309 => 104,  306 => 103,  303 => 102,  300 => 101,  297 => 100,  295 => 99,  286 => 96,  281 => 95,  278 => 94,  267 => 93,  264 => 92,  261 => 91,  259 => 90,  252 => 86,  245 => 85,  238 => 84,  235 => 83,  224 => 82,  221 => 81,  218 => 80,  216 => 79,  209 => 75,  202 => 74,  195 => 73,  192 => 72,  181 => 71,  178 => 70,  175 => 69,  173 => 68,  157 => 50,  151 => 49,  148 => 49,  142 => 48,  132 => 46,  126 => 44,  123 => 43,  119 => 42,  113 => 38,  110 => 37,  100 => 32,  95 => 30,  93 => 30,  84 => 23,  81 => 23,  75 => 19,  68 => 16,  66 => 16,  62 => 14,  60 => 12,  58 => 11,  56 => 15,  52 => 9,  48 => 8,  44 => 7,  40 => 6,  36 => 5,  32 => 6,  28 => 3,  26 => 2,);
    }
}
