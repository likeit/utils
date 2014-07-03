<?php
    $pagename		= 'printers';
    $pagename_ru	= 'Принтеры';

    include('../common/head.inc');
    include('../printers/popup_menus.inc');

    if (!isset($model_filter))  $model_filter  = 'All';
	if (!isset($area_filter))   $area_filter   = 'All';
	if (!isset($supply_filter)) $supply_filter = 'All';
?>

		<table id='printers' class='list'>
			<tr>
				<th class='check'			><input type='checkbox' class='check_all'/></th>
				<!--<th class='refill'			><img src='/img/change_supply_16.png' /></th>-->
				<th class='sort_possible count'			>Status</th>
				<th class='sort_possible name'			>Name</th>
				<th class='sort_possible model'			>Model:&nbsp;<a		id='printer_model'	class='popup_button' href="javascript: void(0)"><?php echo $model_filter  ?></a></th>
				<th class='sort_possible area'			>Area:&nbsp;<a		id='printer_area' 	class='popup_button' href="javascript: void(0)"><?php echo $area_filter   ?></a></th>
				<th class='sort_possible cartridge_use'	>Supplies:&nbsp;<a	id='cartridge'		class='popup_button' href="javascript: void(0)"><?php echo $supply_filter ?></a></th>
				<th class='comment'		>Comment</th>
			</tr>
				<?php
					$printers		= mysql_query("SELECT * FROM printers");
					$printer_models	= mysql_query("SELECT * FROM printer_models");
					$areas 			= mysql_query("SELECT * FROM areas");
					$cartridges		= mysql_query("SELECT * FROM cartridges");
					$count			= mysql_num_rows($printers);

                    for ($i=0; $i<$count; $i++) {
						unset($cartridge_use_id);
						$id					= mysql_result($printers, $i,   "id");
						$name				= mysql_result($printers, $i,   "name");
						$model_id			= mysql_result($printers, $i,   "model");
						$area_id			= mysql_result($printers, $i,   "area");
                        $cartridge_use_id	= mysql_result($printers,		$i,					"cartridge_use");
                        $status				= mt_rand(0,6);
                        $model_row		    = mysql_query("SELECT * FROM printer_models WHERE id=$model_id");
                            $model_arr      = mysql_fetch_array($model_row);
                            $model		    = $model_arr["name"];
                        $area_row		    = mysql_query("SELECT * FROM areas WHERE id=$area_id");
                            $area_arr       = mysql_fetch_array($area_row);
                            $area		    = $area_arr["name"];
                        $comment			= mysql_result($printers,		$i,					"comment");
	                

						if ((($model_filter  =='All') or ($model_filter  == $model)) and
							(($area_filter   =='All') or ($area_filter   == $area_id)) and
							(($supply_filter =='All') or ($supply_filter == $cartridge_use_id))) {
						
							if (isset($cartridge_use_id))
							    $cartridge_use_name	= mysql_result($cartridges,	$cartridge_use_id-1,	"model");
							else  $cartridge_use_name = "---";
						
							echo "\n	<tr>
							    \n\t	<td class='check'			><input type='checkbox' class='group' printer_id='$id' /></td>
							    \n\t	<td class='count'			><img src='/img/status_${status}.png' alt='status'/></td>
							    \n\t	<td class='name left'		><a id='printer_name_$id' class='popup_button' href='javascript: void(0)'>$name</a></td>
							    \n\t	<td class='model left'		>$model</td>
							    \n\t	<td class='area'			>$area</td>
							    \n\t	<td class='cartridge'	    >$cartridge_use_name</td>
							    \n\t	<td class='comment left'	>$comment</td>
							    \n      </tr>";
							include("./popup_printer_name.inc");
						};
					};
					
				?>
		</table>
		
		<div id='buttons'>
			<button id='replace_supply'		type='button'	class='group pic replace'>			Replace selected	</button>
			<button id='delete_printers'	type='button'	class='modal_button group pic delete'>				Delete selected		</button>
			<button id='edit_printer'		type='button'	class='modal_button pic add' onclick='load_printer("New","")'>	Add new				</button>
		</div>
	</div>
  
	
<?php include('../common/footer.inc') ?>