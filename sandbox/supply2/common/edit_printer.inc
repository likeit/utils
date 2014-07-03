			<div id="edit_printer_window" class='overlay'>
				<div class="modal">
					<h3>Add printer</h3>
					<hr>
                    <form name='edit_printer' action="">
                        <div class="left">

                            <input id='edit_printer_id' type='hidden'/>

                            <div class='line'>
                                <label>Name:
                                    <input  id='edit_printer_name' type='text' required=required />
                                </label>
                            </div>

                            <div class='line'>
                                <label>Model:
                                    <input id='edit_printer_model' type='text' required=required />
                                </label>
                            </div>

                            <div class='line'>
                                <label>Area: <select  id='edit_printer_area' required=required>
                                    <option value='-1'>-не выбрано-</option>
                                    <?php
                                        $areas	= mysql_query("SELECT * FROM areas");
                                        $count	= mysql_num_rows($areas);
                                        for ($i=0; $i<$count; $i++) {
                                            $id		= mysql_result($areas, $i, "id");
                                            $area	= mysql_result($areas, $i, "name");
                                            echo "<option value='".$id."'>".$area."</option>";
                                        };
                                        echo "\n";
                                    ?>
                                    </select>
                                </label>
                            </div>

                            <div class='line'>
                                <label>Coment: <input id='edit_printer_comment'  type='text' /></label>
                            </div>
                        </div>

                        <div class='right col'>
                            <fieldset id='edit_printer_supply' class="multiselect">
                                <legend>Supply:</legend>
                                    <?php
                                $cartridges		= mysql_query("SELECT * FROM cartridges");
                                $count			= mysql_num_rows($cartridges);
                                for ($i=0; $i<$count; $i++) {
                                    $id			= mysql_result($cartridges, $i, "id");
                                    $cartridge	= mysql_result($cartridges, $i, "model");
                                    echo "<label><input type='checkbox' name='option[]' value='".$id."' />".$cartridge."</label>";
                                }
                                echo "\n";
                                ?>
                            </fieldset>
                        </div>

                        <div class='bottom'>
                            <br>
                            <hr>
                            <button class='pic red cancel modal_close'	onclick="" type='button'>Cancel</button>
                            <button class='pic green save'	onclick="savePrinter()" type='button'>Save</button>
                        </div>
                        <!--<button onclick="get_printer_info(3)" type=button>Load</button>-->
                    </form>
				</div>
			</div>