<?php

require_once("../subs.php");
require_once("../conf.inc.php");
require_once("../lib/dblayer.php");
require_once("./subs.php");
require_once("../vendor/autoload.php"); // Twig инициализация
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem("../templates"); // Twig папка с шаблонами
$twig   = new Twig_Environment($loader, array("cache" => "../cache", "auto_reload" => 1)); // Twig no cache
$template = 'tools.twig';


if ($admin_login = isAuthorized()) {

    $c['nojs'] = true;
    $users = getUsers();
    $permissions = getPermissions($admin_login["uid"], $users);
    if ($permissions["bills"] == 'deny') unset($TITLE["bills"]);
    if ($permissions["users"] == 'deny') unset($TITLE["users"]);
    $c['dir']        = basename(__DIR__);
    $TITLE['helpdesk/reports'] = "Отчёты";
    $c['sections']   = $TITLE;
    $categories = getCategories();
    $c["cat"] = $_cat = checkRequest("cat");
    if ($_cat) $c['current_cat'] = getCategory($_cat);
//    if ($_cat) echo 1;
    $_cat_parent = "";
    $c["mark"] = $_mark          = checkRequest("mark");
    if ($_mark) $c['current_mark'] = getMark($_mark);
    $c["group"] = $_group         = checkRequest("group");
    if ($_group) $c['current_group'] = getGroup($_group);
    $_group_parent  = "";
    $c["model"] = $_model         = checkRequest("model");
    if ($_model) $c['current_model'] = getModel($_model);
    $c["modification"] = $_modification  = checkRequest("modification");

    if (checkRequest("update_catalog") == true) {
        $xml = simplexml_load_file($_SERVER["DOCUMENT_ROOT"]."/tools/autoru_catalog/catalog.xml");
        $all_categories    = $xml -> categories -> rec;
        $all_marks         = $xml -> marks  -> rec;
        $all_groups        = $xml -> groups -> rec;
        $all_models        = $xml -> models -> rec;
        $all_modifications = $xml -> modifications -> rec;
        $all_tech_names    = $xml -> tech_names -> rec;
        $all_tech_values   = $xml -> tech_values -> rec;

        foreach ($all_categories as $category) {
            $id     = (int) $category -> id;
            $name   = mysql_real_escape_string(urldecode($category -> name));
            $parent = (int) $category -> parent_id;
            $categories_sql_arr[$id]    = trim("('$id', '$name', '$parent')");
        }

        foreach ($all_marks as $mark) {
            $id     = (int) $mark -> id;
            $name   = mysql_real_escape_string(urldecode($mark -> name));
            $marks_sql_arr[$id] = trim("('$id', '$name')");
        }

        foreach ($all_groups as $group) {
            $id     = (int) $group -> id;
            $name   = mysql_real_escape_string(urldecode($group -> name));
            $cat    = (int) $group -> cat_id;
            $mark   = (int) $group -> mark_id;
            $parent = (int) $group -> parent_id;
            $groups_sql_arr[$id] = trim("('$id', '$name', '$cat', '$mark', '$parent')");
        }

        foreach ($all_models as $model) {
            $id     = (int) $model -> id;
            $name   = mysql_real_escape_string(urldecode($model -> name));
            $group  = (int) $model -> group_id;
            $models_sql_arr[$id] = trim("('$id', '$name', '$group')");
        }

        foreach ($all_modifications as $modification) {
            $id     = (int) $modification -> id;
            $model  = (int) $modification -> model_id;
            $name   = mysql_real_escape_string(urldecode($modification -> name));
            $start_year  = (int) $modification -> start_year;
            $end_year    = (int) $modification -> end_year;
            $modifications_sql_arr[$id] = trim("('$id', '$model', '$name', '$start_year', '$end_year')");
        }

        $categories_sql = implode(",", $categories_sql_arr);
        $marks_sql      = implode(",", $marks_sql_arr);
        $groups_sql     = implode(",", $groups_sql_arr);
        $models_sql     = implode(",", $models_sql_arr);
        $modifications_sql     = implode(",", $modifications_sql_arr);

        $query_insert_categories = "  INSERT INTO catalog_categories (`id`, `name`, `parent`)
                                      VALUES".$categories_sql."ON DUPLICATE KEY UPDATE
                                          `id` = VALUES(`id`), `name` = VALUES(`name`), `parent` = VALUES(`parent`)";

        $query_insert_marks = " INSERT INTO catalog_marks (`id`, `name`)
                                VALUES".$marks_sql."ON DUPLICATE KEY UPDATE
                                    `id` = VALUES(`id`), `name` = VALUES(`name`)";

        $query_insert_groups = "  INSERT INTO catalog_groups (`id`, `name`, `category`, `mark`, `parent`)
                                      VALUES".$groups_sql."ON DUPLICATE KEY UPDATE
                                          `id` = VALUES(`id`), `name` = VALUES(`name`), `category` = VALUES(`category`), `mark` = VALUES(`mark`), `parent` = VALUES(`parent`)";

        $query_insert_models = "  INSERT INTO catalog_models (`id`, `name`, `group`)
                                      VALUES".$models_sql."ON DUPLICATE KEY UPDATE
                                          `id` = VALUES(`id`), `name` = VALUES(`name`), `group` = VALUES(`group`)";

        $query_insert_modifications = "  INSERT INTO catalog_modifications (`id`, `model`, `name`, `start_year`, `end_year`)
                                      VALUES".$modifications_sql."ON DUPLICATE KEY UPDATE
                                          `id` = VALUES(`id`), `model` = VALUES(`model`), `name` = VALUES(`name`), `start_year` = VALUES(`start_year`), `end_year` = VALUES(`end_year`)";

        $db -> query($query_insert_categories);
        $db -> query($query_insert_marks);
        $db -> query($query_insert_groups);
        $db -> query($query_insert_models);
        $db -> query($query_insert_modifications);
    }


    if ($_model) {
        $c["list"] = getModifications($_model);
        $c["link"] = "modification";
    } elseif ($_group) {
        $c["list"] = getModels($_group);
        $c["link"] = "model";
    } elseif ($_mark) {
        $c["list"] = getGroups($_mark, $_cat);
        $c["link"] = "group";
    } elseif ($_cat) {
        $cat_children = getCategories($_cat);
        if (count($cat_children) > 0) {
            $c["list"] = $cat_children;
            $c["link"] = "cat";
        } else {
            $c["list"] = getMarks();
            $c["link"] = "mark";
        }
    } else {
        $c["list"] = $categories;
        $c["link"] = "cat";
    };

    $c["uri"] = $_SERVER['REQUEST_URI'];

    echo $twig->render($template, $c);

//print_r($errors);
}