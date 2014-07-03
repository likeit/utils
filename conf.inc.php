<?php

$CNF = array(
    'db_host'       => 'localhost',                 // Имя сервера MySQL
    'db_user'       => 'utils',                     // Имя пользователя для подключения к серверу MySQL
    'db_pass'       => 'passw0rd',                   // Пароль пользователя для подключения к серверу MySQL
    'db_name'       => 'utils',                     // Имя базы данных на сервере MySQL
    'rows_in_page'  => 20,                          // количество элементов (строк) на странице
    'smtp_srv'      => 'mail.autoexpres.ru',        // адрес smtp-сервера
    'smtp_login'    => 'it-dept@autoexpres.ru',     // логин к smtp
    'smtp_pass'     => 'i5178563',                  // пароль к smtp
    'smtp_from'     => 'it-dept@autoexpres.ru',     // адрес отправителя
    'users_smtp_to' => 'ptrifonova@autoexpres.ru'  // Получатели по-умолчанию (через запятую)
);

$TITLE = array(
	'home'      => 'Главная',
	'bills'     => 'Счета',
	'computers' => 'Компьютеры',
	'users'     => 'Пользователи',
	'supply'    => 'Расходники',
    'helpdesk'  => 'Задачник',
    'helpdesk/reports' => 'Отчёты'
//,
//    'tools'     => 'Каталог'
);

$AREAS_IP = array(
    ''                          => 0,
    '1.1 PRXSRV'                => 3,
    '1.1 PRXSRVD, 1.1 PRXSRV'   => 1,
    '1.1 BASTIONT, 1.1 PRXSRV'  => 4,
    '1.1 PRXSRVM'               => 6
);

$IP = array (
    6 => 0,
    3 => 10,
    1 => 11,
    4 => 12,
    5 => 13,
    2 => ""
);

define (WWW_ROOT,'/usr/home/utils/www');

$MONTHS_G = array(
    "января", "февраля", "марта", "апреля", "мая", "июня",
    "июля", "августа", "сентября", "октября", "ноября", "декабря"
);
