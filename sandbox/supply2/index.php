<?php

    ini_set('display_errors',1);
    error_reporting(E_ALL ^E_NOTICE);
    require_once '../vendor/autoload.php'; // Twig инициализация

    $loader = new Twig_Loader_Filesystem('../templates'); // Twig папка с шаблонами
    //$twig = new Twig_Environment($loader, array('cache' => 'cache',));
    $twig = new Twig_Environment($loader, array(
                                                'cache' => '',                // Twig no cache
                                                'trim_blocks' => true
                                ));

    echo $twig->display(basename(__DIR__).'.twig',
                        array(
                            'admin_fio' => 'Калиничев Владимир',
                            'section'  => basename(__DIR__),
                            'sections' => array(
                                                ''       => 'Home',
                                                'bills'  => 'Счета',
                                                'users'  => 'Пользователи',
                                                'supply' => 'Расходники'
                            )
                        )
    );


?>