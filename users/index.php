<?php

/*
 * index.php
 * for users
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
    $admin_fio = $admin_login["lastname"]." ".$admin_login["firstname"];
    $admin_id = $admin_login["uid"];
    $users       = getUsers();
    $permissions = getPermissions($admin_login["uid"], $users);
    if ($permissions["bills"] == 'deny') unset($TITLE["bills"]);
    $areas       = getAreas();
    if ($permissions["users"] != 'deny') {

        $status_id = isset($_REQUEST["status_id"]) ? check_string($_REQUEST["status_id"],"digits-list"): "1,2,3,5,6,7"; // id статуса пользователя
        $uid = isset($_REQUEST["uid"]) ? check_string($_REQUEST["uid"],"digits") : null; // id-пользователя
        $lastname = isset($_REQUEST["lastname"]) ? check_string($_REQUEST["lastname"],"text") : null; // Фамилия пользователя
        $firstname = isset($_REQUEST["firstname"]) ? check_string($_REQUEST["firstname"],"text") : null; // Имя пользователя
        $middlename = isset($_REQUEST["middlename"]) ? check_string($_REQUEST["middlename"],"text") : null; // Отчество пользователя
        $birthday = isset($_REQUEST["birthday"]) ? $_REQUEST["birthday"] : null; // Дата рождения
        $login = isset($_REQUEST["login"]) ? check_string($_REQUEST["login"],"string") : null; // Логин пользователя
        $login_ae = isset($_REQUEST["login_ae"]) ? check_string($_REQUEST["login_ae"],"string") : null; // Логин пользователя в AExpres
    /**/$pass = isset($_REQUEST["pass"]) ? $_REQUEST["pass"] : null; // Пароль пользователя
    /**/$email = isset($_REQUEST["email"]) ? $_REQUEST["email"] : null; // E-mail пользователя
        $area_id = isset($_REQUEST["area_id"]) ? check_string($_REQUEST["area_id"],"string") : 0; // id-территории
        $dept_id = isset($_REQUEST["dept_id"]) ? check_string($_REQUEST["dept_id"],"string") : 0; // id-отдела
        $post_id = isset($_REQUEST["post_id"]) ? check_string($_REQUEST["post_id"],"string") : 0; // id-должности
        $skud = isset($_REQUEST["skud"]) ? check_string($_REQUEST["skud"],"digits") : 0; // Номер карты СКУД
        $phone = isset($_REQUEST["phone"]) ? check_string($_REQUEST["phone"],"string") : null; // Внутренний телефон пользователя
        $organization_id = isset($_REQUEST["organization_id"]) ? check_string($_REQUEST["organization_id"],"string") : null; // id юр. лица
        $comment = isset($_REQUEST["comment"]) ? check_string($_REQUEST["comment"],"text") : null; // Комментарий к пользователю
    /**/$find_text = isset($_REQUEST["find_text"]) ? $_REQUEST["find_text"] : null; // Текст для поиска
        $msg_class = isset($_REQUEST["msg_class"]) ? check_string($_REQUEST["msg_class"],"text") : null; // Класс сообщения
        $msg = isset($_REQUEST["msg"]) ? check_string($_REQUEST["msg"],"text") : null; // Сообщения
        $page_num = isset($_REQUEST["page_num"]) ? check_string($_REQUEST["page_num"],"digits") : 0; // Номер страницы
        $flags = checkRequest("flags",""); // Номер страницы
        $rows_in_page = $CNF["rows_in_page"]; // Количество строк на странице
    ///**/$show_del = isset($_SESSION["show_del"]) ? 1 : 0; // Настройка показа уволенных
    /**/$order_by = isset($_SESSION["order_by"]) ? "ORDER BY ".$_SESSION["order_by"] : "ORDER BY `modiff` DESC"; // Настройка сортировки
        $users_smtp_to = isset($_REQUEST["users_smtp_to"]) ? $_REQUEST["users_smtp_to"] : $CNF["users_smtp_to"];
        $user_card_begin = "<!DOCTYPE html><html style='font-family: sans-serif; margin: 5px;'><head><meta charset='UTF-8'>
            <style>a{color:#06c}a:hover{color:#f00}</style></head><body style='background: white; width: 500px'>";

        $users_smtp_sign = "<hr style='border: 1px solid; border-color: #ddd transparent transparent; margin: 10px 0;'>
            <p style='color: #888; margin: 5px;'>С наилучшими пожеланиями,<br>сотрудник IT-отдела<br>$admin_fio<br><br>
            Телефон:   2222<br>E-mail: <a href='mailto:it-dept@autoexpres.ru'>it-dept@autoexpres.ru</a></p>";

        $btn_back           = "<a class='button red' href='javascript: window.history.back()'>«&nbsp;Вернуться</a>";
        $btn_home           = "<a class='button red' href='./'>«&nbsp;Вернуться</a>";
        $btn_new_user       = "<a class='button green' href='./index.php?stage=new'>Добавить</a>";
        $btn_remove_user    = "<a class='button red' href='javascript: if (confirm(&quot;Уволить этого пользователя?&quot;)) document.del_user.submit();'>Уволить</a>";
        $btn_save_user      = "<a class='button green' href='javascript: document.edit_user.submit();'>Сохранить</a>";
        $notifies           = getBurnedCounts($admin_login["uid"]);

        // Кнопочка Показывать/Не показывать уволенных
        //$show_del == 1 ? $btn_show_del = "<a class='button' href='index.php?stage=conf&show_del=0'>Скрывать уволенных</a>" : $btn_show_del = "<a class='button' href='index.php?stage=conf&show_del=1'>Показывать уволенных</a>";
    //    $btn_show_del = ($show_del == 1) ? "<a class='button' href='index.php?stage=conf&show_del=0'>Скрывать уволенных</a>" : "<a class='button' href='index.php?stage=conf&show_del=1'>Показывать уволенных</a>";

        // Фильтр для использования c GET-параметрами:
        $filter = ($area_id != 0) ? "&area_id=$area_id" : "&area_id=0";
        $filter .= ($dept_id != 0) ? "&dept_id=$dept_id" : "&dept_id=0";
        $filter .= ($post_id != 0) ? "&post_id=$post_id" : "&post_id=0";
        $filter .= ($status_id != 0) ? "&status_id=$status_id" : "&status_id=0";

        $area_id = $permissions["area"] ? : $area_id;
        // Фильтр для использования в SQL-запросах:
        $filter_sql = "WHERE 1";
        $filter_sql .= ($area_id   != 0) ? " AND `area_id`=$area_id" : "";
        $filter_sql .= ($dept_id   != 0) ? " AND `dept_id`=$dept_id" : "";
        $filter_sql .= ($post_id   != 0) ? " AND `post_id`=$post_id" : "";
        $filter_sql .= ($status_id != 0) ? " AND `status_id` IN ($status_id)" : "";

        // Заполнение селекторов территорий, отделов и должностей
    //    $query_areas = $db -> query("SELECT `id`,`name` FROM areas WHERE `deleted` is null ORDER BY `name`");
        $query_depts = $db -> query("SELECT `id`,`name`,`posts_list` FROM depts WHERE `deleted` is null ORDER BY `name`");
        $query_posts = $db -> query("SELECT `id`,`name` FROM posts WHERE `deleted` is null ORDER BY `name`");
        $query_statuses = $db -> query("SELECT `id`,`name` FROM users_statuses WHERE `deleted` is null ORDER BY `order`");
        $query_organizations = $db -> query("SELECT `client_id`,`name` FROM organizations WHERE `deleted` is null ORDER BY `name`");
    //    while($areas_res = $db -> fetch_row($query_areas)) $areas[$areas_res[0]] .= $areas_res[1];
        while($depts_res = $db -> fetch_row($query_depts)) {
            $depts[$depts_res[0]] = $depts_res[1];
            $depts_posts_list[$depts_res[0]] = $depts_res[2];
        };
        while($posts_res = $db -> fetch_row($query_posts)) $posts[$posts_res[0]] = $posts_res[1];
        while($statuses_res = $db -> fetch_row($query_statuses)) $statuses[$statuses_res[0]] = $statuses_res[1];
        while($organizations_res = $db -> fetch_row($query_organizations)) $organizations[$organizations_res[0]] .= $organizations_res[1];
        // -- end vars

        if (in_array($stage, ["new", "mod", "preview"])) $hidesearch = true;
        eval(tmplt_gen("../stat/forms/begin.form"));  // Шапка

        // --------- НАЧАЛО ------------------------------------ //
        switch ($stage)
        {
            case "conf": // Персональые настройки

                // - Установка/снятие настройки показа уволенных пользователей
    //            if (isset($_REQUEST["show_del"]))
    //            {
    //                if ($_REQUEST["show_del"] == 1) $_SESSION["show_del"] = 1;
    //                    elseif ($_REQUEST["show_del"] == 0) unset($_SESSION["show_del"]);
    //                        else unset($_SESSION["show_del"]);
    //            };

                // - Сортировка по имени или логину в прямом или обратном порядке
                if (isset($_REQUEST["order_by"]))
                {
                    if (($_REQUEST["order_by"] == "lastname") AND ($_SESSION["order_by"] == "lastname")) $_SESSION["order_by"] = "lastname DESC";
                        elseif (($_REQUEST["order_by"] == "lastname") AND ($_SESSION["order_by"] != "lastname")) $_SESSION["order_by"] = "lastname";
                            elseif (($_REQUEST["order_by"] == "login") AND ($_SESSION["order_by"] == "login")) $_SESSION["order_by"] = "login DESC";
                                elseif (($_REQUEST["order_by"] == "login") AND ($_SESSION["order_by"] != "login")) $_SESSION["order_by"] = "login";
                                    elseif (($_REQUEST["order_by"] == "modiff") AND ($_SESSION["order_by"] == "modiff")) $_SESSION["order_by"] = "modiff DESC";
                                        elseif (($_REQUEST["order_by"] == "modiff") AND ($_SESSION["order_by"] != "modiff")) $_SESSION["order_by"] = "modiff";
                                    else unset($_SESSION["order_by"]);
                };

                header("Location: .");
                break;

            case "new": // Форма добавления нового пользователя
                // Список свободных номеров телефонов
                // --
                eval(tmplt_gen("forms/new.form"));
                break;

            case "add": // Запись нового пользователя в БД
                $birthday = (strlen($birthday) > 0) ? date("Y-m-d", strtotime($birthday)) : 0;
                $query_add = $db -> query("INSERT INTO users (
                                                                `modiff`,
                                                                `modiff_uid`,
                                                                `lastname`,
                                                                `firstname`,
                                                                `middlename`,
                                                                `birthday`,
                                                                `login`,
                                                                `login_ae`,
                                                                `pass`,
                                                                `email`,
                                                                `area_id`,
                                                                `dept_id`,
                                                                `post_id`,
                                                                `skud`,
                                                                `phone`,
                                                                `organization_id`,
                                                                `comment`,
                                                                `status_id`
                                                              ) VALUES (
                                                                          NOW(),
                                                                         '$admin_id',
                                                                         '$lastname',
                                                                         '$firstname',
                                                                         '$middlename',
                                                                         '$birthday',
                                                                         '$login',
                                                                         '$login_ae',
                                                                         '$pass',
                                                                         '$email',
                                                                         '$area_id',
                                                                         '$dept_id',
                                                                         '$post_id',
                                                                         '$skud',
                                                                         '$phone',
                                                                         '$organization_id',
                                                                         '$comment',
                                                                         '$status_id'
                                                                        )");
                $inserted_uid = $db->insert_id();
                if ($query_add) header("Location: index.php?stage=mod&uid=$inserted_uid&msg_class=complete&msg=Готово!");
                    else header("Location: index.php?msg_class=error&msg=Ошибка!");
                break;

            case "mod": // Форма редактирование пользователя
               $users_flags = getUsersFlags();
//               print_r($users_flags);
               $query_mod = $db -> query("SELECT * FROM users WHERE `uid`=$uid");
                if ($query_mod and $mod_data = $db -> fetch_assoc($query_mod))
                {
                    foreach($mod_data as $var=>$val) {
                        $$var = $val;
                    };

                    $sibling_posts_list = explode(",",$depts_posts_list[$dept_id]); //Должности только из своего отдела
                    foreach ($sibling_posts_list as $k) $sibling_posts[$k] = $posts[$k];
                    $user_flags = explode(",", $flags);
//                    print_r($user_flags);

                    eval(tmplt_gen("forms/new.form"));
                } else header("Location: index.php?msg_class=error&msg=Ошибка!");
                break;

            case "upd": // Апдейт данных в БД (редактирование данных)
                $birthday = date("Y-m-d", strtotime($birthday));
                $query_upd = $db -> query("UPDATE users SET
                                                            `modiff`=NOW(),
                                                            `modiff_uid`='$admin_id',
                                                            `lastname`='$lastname',
                                                            `firstname`='$firstname',
                                                            `middlename`='$middlename',
                                                            `birthday`='$birthday',
                                                            `login`='$login',
                                                            `login_ae`='$login_ae',
                                                            `pass`='$pass',
                                                            `email`='$email',
                                                            `area_id`='$area_id',
                                                            `dept_id`='$dept_id',
                                                            `post_id`='$post_id',
                                                            `skud`='$skud',
                                                            `phone`='$phone',
                                                            `organization_id`='$organization_id',
                                                            `comment`='$comment',
                                                            `status_id`='$status_id',
                                                            `flags`='$flags'
                                                                            WHERE `uid`=$uid");
                if ($query_upd) header("Location: index.php?msg_class=complete&msg=Готово!");
                    else header("Location: index.php?msg_class=error&msg=Ошибка!");
                break;

            case "find": // Поиск и вывод пользователей из БД по Фамилии или логину
                if (mb_strlen($find_text, "utf-8") > 2) // Минимальная длина строки для поиска
                {
                    $find_text = strtolower($find_text);
                    $switched_text = switchLayout($find_text);
                    $query_find_cnt = $db -> query("SELECT SQL_NO_CACHE COUNT(*) AS `cnt` FROM users
                                                      WHERE (`lastname` LIKE '%$find_text%') OR (`login` LIKE '%$find_text%') OR (`comment` LIKE '%$find_text%')
                                                      OR (`lastname` LIKE '%$switched_text%') OR (`login` LIKE '%$switched_text%') OR (`comment` LIKE '%$switched_text%')
                                                      OR (`phone`='$find_text')
                                                          ORDER BY `uid`");

                    $find_cnt = $db -> result($query_find_cnt); // Общее количество строк, подходящих под запрос

                    if ($find_cnt > 0) {
                        $pages = ceil($find_cnt/$rows_in_page); // Количество страниц
                        $query_find = "SELECT
                                            `uid`,
                                            `modiff`,
                                            DATE_FORMAT(`modiff`,'%d.%m.%Y %H:%i:%s') as `modiff_fmt`,
                                            (SELECT CONCAT(`lastname`,' ',`firstname`) FROM users WHERE `uid`=u.`modiff_uid`) AS `modiff_uid`,
                                            `status_id`,
                                            `lastname`,
                                            `firstname`,
                                            `middlename`,
                                            `login`,
                                            `pass`,
                                            `area_id`,
                                            `dept_id`,
                                            `post_id`
                                                FROM users u
                                                    WHERE (`lastname` LIKE '%$find_text%')     OR (`login` LIKE '%$find_text%')     OR (`comment` LIKE '%$find_text%')
                                                       OR (`lastname` LIKE '%$switched_text%') OR (`login` LIKE '%$switched_text%') OR (`comment` LIKE '%$switched_text%')
                                                       OR (`phone`='$find_text')
                                                    ORDER BY `uid`";
                        if ($page_num == 0) $query_find .= " LIMIT $rows_in_page";
                            else $query_find .= " LIMIT ".($page_num*$rows_in_page).",".$rows_in_page; // Лимиты

                        eval(tmplt_gen("forms/filter.form")); // Форма фильтра

                        if ($query_find_res = $db -> query($query_find))
                        {
                            while($find_res = $db -> fetch_assoc($query_find_res))
                            {
                                $page .= table_users($find_res);
                            };
                            $page .= "</table>";
                            $page .= "<div class='table-footer'><span class='statusbar'>Найдено пользователей: $find_cnt</span>";
                            $page .= switch_pages($stage,$page_num,$pages,"&find_text=".$find_text); // Переключатель страниц
                            $page .= "</div><div class='buttons'>$btn_home <div class='right'>$btn_show_del $btn_new_user</div></div>";
                        };
//                        echo 1;
                    } else header("Location: index.php?msg_class=error&msg=По вашему запросу ничего не найдено");
                } else header("Location: index.php?msg_class=error&msg=Строка для поиска должна быть более 2-х символов");
                break;

            case "preview": // Просмотр карточки пользователя с возможностью отправки её по почте
                $query_preview = $db -> query("SELECT
                                                      `lastname`,
                                                      `firstname`,
                                                      `middlename`,
                                                      `dept_id`,
                                                      `post_id`,
                                                      `skud`,
                                                      `phone`,
                                                      `login`,
                                                      `login_ae`,
                                                      `email`,
                                                      `pass`
                                                          FROM users WHERE `uid`=$uid");
                if ($query_preview)
                {
                    $preview_res = $db -> fetch_assoc($query_preview);
                    $post = $posts[$preview_res['post_id']];
                    $user_card = preview_user($preview_res); // Сформированная карточка пользователя
                    eval(tmplt_gen("forms/preview.form"));
                } else header("Location: index.php?msg_class=error&msg=Ошибка!");
                break;

           case "Send":
                $query_preview = $db -> query("SELECT
                                                      `lastname`,
                                                      `firstname`,
                                                      `middlename`,
                                                      `dept_id`,
                                                      `post_id`,
                                                      `skud`,
                                                      `phone`,
                                                      `login`,
                                                      `login_ae`,
                                                      `email`,
                                                      `pass`
                                                          FROM users WHERE `uid`='$uid'");
                if ($query_preview)
                {
                    $preview_res = $db -> fetch_assoc($query_preview);
                    $user_card = $user_card_begin.preview_user($preview_res)."\n\n".$users_smtp_sign."</body></html>"; // Сформированная карточка пользователя

                    include "../lib/libmail.php"; // вставляем файл с классом
                    $m= new Mail("utf-8"); // начинаем
                    $m->From($CNF["smtp_from"]); // от кого отправляется почта
                    $users_smtp_to = explode(',', $users_smtp_to); // кому адресованно через запятую
                    foreach($users_smtp_to as $to) {
                        $m->To(trim($to)); // кому адресованно
                    };
                    $m->Subject("Карточка пользователя: ".$preview_res["lastname"]." ".$preview_res["firstname"]." ".$preview_res["middlename"]);
                    $m->Body($user_card, "html");
                    $m->smtp_on($CNF["smtp_srv"],$CNF["smtp_login"],$CNF["smtp_pass"]) ; // отправка через удалённый SMTP-сервер

                  if ($m->Send()) header("Location: index.php?msg_class=complete&msg=Готово!".$filter);
                        else header("Location: index.php?msg_class=error&msg=Ошибка отправки сообщения!");

                } else header("Location: index.php?msg_class=error&msg=Ошибка!");
                break;

            default: // Главная страница
                $query_index_cnt = $db -> query("SELECT SQL_NO_CACHE COUNT(*) AS `cnt` FROM users $filter_sql");
                $index_cnt = $db -> result($query_index_cnt); // Общее количество строк, подходящих под запрос
                $pages = ceil($index_cnt/$rows_in_page); // Количество страниц
                $query_index = "SELECT
                                        u.`uid`,
                                        DATE_FORMAT(`modiff`,'%d.%m.%Y %H:%i') AS `modiff_fmt`,
                                        (SELECT CONCAT(`lastname`,' ',`firstname`) FROM users WHERE `uid`=u.`modiff_uid`) AS `modiff_uid`,
                                        u.`status_id`,
                                        u.`lastname`,
                                        u.`firstname`,
                                        u.`middlename`,
                                        u.`login`,
                                        u.`pass`,
                                        u.`area_id`,
                                        u.`dept_id`,
                                        u.`post_id`
                                            FROM users AS u $filter_sql $order_by";
                if ($page_num == 0) $query_index .= " LIMIT $rows_in_page";
                    else $query_index .= " LIMIT ".($page_num*$rows_in_page).",".$rows_in_page; // Лимиты
                //$page .= "<h3>Пользователи</h3>";
                eval(tmplt_gen("forms/filter.form")); // Форма фильтра
                if ($query_index_res = $db -> query($query_index))
                {
                    if ($index_cnt>0)
                        while($index_res = $db -> fetch_assoc($query_index_res))
                            $page .= table_users($index_res);
                    else
                        $page .= "<tr><td colspan='8' class='not_found'>Не найдено записей</td></tr>";
                    $page .= "</table>";
                    $page .= "<div class='table-footer'><span class='statusbar'>Всего пользователей: $index_cnt</span>";
                    $page .= switch_pages("",$page_num,$pages,$filter); // Переключатель страниц
                    if ($stage == "list") $page .= "</div><div class='buttons'>$btn_home <div class='right'>$btn_show_del $btn_new_user</div></div>";
                        else $page .= "</div><div class='buttons'><div class='right'>$btn_show_del $btn_new_user</div></div>";
                };
        };
        // ---------------------------------------------------- //

        // ВЫВОД
        echo $page; // Тело

        eval(tmplt_gen("../stat/forms/end.form")); // Тапки

        $db_err = $db -> error();
        $db -> close();
    }
} else {
    $_SESSION["ref"] = "users";
    authorize();
};

if ($db_err["error_no"] != null) { print_r($db_err); }; // DB-errors
