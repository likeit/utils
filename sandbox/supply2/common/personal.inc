<?php
	if (isset($_SESSION['username']))	    $personal_name	= $_SESSION['username'];	    else $personal_name	= $_SESSION['sess_login'];
	if (isset($_SESSION['privelege_id']))	$privelege_id	= $_SESSION['privelege_id'];	else $privelege_id	= 'goblin';
	//ПОКАЗЫВАТЬ НИК ИЛИ ИМЯ:
	$personal_name = $_SESSION['sess_login'];
?>

	<div id='personal_info'>
            <a id='personal_name' class='popup_button' href='javascript: void(0)'>
                <img src=<?php echo "'../img/user_16_$privelege_id.png'"?>>&nbsp;<?php echo $personal_name."\n" ?>
            </a>
            [<a href='/common/logout.php'>Logout</a>]
	</div>

	<div id='popup_personal_name' class='popup_menu'>
		<ul>
			<li><a href='/profile'>Profile</a>
			<li><a href='/settings'>Settings</a>
			<hr>
			<li><a href='/common/logout.php'>Logout</a>
		</ul>
	</div>