<?php
/**
 * Created by PhpStorm.
 * User: vkalinichev
 * Date: 12.03.14
 * Time: 11:41
 */

$host = $_REQUEST["host"];

echo("
@echo off\n
psloggedon -l \\\\$host\n
\n
call \\\\xeon\\scripts$\\sessions\\");