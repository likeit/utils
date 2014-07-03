<?php
/**
 * Created by PhpStorm.
 * User: vkalinichev
 * Date: 07.02.14
 * Time: 14:04
 */

$host = $_REQUEST["host"];

echo("@echo off\npsloggedon -l \\\\$host\n\npause");