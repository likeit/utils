<?php

/*
 * index.php
 * for supply
 *
 */

ini_set("display_errors",1);
error_reporting(E_ALL ^E_NOTICE);
session_start();
require_once("../subs.php");
require_once("../conf.inc.php");
require_once("../lib/dblayer.php");
$stage = isset($_REQUEST["stage"]) ? check_string($_REQUEST["stage"],"string") : null; // Стадия

if ($admin_login = isAuthorized()) {
    // -- vars -- Установка, проверка переменных и введённых данных

    if (isset($_REQUEST["area"])){
        $area = check_string($_REQUEST["area"], 'digits');
    } else {
        $proxy = rtrim($_SERVER['HTTP_VIA']);
        $area = $AREAS_IP[$proxy];
    };

//    print_r($_SERVER);
    $users       = getUsers();
    $permissions = getPermissions($admin_login["uid"], $users);
    if ($permissions["bills"] == 'deny') unset($TITLE["bills"]);
    if ($permissions["users"] == 'deny') unset($TITLE["users"]);
    $area = ($permissions["area"]) ? : $area ;

    $areas = getAreas();
    $areas[0] = "Все";
    ksort($areas);


    $btn_back           = "<a class='button red' href='javascript: window.history.back()'>«&nbsp;Вернуться</a>";
    $btn_home           = "<a class='button red' href='./'>«&nbsp;Вернуться</a>";
    $btn_new_supply     = "<a class='button green' href='./index.php?stage=new'>Добавить</a>";
    $btn_remove_supply  = "<a class='button red' href='javascript: if (confirm(\"Удалить этот картридж?\")) document.del_supply.submit();'>Удалить</a>";
    $btn_save_supply    = "<a class='button green' href='javascript: document.edit_supply.submit();'>Сохранить</a>";

    $admin_fio = $admin_login["lastname"]." ".$admin_login["firstname"];
    $admin_id  = $admin_login["uid"];
    $rows_in_page   = $CNF["rows_in_page"]; // Количество строк на странице
    $id             = isset($_REQUEST["id"])                ? check_string($_REQUEST["id"],         "digits")   : null; // id-картриджа
    $model          = isset($_REQUEST["model"])             ? check_string($_REQUEST["model"],      "digits")   : 0; // Модель картриджи
    $full           = isset($_REQUEST["full"])              ? check_string($_REQUEST["full"],       "digits")   : null; // Кол-во полных картриджей
    $use            = isset($_REQUEST["use"])               ? check_string($_REQUEST["use"],        "digits")   : null; // Кол-во картриджей в работе
    $comment        = isset($_REQUEST["comment"])           ? check_string($_REQUEST["comment"],    "text")     : null; // Комментарий к картриджам
    $find_text      = isset($_REQUEST["find_text"])         ? check_string($_REQUEST["find_text"],  "text")     : null; // Текст для поиска
    $msg_class      = isset($_REQUEST["msg_class"])         ? check_string($_REQUEST["msg_class"],  "text")     : null; // Класс сообщения
    $msg            = isset($_REQUEST["msg"])               ? check_string($_REQUEST["msg"],        "text")     : null; // Сообщения
    $page_num       = isset($_REQUEST["page_num"])          ? check_string($_REQUEST["page_num"],   "digits")   : 0;    // Номер страницы
    $notifies     = getBurnedCounts($admin_login["uid"]);
//    $order_by       = isset($_SESSION["order_by"])          ? "ORDER BY ".$_SESSION["order_by"]                 : "ORDER BY `id`";// Настройка сортировки

    // Фильтр для использования в SQL-запросах:
    $filter_sql = " WHERE `deleted` != 1 ";
    $filter_sql .= ($area != 0) ? " AND `area`=$area" : "";
    $filter_sql .= ($model != 0) ? " AND `model`=$model" : "";

    // Фильтр для использования c GET-параметрами:
    $filter  = ($area != 0) ? "&area=$area" : "&area=0";
    $filter .= ($model != 0) ? "&model=$model" : "&model=0";

    // Заполнение селекторов территорий, отделов и должностей
    $query_models = $db -> query("SELECT `id`, `name`, `cartridge4u_id`,
                                    (select count(*) from supply where `model` = supply_models.`id` and `use` > 0) as `count`
                                      FROM supply_models
                                              WHERE `deleted` is null ORDER BY `name`");
    while($models_res = $db -> fetch_row($query_models)) {
        $models[$models_res[0]] = $models_res[1];
        $cartridge4u_id[$models_res[0]] = $models_res[2];
        $count[$models_res[0]] = $models_res[3];
    }
    $models[0] = "Все";
    ksort($models);

    // -- end vars

    eval(tmplt_gen("../stat/forms/begin.form"));  // Шапка

    // --------- НАЧАЛО ------------------------------------ //
    switch ($stage)
    {
        case "new": // Форма добавления нового картриджа
            eval(tmplt_gen("forms/new.form"));
            break;

        case "add": // Запись нового картриджа в БД
            $query_add = $db -> query("INSERT INTO supply (
                                              `model`,
                                              `use`,
                                              `full`,
                                              `area`,
                                              `comment`
                                                          ) VALUES (
                                                                     '$model',
                                                                     '$use',
                                                                     '$full',
                                                                     '$area',
                                                                     '$comment'
                                                                    )");
            if ($query_add) header("Location: index.php?msg_class=complete&msg=Картридж $models[model] успешно добавлен на территорию $areas[$area]!");
                else header("Location: index.php?msg_class=error&msg=Ошибка!");
            break;

        case "mod": // Форма редактирование картриджа
            $query_mod = $db -> query("SELECT
                                              `model`,
                                              `use`,
                                              `full`,
                                              `area`,
                                              `comment`
                                                  FROM supply
                                                      WHERE `id`=$id");
            if ($query_mod and $mod_data = $db -> fetch_assoc($query_mod))
            {
                foreach($mod_data as $var=>$val)
                {
                    $$var = $val;
                };
                eval(tmplt_gen("forms/new.form"));
            } else header("Location: index.php?msg_class=error&msg=Ошибка!");

            break;

        case "upd": // Апдейт данных в БД (редактирование данных)
            $query_upd = $db -> query("UPDATE supply SET
                                                        `model`='$model',
                                                        `use`='$use',
                                                        `full`='$full',
                                                        `area`='$area',
                                                        `comment`='$comment'
                                                                        WHERE `id`=$id");
            if ($query_upd) header("Location: index.php?msg_class=complete&msg=Картридж $models[$model] успешно изменен");
                else header("Location: index.php?msg_class=Ошибка! Проверьте правильность введенных данных.");
            break;

        case "del": // Удаление картриджа из БД
            $query_del = $db -> query("UPDATE supply SET `deleted`=1 WHERE `id`=$id");
            if ($query_del) header("Location: index.php?msg_class=complete&msg=Готово!.$filter");
                else header("Location: index.php?msg_class=error&msg=Ошибка!");
            break;

        default: // Главная страница
            $query_index_cnt = $db -> query("SELECT SQL_NO_CACHE COUNT(*) AS `cnt` FROM supply $filter_sql");
            $index_cnt = $db -> result($query_index_cnt); // Общее количество строк, подходящих под запрос
            $pages = ceil($index_cnt/$rows_in_page); // Количество страниц
            $query_index = "SELECT
                                    `id`,
                                    `model`,
                                    `area`,
                                    `use`,
                                    `full`,
                                    `comment`
                                        FROM supply $filter_sql $order_by";

            if ($page_num == 0) $query_index .= " LIMIT $rows_in_page";
                else $query_index .= " LIMIT ".($page_num*$rows_in_page).",".$rows_in_page; // Лимиты

//            $query_index_cnt = $db -> query("SELECT SQL_NO_CACHE COUNT(*) AS `cnt` FROM supply $filter_sql");
//            $index_cnt = $db -> result($query_index_cnt); // Общее количество строк, подходящих под запрос
            eval(tmplt_gen("forms/filter.form")); // Форма фильтра
            if ($query_index_res = $db -> query($query_index))
            {
                if ($index_cnt > 0)
                    while($index_res = $db -> fetch_assoc($query_index_res))
                        $page .= table_supply($index_res);
                else
                  $page .= "<tr><td colspan='6' class='not_found'>Не найдено записей</td></tr>";

                    $page .= "</table>";
                    $page .= "<div class='table-footer'><span class='statusbar'>Всего картриджей: $index_cnt</span>";
                    $page .= switch_pages("",$page_num,$pages,$filter); // Переключатель страниц

                if ($stage == "list") $page .= "</div><div class='buttons'>$btn_home<div class='right'>$btn_new_supply</div></div>";
                    else $page .= "</div><div class='buttons'><div class='right'>$btn_new_supply</div></div>";
            };
    };
    // ---------------------------------------------------- //

    // ВЫВОД
    echo $page; // Тело

    eval(tmplt_gen("../stat/forms/end.form")); // Тапки
    $db_err = $db -> error();
} else {
    $_SESSION["ref"] = "supply";
    authorize();
};

if ($db_err["error_no"] != null) { print_r($db_err); }; // DB-errors