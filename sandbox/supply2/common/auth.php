<?php
    if (isset($_POST["login"])) {
        $enter_login    = $_POST["login"];

        $users		    = mysql_query ("SELECT * FROM users WHERE login = '$enter_login'");
        $user           = mysql_fetch_array ($users);

        $login	        = $user["login"];
        $enter_passw    = $user["password"];
        $username       = $user["name"];
        $privelege_id   = $user["privelege"];
    }
?>