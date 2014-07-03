<?php

/*
 * index.php
 * for bills
 *
 */

ini_set('display_errors',1);
error_reporting(E_ALL ^E_NOTICE);
require('../subs.php');
require('../conf.inc.php');
require("../lib/dblayer.php");
$stage = isset($_REQUEST['stage']) ? check_string($_REQUEST['stage'],'string') : null; // Стадия

if ($admin_login = isAuthorized()) {
    $users = getUsers();
    $permissions = getPermissions($admin_login["uid"], $users);
    if ($permissions["users"] == 'deny') unset($TITLE["users"]);
    if ($permissions["bills"] != "deny") {
            // -- vars -- Установка, проверка переменных и введённых данных
        $page = '';

        $btn_back        = "<a class='button red' href='javascript: window.history.back()'>«&nbsp;Вернуться</a>";
        $btn_home        = "<a class='button red' href='./'>«&nbsp;Вернуться</a>";
        $btn_new_bill    = "<a class='button green' href='index.php?stage=new'>Добавить</a>";
        $btn_remove_bill = "<a class='button red' href='javascript: if (confirm(&quot;Удалить этот счёт?&quot;)) document.del_bill.submit();'>Удалить</a>";
        $btn_save_bill   = "<a class='button green' href='javascript: document.edit_bill.submit();'>Сохранить</a>";

        $admin_fio = $admin_login["lastname"]." ".$admin_login["firstname"];
        $admin_id = $admin_login["uid"];
        $id = isset($_REQUEST['id']) ? check_string($_REQUEST['id'],'digits') : null; // id-записи
        $number = isset($_REQUEST['number']) ? check_string($_REQUEST['number'],'text') : null; // Номер счета
        $date = isset($_REQUEST['date']) ? $_REQUEST['date'] : null; // Дата счета
        $seller_id = isset($_REQUEST['seller_id']) ? check_string($_REQUEST['seller_id'],'string') : null; // id-продавца
        $client_id = isset($_REQUEST['client_id']) ? check_string($_REQUEST['client_id'],'string') : null; // id-покупателя
        $content = isset($_POST['content']) ? check_string($_POST['content'],'text') : null; // Содержимое счета
        $comment = isset($_POST['comment']) ? check_string($_POST['comment'],'text') : null; // Комментарий к счету
        $summ = isset($_POST['summ']) ? $_POST['summ'] : null; // Сумма счета
        $filename = (isset($_FILES['filename']['name']) and $_FILES['filename']['name'] != '') ? $_FILES['filename']['name'] : null; // Имя загружаемого файла
        $msg = isset($_REQUEST['msg']) ? check_string($_REQUEST['msg'],'text') : null; // Сообщения
        $msg_class = isset($_REQUEST['msg_class']) ? check_string($_REQUEST['msg_class'],'text') : null; // Сообщения
        $find_text = isset($_REQUEST['find_text']) ? check_string($_REQUEST['find_text'],'text') : null; // Текст для поиска
        $notifies  = getBurnedCounts($admin_login["uid"]);

        // Фильтр для использования в SQL-запросах:
        $filter_sql = ($seller_id > 0) ? ' AND seller_id='.$seller_id : '';
        $filter_sql .= ($client_id > 0) ? ' AND client_id='.$client_id : '';
        ($filter_sql == "") ? $btn_home = "" : null;

        // Фильтр для использования c GET-параметрами:
        $filter = ($seller_id > 0) ? '&seller_id='.$seller_id : '&seller_id=0';
        $filter .= ($client_id > 0) ? '&client_id='.$client_id : '&client_id=0';

        $page_num = isset($_REQUEST['page_num']) ? check_string($_REQUEST['page_num'],'digits') : 0; // Номер страницы
        $rows_in_page = $CNF['rows_in_page']; // Количество строк на странице

        // Заполнение селектов продавцов и покупателей:
        $query_sellers = $db -> query("SELECT
                            seller_id,
                            name,
                            details
                                FROM sellers WHERE deleted is null ORDER BY name");
        $query_clients = $db -> query("SELECT
                            client_id,
                            name
                                FROM organizations WHERE deleted is null ORDER BY name");
        while($sellers_res = $db -> fetch_row($query_sellers))
        {
            $sellers[$sellers_res[0]] .= $sellers_res[1];
        };
        while($clients_res = $db -> fetch_row($query_clients))
        {
            $clients[$clients_res[0]] .= $clients_res[1];
        };
        // -- end vars

        eval(tmplt_gen('../stat/forms/begin.form'));  // Шапка

        // --------- НАЧАЛО ------------------------------------ //
        switch ($stage)
        {
            case 'new': // Форма добавления нового счёта
                eval(tmplt_gen('forms/new.form'));
                break;
            case 'add': // Запись нового счёта в БД
                $summ = str_replace(" ", "", str_replace(",", ".", $summ));
                if ($filename)
                    {
                        preg_match('/\S+\.(\S+)$/', $filename, $file_ext); // Расширение загружаемого документа
                        $filename = date('YmdHms').'.'.strtolower($file_ext[1]); // Имя файла в виде ГГГГММДДччммсс.***, где *** - расширение загружаемого документа};
                    };
                $date = date("Y-m-d", strtotime($date));
                $query_add = $db -> query("INSERT INTO
                                bills(
                                        datetime_add,
                                        number,
                                        date,
                                        seller_id,
                                        client_id,
                                        content,
                                        comment,
                                        summ,
                                        filename,
                                        user_id
                                    ) VALUES
                                        (
                                            NOW(),
                                            '$number',
                                            '$date',
                                            '$seller_id',
                                            '$client_id',
                                            '$content',
                                            '$comment',
                                            '$summ',
                                            '$filename',
                                            '$admin_id'
                                        )");
                if ($query_add)
                {
                    move_uploaded_file($_FILES['filename']['tmp_name'],'files/'.$filename);
                    header('Location: /bills/?msg_class=complete&msg=Complete!');
                } else { header('Location: /bills/?msg_class=error&msg=Error!'); };
                break;
            case 'mod': // Форма редактирование счёта
                // Заполняю форму данными из БД:
                $query_mod = $db -> query("SELECT
                                id,
                                number,
                                filename,
                                date,
                                seller_id,
                                client_id,
                                content,
                                comment,
                                (SELECT CONCAT(`lastname`,' ',`firstname`) FROM users WHERE `uid`=`user_id`) AS `user_id`,
                                summ
                                    FROM bills
                                        WHERE id='$id'");
                if ($query_mod and $mod_data = $db -> fetch_assoc($query_mod))
                {
                    foreach($mod_data as $var=>$val) {
                        $$var = $val;
                    };
                    eval(tmplt_gen('forms/new.form'));
                };
                break;
            case 'upd': // Апдейт данных в БД (редактирование данных)
                $summ = str_replace(" ", "", str_replace(",", ".", $summ));
                if (check_string($date,'text'))
                {
                    $date = date("Y-m-d", strtotime($date));
                    $query_upd_params = "datetime_add=NOW(),
                                     number='$number',
                                     date='$date',
                                     seller_id='$seller_id',
                                     client_id='$client_id',
                                     content='$content',
                                     comment='$comment',
                                     summ='$summ',
                                     user_id='$admin_id'";
                } else {
                    $err = true;
                    $msg = 'Не верно указана дата счета.';
                    $msg_class .= 'error';
                }
                if (!$err and $filename)
                {
                    preg_match('/\S+\.(\S+)$/', $filename, $file_ext); // Расширение загружаемого документа
                    $filename = date('YmdHms').'.'.strtolower($file_ext[1]); // Имя файла в виде ГГГГММДДччммсс.***, где *** - расширение загружаемого документа};
                    $query_upd_params .= ", filename='$filename'";
                };
                $query_upd = $db -> query("UPDATE bills SET $query_upd_params WHERE `id`='$id'");
                if (!$err and $query_upd)
                {
                    move_uploaded_file($_FILES['filename']['tmp_name'], 'files/'.$filename);
                    header('Location: index.php?msg=Счёт успешно сохранён&msg_class=complete');
                } else {
                    $msg .= 'Были обнаружены ошибки. Данные не сохранены.';
                    $msg_class .= 'error';
                }
                break;
            case 'del': // Удаление счёта из БД
                $query_del = $db -> query("UPDATE bills SET deleted=1 WHERE id='$id'");
                if ($query_del)
                {
                    header('Location: index.php?msg=Счёт успешно удалён.&msg_class=complete');
                };
                break;
            case 'find': // Поиск и вывод счетов из БД по номеру или содержимому
                $page .= '<h3>Результаты поиска';
                if (mb_strlen($find_text, "utf-8") > 2) // Минимальная длина строки для поиска
                {
                    $query_find_cnt = $db -> query("SELECT SQL_NO_CACHE COUNT(*) AS cnt
                                        FROM bills
                                            WHERE (number LIKE '%".$find_text."%' AND deleted is null)
                                                OR (content LIKE '%".$find_text."%' AND deleted is null)");

                    $find_cnt = $db -> result($query_find_cnt); // Общее количество строк, подходящих под запрос
                    $pages = ceil($find_cnt/$rows_in_page); // Количество страниц
                    $query_find = "SELECT id,number,DATE_FORMAT(date,'%d.%m.%Y') as date,seller_id,client_id,content,comment,summ,filename
                                    FROM bills
                                        WHERE (number LIKE '%".$find_text."%' AND deleted is null)
                                            OR (content LIKE '%".$find_text."%' AND deleted is null) ORDER BY id DESC"; // Запрос
                    if ($find_cnt > 0) {

                        if ($page_num == 0) $query_find .= " LIMIT $rows_in_page";
                            else $query_find .= " LIMIT ".($page_num*$rows_in_page).",".$rows_in_page; // Лимиты

                        $page .= ' ('.$find_cnt.')</h3>';

                        eval(tmplt_gen('forms/filter.form')); // Форма фильтра

                        if ($query_find_res = $db -> query($query_find))
                        {
                            while($find_res = $db -> fetch_assoc($query_find_res))
                            {
                                $page .= table_bills($find_res);
                            };
                            $page .= "</table>";
                            $page .= "<div class='table-footer'><span class='statusbar'>Найдено счетов: $find_cnt</span>";
                            $page .= switch_pages($stage,$page_num,$pages,"&find_text=".$find_text); // Переключатель страниц
                            $page .= "</div>";

                        };
                    } else {
                        $page .= '</h3><div class="error">По вашему запросу ничего не найдено.</div><br>';
                    };
                } else {
                    $page .= '</h3><div class="error">Строка для поиска должна быть более 2-х символов.</div><br>';
                };
                $page .= "<div class='buttons'>$btn_home</div>";
                break;
            default: // Вывод счетов из БД по фильтру
                $query_list_cnt = $db -> query("SELECT SQL_NO_CACHE COUNT(*) AS cnt
                                        FROM bills
                                            WHERE deleted is null $filter_sql");
                $list_cnt = $db -> result($query_list_cnt); // Общее количество строк, подходящих под запрос
                $pages = ceil($list_cnt/$rows_in_page); // Количество страниц
                $query_list = "SELECT id,number,DATE_FORMAT(date,'%d.%m.%Y') as date,seller_id,client_id,content,comment,summ,filename
                                    FROM bills
                                        WHERE deleted is null $filter_sql ORDER BY id DESC"; // Запрос
                if ($page_num == 0) $query_list .= " LIMIT $rows_in_page";
                    else $query_list .= " LIMIT ".($page_num*$rows_in_page).",".$rows_in_page; // Лимиты

    //            $page .= '<h3>Результаты поиска</h3>';

                eval(tmplt_gen('forms/filter.form')); // Форма фильтра

                if ($query_list_res = $db -> query($query_list))
                {
                    if ($list_cnt>0)
                        while($list_res = $db -> fetch_assoc($query_list_res))
                            $page .= table_bills($list_res);
                    else
                      $page .= "<tr><td colspan='6' class='not_found'>Не найдено записей</td></tr>";
                    $page .= "</table>";
                    $page .= "<div class='table-footer'><span class='statusbar'>Всего счетов: $list_cnt</span>";
                    $page .= switch_pages($stage,$page_num,$pages,$filter); // Переключатель страниц
                    $page .= "</div>";
                };
                $page .= "<div class='buttons'>$btn_home <div class='right'>$btn_new_bill</div></div>";
                break;
        };
        // ---------------------------------------------------- //

        // ВЫВОД
        echo $page; // Тело
        eval(tmplt_gen('../stat/forms/end.form')); // Тапки
        $db_err = $db -> error();
        $db -> close();
    }
} else {
    $_SESSION["ref"] = "bills";
    authorize();
};

if ($db_err['error_no'] != null) { print_r($db_err); }; // DB-errors