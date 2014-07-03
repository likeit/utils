<?php

/* helpdesk/user_email.twig */
class __TwigTemplate_af95186fd9ec62f4ad47a0e887fbda2fd9967c3d48dd28984f67cbc7678a5822 extends Twig_Template
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
        echo "
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv=\"Content-type\" content=\"text/html; \">
    <style type=\"text/css\">
        a {color: #08f}
        a:hover {color: #f88; opacity: 1}
        a:active {color: #f88; opacity: 1}
        body { font-family: Arial, sans-serif; font-size: 13px; }
        img { border: 0 }
        #rating { position: relative; padding: 22px 15px 4px; display: inline; top: 2px;}
        #rating a { padding: 0 2px; text-decoration: none; }
        #rating:hover,
        #rating:active {background: #f4f4f4 }
        #s1 {opacity: 0.5; cursor: pointer}
        #s1:hover,
        #s1:active {opacity: 1}
        #s1:hover #s2:not(:hover) a,
        #s2:hover #s3:not(:hover) a,
        #s3:hover #s4:not(:hover) a,
        #s4:hover #s5:not(:hover) a,
        #rating:not(:hover) #s1:active #s2:not(:active) a,
        #rating:not(:hover) #s2:active #s3:not(:active) a,
        #rating:not(:hover) #s3:active #s4:not(:active) a,
        #rating:not(:hover) #s4:active #s5:not(:active) a { opacity: 0.5 }

        .title {display: none}
        #rating:not(:hover) a:active .title,
        a:hover .title {
            display: inline;
            position: absolute;
            top: 4px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 12px;
            color: #333333;
        }

    </style>
    <title>
    </title>
</head>

<body>
    ";
        // line 49
        if (((isset($context["action"]) ? $context["action"] : null) == "your_ticket_created")) {
            // line 50
            echo "        ";
            $context["url"] = ("client?u=" . (isset($context["login"]) ? $context["login"] : null));
            // line 51
            echo "    <h3>
        <a href=\"http://utils.avto-sale.local/helpdesk/client?u=";
            // line 52
            echo twig_escape_filter($this->env, (isset($context["login"]) ? $context["login"] : null), "html", null, true);
            echo "&ticket=";
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo "\">#";
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo ". ";
            echo twig_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
            echo ".</a>
    </h3>
        <p>
            Заявка успешно создана. В ближайшее время будет назначен исполнитель.
            О ходе работ по заявке вы будете проинформированы.
        </p>
        <p>
            Информацию о всех своих заявках, вы можете посмотреть в
           <a href=\"http://utils.avto-sale.local/helpdesk/client?u=";
            // line 60
            echo twig_escape_filter($this->env, (isset($context["login"]) ? $context["login"] : null), "html", null, true);
            echo "&list\">Задачнике ИТ</a>
        </p>
    ";
        } elseif (((isset($context["action"]) ? $context["action"] : null) == "somebody_change_user_ticket_status")) {
            // line 63
            echo "        ";
            $context["url"] = ("client?u=" . (isset($context["creator_login"]) ? $context["creator_login"] : null));
            // line 64
            echo "        <h3>
            <a href=\"http://utils.avto-sale.local/helpdesk/client?u=";
            // line 65
            echo twig_escape_filter($this->env, (isset($context["creator_login"]) ? $context["creator_login"] : null), "html", null, true);
            echo "&ticket=";
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo "\">#";
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo ". ";
            echo twig_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
            echo ".</a>
        </h3>
        <p>
            Пользователь <b>";
            // line 68
            echo twig_escape_filter($this->env, (isset($context["changer"]) ? $context["changer"] : null), "html", null, true);
            echo "</b> ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["STATUSES_ACTIONS"]) ? $context["STATUSES_ACTIONS"] : null), (isset($context["status"]) ? $context["status"] : null), array(), "array"), "html", null, true);
            echo " вашу заявку
            <a href=\"http://utils.avto-sale.local/helpdesk/client?u=";
            // line 69
            echo twig_escape_filter($this->env, (isset($context["creator_login"]) ? $context["creator_login"] : null), "html", null, true);
            echo "&ticket=";
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo "\">#";
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo "</a><!--
         -->";
            // line 70
            if ((!twig_test_empty((isset($context["comment"]) ? $context["comment"] : null)))) {
                // line 71
                echo "                    с комментарием:
                </p>
                <p style=\"font-style: italic\">
                    ";
                // line 74
                echo nl2br(twig_escape_filter($this->env, (isset($context["comment"]) ? $context["comment"] : null), "html", null, true));
                echo "
            ";
            } else {
                // line 75
                echo ".<!--
         -->";
            }
            // line 77
            echo "
        </p>

        ";
            // line 80
            if (twig_in_filter((isset($context["status"]) ? $context["status"] : null), array(0 => 4, 1 => 6))) {
                // line 81
                echo "            Пожалуйста, оцените качество выполнения работ по заявке:
            <div id='rating'>
                <span id='s1'>
                    <a href=\"http://utils.avto-sale.local/helpdesk/client?u=";
                // line 84
                echo twig_escape_filter($this->env, (isset($context["creator_login"]) ? $context["creator_login"] : null), "html", null, true);
                echo "&ticket=";
                echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                echo "&r=1\">
                        <img src='cid:rate_3_min.png'/>
                        <span class='title'> Очень плохо! </span>
                    </a>
                    <span id='s2'>
                        <a href=\"http://utils.avto-sale.local/helpdesk/client?u=";
                // line 89
                echo twig_escape_filter($this->env, (isset($context["creator_login"]) ? $context["creator_login"] : null), "html", null, true);
                echo "&ticket=";
                echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                echo "&r=2\">
                            <img src='cid:rate_3_min.png'/>
                            <span class='title'> Плохо </span>
                        </a>
                        <span id='s3'>
                            <a href=\"http://utils.avto-sale.local/helpdesk/client?u=";
                // line 94
                echo twig_escape_filter($this->env, (isset($context["creator_login"]) ? $context["creator_login"] : null), "html", null, true);
                echo "&ticket=";
                echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                echo "&r=3\">
                                <img src='cid:rate_3_min.png'/>
                                <span class='title'> Удовлетворительно </span>
                            </a>
                            <span id='s4'>
                                <a href=\"http://utils.avto-sale.local/helpdesk/client?u=";
                // line 99
                echo twig_escape_filter($this->env, (isset($context["creator_login"]) ? $context["creator_login"] : null), "html", null, true);
                echo "&ticket=";
                echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                echo "&r=4\">
                                    <img src='cid:rate_3_min.png'/>
                                    <span class='title'> Хорошо </span>
                                </a>
                                <span id='s5'>
                                    <a href=\"http://utils.avto-sale.local/helpdesk/client?u=";
                // line 104
                echo twig_escape_filter($this->env, (isset($context["creator_login"]) ? $context["creator_login"] : null), "html", null, true);
                echo "&ticket=";
                echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                echo "&r=5\">
                                        <img src='cid:rate_3_min.png'/>
                                        <span class='title'> Отлично! </span>
                                    </a>
                                </span>
                            </span>
                        </span>
                    </span>
                </span>
            </div>
            <br>
        ";
            }
            // line 116
            echo "    ";
        } elseif (((isset($context["action"]) ? $context["action"] : null) == "somebody_change_admin_ticket_status")) {
            // line 117
            echo "        ";
            $context["url"] = "";
            // line 118
            echo "        <h3>
            <a href=\"http://utils.avto-sale.local/helpdesk/?stage=edit&id=";
            // line 119
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo "\">#";
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo ". ";
            echo twig_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
            echo ".</a>
        </h3>
        <p>
            <b>";
            // line 122
            echo twig_escape_filter($this->env, (isset($context["changer"]) ? $context["changer"] : null), "html", null, true);
            echo "</b> ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["STATUSES_ACTIONS"]) ? $context["STATUSES_ACTIONS"] : null), (isset($context["status"]) ? $context["status"] : null), array(), "array"), "html", null, true);
            echo " вашу заявку
            <a href=\"http://utils.avto-sale.local/helpdesk/?stage=edit&id=";
            // line 123
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo "\">#";
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo "</a><!--
         -->";
            // line 124
            if ((!twig_test_empty((isset($context["comment"]) ? $context["comment"] : null)))) {
                // line 125
                echo "                    с комментарием:
                </p>
                <p style=\"font-style: italic; font-family: serif\">
                    \"";
                // line 128
                echo twig_escape_filter($this->env, (isset($context["comment"]) ? $context["comment"] : null), "html", null, true);
                echo "\"
            ";
            } else {
                // line 129
                echo ".<!--
         -->";
            }
            // line 131
            echo "
        </p>
        ";
            // line 133
            if (twig_in_filter((isset($context["status"]) ? $context["status"] : null), array(0 => 4, 1 => 6))) {
                // line 134
                echo "            Пожалуйста, оцените качество выполнения работ по заявке:
            <div id='rating'>
                <span id='s1'>
                    <a href=\"http://utils.avto-sale.local/helpdesk/client?u=";
                // line 137
                echo twig_escape_filter($this->env, (isset($context["creator_login"]) ? $context["creator_login"] : null), "html", null, true);
                echo "&ticket=";
                echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                echo "&r=1\">
                        <img src='cid:rate_3_min.png'/>
                        <span class='title'> Очень плохо! </span>
                    </a>
                    <span id='s2'>
                        <a href=\"http://utils.avto-sale.local/helpdesk/client?u=";
                // line 142
                echo twig_escape_filter($this->env, (isset($context["creator_login"]) ? $context["creator_login"] : null), "html", null, true);
                echo "&ticket=";
                echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                echo "&r=2\">
                            <img src='cid:rate_3_min.png'/>
                            <span class='title'> Плохо </span>
                        </a>
                        <span id='s3'>
                            <a href=\"http://utils.avto-sale.local/helpdesk/client?u=";
                // line 147
                echo twig_escape_filter($this->env, (isset($context["creator_login"]) ? $context["creator_login"] : null), "html", null, true);
                echo "&ticket=";
                echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                echo "&r=3\">
                                <img src='cid:rate_3_min.png'/>
                                <span class='title'> Удовлетворительно </span>
                            </a>
                            <span id='s4'>
                                <a href=\"http://utils.avto-sale.local/helpdesk/client?u=";
                // line 152
                echo twig_escape_filter($this->env, (isset($context["creator_login"]) ? $context["creator_login"] : null), "html", null, true);
                echo "&ticket=";
                echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                echo "&r=4\">
                                    <img src='cid:rate_3_min.png'/>
                                    <span class='title'> Хорошо </span>
                                </a>
                                <span id='s5'>
                                    <a href=\"http://utils.avto-sale.local/helpdesk/client?u=";
                // line 157
                echo twig_escape_filter($this->env, (isset($context["creator_login"]) ? $context["creator_login"] : null), "html", null, true);
                echo "&ticket=";
                echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                echo "&r=5\">
                                        <img src='cid:rate_3_min.png'/>
                                        <span class='title'> Отлично! </span>
                                    </a>
                                </span>
                            </span>
                        </span>
                    </span>
                </span>
            </div>
            <br>
        ";
            }
            // line 169
            echo "
    ";
        } elseif (((isset($context["action"]) ? $context["action"] : null) == "you_are_performer")) {
            // line 171
            echo "        ";
            $context["url"] = "";
            // line 172
            echo "        <h3>
            <a href=\"http://utils.avto-sale.local/helpdesk?stage=edit&id=";
            // line 173
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo "\">#";
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo ". ";
            echo twig_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
            echo ".</a>
        </h3>
        <p>
            ";
            // line 176
            echo twig_escape_filter($this->env, (isset($context["changer"]) ? $context["changer"] : null), "html", null, true);
            echo " назначил вас исполнителем заявки \"";
            echo twig_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
            echo "\".
            <a href=\"http://utils.avto-sale.local/helpdesk?stage=edit&id=";
            // line 177
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo "\">Подробнее...</a>
        </p>
    ";
        } elseif (((isset($context["action"]) ? $context["action"] : null) == "user_add_comment")) {
            // line 180
            echo "        ";
            $context["url"] = "";
            // line 181
            echo "        <h3>
            <a href=\"http://utils.avto-sale.local/helpdesk/?stage=edit&id=";
            // line 182
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo "\">#";
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo ". ";
            echo twig_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
            echo ".</a>
        </h3>
        <p>
        Пользователь оставил комментарий к вашей заявке:
        </p>
        <p style=\"font-style: italic; font-family: serif\">
            \"";
            // line 188
            echo twig_escape_filter($this->env, (isset($context["comment"]) ? $context["comment"] : null), "html", null, true);
            echo "\"
        </p>
    ";
        }
        // line 191
        echo "
    <br>
    <hr>

    <p style=\"font-size:0.8em; color:Gray;\">
        Это сообщение отправлено автоматически из
        <a href=\"http://utils.avto-sale.local/helpdesk/";
        // line 197
        echo twig_escape_filter($this->env, (isset($context["url"]) ? $context["url"] : null), "html", null, true);
        echo "\">Задачника</a>,
        пожалуйста не отвечайте на него.
    </p>
</body>

</html>
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "helpdesk/user_email.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  398 => 197,  390 => 191,  384 => 188,  371 => 182,  368 => 181,  365 => 180,  359 => 177,  353 => 176,  343 => 173,  340 => 172,  337 => 171,  333 => 169,  316 => 157,  306 => 152,  296 => 147,  286 => 142,  276 => 137,  271 => 134,  269 => 133,  265 => 131,  261 => 129,  256 => 128,  251 => 125,  249 => 124,  243 => 123,  237 => 122,  227 => 119,  224 => 118,  221 => 117,  218 => 116,  201 => 104,  191 => 99,  181 => 94,  171 => 89,  161 => 84,  156 => 81,  154 => 80,  149 => 77,  145 => 75,  140 => 74,  135 => 71,  133 => 70,  125 => 69,  119 => 68,  107 => 65,  104 => 64,  101 => 63,  95 => 60,  78 => 52,  75 => 51,  72 => 50,  70 => 49,  21 => 2,  19 => 1,);
    }
}
