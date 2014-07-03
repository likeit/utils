<?php
/**
 * Created by PhpStorm.
 * User: vkalinichev
 * Date: 19.03.14
 * Time: 17:15
 */


$host = $_REQUEST["host"];

echo("@echo off\npsexec \\\\$host cmd\n\npause");