<?php

function getCategories($parent = 0) {
    global $db;
    $result = [];

    $query_select = $db -> query("SELECT `id`,`name` FROM catalog_categories WHERE `parent`='$parent'");

    while ($res = $db -> fetch_assoc($query_select))
        $result[$res['id']] = $res;

    return $result;
};

function getCategory($id) {
    global $db;
//    echo "SELECT * FROM catalog_categories WHERE `id`='$id'";
    $query_select = $db -> query("SELECT * FROM catalog_categories WHERE `id`='$id'");
    $res = $db -> fetch_assoc($query_select);
    $result[$res['id']] = $res;

    if ($res["parent"]==0) $result[$res['id']] = $res;
    else $result = getCategory($res["parent"]);

//    print_r($result);
    return $result;
};

function getMark($id) {
    global $db;
    $query_select = $db -> query("SELECT * FROM catalog_marks WHERE `id`='$id'");
    $res = $db -> fetch_assoc($query_select);
    if ($res["parent"]==0)
        $result[$res['id']] = $res;
    else $result = getMark($res["parent"]);
    return $result;
}

function getGroup($id) {
    global $db;
    $query_select = $db -> query("SELECT * FROM catalog_groups WHERE `id`='$id'");
    $res = $db -> fetch_assoc($query_select);
    if ($res["parent"]==0)
        $result[$res['id']] = $res;
    else $result = getGroup($res["parent"]);
    return $result;
}

function getModel($id) {
    global $db;
    $query_select = $db -> query("SELECT * FROM catalog_models WHERE `id`='$id'");
    $res = $db -> fetch_assoc($query_select);
    $result[$res['id']] = $res;
    return $result;
}

function getMarks() {
    global $db;
    $result = [];

    $query_select = $db -> query("SELECT `id`,`name` FROM catalog_marks ORDER BY `name`");

    while ($res = $db -> fetch_assoc($query_select))
        $result[$res['id']] = $res;

    return $result;
};

function getGroups($mark,$cat,$parent = 0) {
    global $db;
    $result = [];

    $query_select = $db -> query("SELECT `id`,`name` FROM catalog_groups WHERE `mark`='$mark' AND `category`='$cat' AND `parent`='$parent' ORDER BY `name`");

    while ($res = $db -> fetch_assoc($query_select))
        $result[$res['id']] = $res;

    return $result;
};

function getModels($group) {
    global $db;
    $result = [];

    $query_select = $db -> query("SELECT `id`,`name` FROM catalog_models WHERE `group`='$group' ORDER BY `name`");

    while ($res = $db -> fetch_assoc($query_select))
        $result[$res['id']] =$res;

    return $result;
};

function getModifications($model) {
    global $db;
    $result = [];

    $query_select = $db -> query("SELECT * FROM catalog_modifications WHERE `model`='$model' ORDER BY `name`");

    while ($res = $db -> fetch_assoc($query_select))
        $result[$res['id']] = $res;

    return $result;
};
