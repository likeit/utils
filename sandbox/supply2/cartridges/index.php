<?php
	$pagename 		= 'cartridges';
	$pagename_ru	= 'Картриджи';

	include('../common/head.inc');
    include('../cartridges/popup_menus.inc');
?>
	
		<table id='supply' class='list'>
			<tr>
				<th class='check'		><input type='checkbox' class='check_all' /></th>
				<th class='refill'	><img src='../img/send_16.png' alt='Отправить на заправку'/></th>
				<th class='refill'	><img src='../img/receive_16.png' alt='Вернуть с заправки'/></th>
				<th class='model'		>Модель</th>
				<th class='count'		>Кол-во</th>
				<th class='in_use'		>В работе</th>
				<th class='in_refill'	>На заправке</th>
				<th class='area'		>Территория:&nbsp;<a id='select_area' class='popup_button' href="javascript: reshow_menu('select_area','menu_area',10,6)">Все</a></th>
			</tr>
				<?php
					$cartridges		= mysql_query("SELECT * FROM cartridges");
					$areas 			= mysql_query("SELECT * FROM areas");
					$count			= mysql_num_rows($cartridges);
					for ($i=0; $i<$count; $i++) {
						$id					= mysql_result($cartridges, $i, "id");
						$model				= mysql_result($cartridges, $i, "model");
						$count_total		= mysql_result($cartridges, $i, "count_total");
						$count_in_refill	= mysql_result($cartridges, $i, "count_in_refill");
						$count_in_use		= '1+1';
						$area				= mysql_result($cartridges, $i, "id");
						
						echo "\n	</tr>";
						echo "\n\t	<td class='check'			><input type='checkbox' class='group'/></td>";
						echo "\n\t	<td class='send'			><a href='#' title='Отправить на заправку'><img src='/img/send_16.png' /></a></td>";
						echo "\n\t	<td class='receive'			><a href='#' title='Вернуть с заправки'><img src='/img/receive_16.png' /></a></td>";
						echo "\n\t	<td class='model left'		>".$model."</td>";
						echo "\n\t	<td class='count'			>".$count_total."</td>";
						echo "\n\t	<td class='count'			>".$count_in_use."</td>";
						echo "\n\t	<td class='count'			>".$count_in_refill."</td>";
						echo "\n\t	<td class='area'			>".$area."</td>";
						echo "\n	</tr>";
					
					};
				?>
		</table>
	
		<div id='buttons'>
			<ul>
				<li><button id='send_supplies'		class='group pic send'>		Send selected		</button>
				<li><button id='receive_supplies'	class='group pic receive'>	Receive selected	</button>
				<li><button id='delete_suppplies'	class='group pic delete'>		Delete selected		</button>
				<li><button id='edit_supply'		class='modal_button pic blue add'>				Add new				</button>
			</ul>
		</div>
	</div>
  

<?php include('../common/footer.inc') ?>