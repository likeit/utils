<?php
    ini_set('display_errors',1);
    error_reporting(E_ALL ^E_NOTICE);

    require('conf.inc.php');
    require('subs.php');

    $page_title = 'Ошибка 404';
    eval(tmplt_gen("stat/forms/begin.form"));

    $page .= "К сожалению, запрашиваемая Вами страница не найдена.<br>
        <a href='javascript: window.history.back()'>Назад</a>";

    echo $page;
    eval(tmplt_gen("stat/forms/end.form"));