			<div id='popup_printer_name_<?php echo $id?>' class='popup_menu'>
				<ul>
					<li><a href='javascript: void(0)' id='replace_printer'>Replace</a>
					<li><a href='javascript: void(0)' onclick='get_printer(<?php echo $id ?>)'>Edit</a>
					<li><a href='javascript: void(0)' id='copy_printer'>Copy</a>
                    <hr>
					<li><a href='javascript: void(0)' onclick='delete_printers(<?php echo $id ?>)'>Delete</a>
				</ul>
			</div>