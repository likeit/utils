			<div id='popup_printer_model' class='popup_menu'>
				<ul>
					<?php
						$printer_models	= mysql_query("SELECT * FROM printer_models");
						for ($i=0; $i<mysql_num_rows($printer_models); $i++) {
							$id		= mysql_result($printer_models, $i, "id");
							$model	= mysql_result($printer_models,	$i, "name");
							echo "\n\t\t	<li><a href='#'>".$model."</a>";
						};
					?>
					<hr>
					<li class='last'><a class='popup_button' href='#'>All</a>
				</ul>
			</div>

			<div id='popup_printer_area' class='popup_menu'>
				<ul>
					<?php
						$area	= mysql_query("SELECT * FROM areas");
						for ($i=0; $i<mysql_num_rows($area); $i++) {
							$id			= mysql_result($area, $i, "id");
							$area_name	= mysql_result($area, $i, "name");
							echo "\n\t\t	<li><a href='#'>".$area_name."</a>";
						};
					?>
					<hr>
					<li class='last'><a class='popup_button' href='#'>All</a>
				</ul>
			</div>
			
			<div id='popup_cartridge' class='popup_menu'>
				<ul>
					<?php
						$cartridges	= mysql_query("SELECT * FROM cartridges");
						for ($i=0; $i<mysql_num_rows($cartridges); $i++) {
							$id		= mysql_result($cartridges, $i, "id");
							$model	= mysql_result($cartridges, $i, "model");
							echo "\n\t\t	<li><a href='#'>".$model."</a>";
						};
					?>
					<hr>
					<li class='last'><a class='popup_button' href='#'>All</a>
				</ul>
			</div>