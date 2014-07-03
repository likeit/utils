<?php

/*
 * index.php
 * general page
 *
 */

ini_set('display_errors',1);
error_reporting(E_ALL ^E_NOTICE);
session_start();

require('subs.php');
require('conf.inc.php');
require("lib/dblayer.php");
require_once 'vendor/autoload.php'; // Twig инициализация

$loader = new Twig_Loader_Filesystem('templates'); // Twig папка с шаблонами
$twig = new Twig_Environment($loader, array('cache' => '',)); // Twig no cache
$stage = isset($_REQUEST['stage']) ? check_string($_REQUEST['stage'],'string') : null; // Стадия

if (isset($_SESSION['valid']) and ($_SESSION['valid'] == true))
{
    // -- vars -- Установка, проверка переменных и введённых данных
    $admin_fio = $_SESSION['admin_fio'];
    // -- end vars

    // --------- НАЧАЛО ------------------------------------ //
    echo $twig->render(
        'base.html', array(
            'dir' => basename(__DIR__),
            'title' => 'Главная страница',
            'admin_fio' => $admin_fio,
            'section'  => basename(__DIR__) == 'www' ? '' : basename(__DIR__),
            'sections' => array(
                ''       => 'Главная',
                'bills'  => 'Счета',
                'users'  => 'Пользователи',
                'supply' => 'Расходники'
            )
        )
    );
    // --------- КОНЕЦ ------------------------------------- //

} else header('Location: http://'.$_SERVER['HTTP_HOST'].'/auth.php');

?>