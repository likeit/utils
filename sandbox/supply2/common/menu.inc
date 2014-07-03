<div id='nav_menu'>
            <ul>
<?php
	$sections		= array( 'printers',	'cartridges',/*	'journal',*/	'about'		);
//	$sections_ru	= array( 'Принтеры',	'Картриджи',	'Журнал',	'О проекте'	);
	$sections_en	= array( 'Printers',	'Cartridges',/*	'Journal',*/	'About'		);

	for ($i=0; $i<count($sections);$i++) {
		if ($pagename==$sections[$i]) {
			echo "\t\t<li class='active'>".$sections_en[$i]."</li>\n";
		} else {
			echo "\t\t<li><a href='../".$sections[$i]."'>".$sections_en[$i]."</a></li>\n";
		}
	};
?>
            </ul>
	</div>
