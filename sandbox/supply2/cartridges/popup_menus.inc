			<div id='menu_area' class='popup_menu'>
				<ul>
					<li><a class='popup_button' href='#'>Все</a>
					<?php
						$area	= mysql_query("SELECT * FROM areas");
						for ($i=0; $i<mysql_num_rows($area); $i++) {
							$id			= mysql_result($area, $i, "id");
							$area_name	= mysql_result($area, $i, "name");
							echo "\n\t\t	<li><a href='#'>".$area_name."</a>";
						};
					?>
				</ul>
			</div>