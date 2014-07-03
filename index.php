<?php

/*
 * index.php
 * general page
 *
 */

ini_set('display_errors',1);
error_reporting(E_ALL ^E_NOTICE);

require('subs.php');
require('conf.inc.php');
require_once("lib/dblayer.php");

$stage = isset($_REQUEST['stage']) ? check_string($_REQUEST['stage'],'string') : null; // Стадия

if (isAuthorized())
    header("Location: home");
//    echo 1;
else
//    echo 2;
    authorize();

if ($db_err["error_no"] != null) { print_r($db_err); }; // DB-errors