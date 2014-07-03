/* ВСЕ самописное для проекта Supplyman */
var KEY_ESC		    = 27;
var ARROW_POS		= 0.5;
var MODAL_POS       = 0.4;
var POPUP_SPD       = 0;
//var printer_models	= ["HP LaserJet P2015n", "HP LaserJet P2055n", "HP LaserJet P2055dn", "Xerox WorkCentre 3550X", "HP LaserJet M2727nf", "Canon MF4100"];
var active_modal	= '';
var active_popup	= '';
var dataIsLoading   = false;

$(document).ready(function(){
    $('.overlay').hide(0);
    $('.overlay').css({'visibility': 'visible'});

    $('html').click(function(){ hide_popup()});
	$('input.group').change(function(){ block_group_buttons() });
	$('input.check_all').change(function(){ check_all()});
	//$('button.blocked').click(function(){console.log(1)})
	$(".popup_button").click(function(){
		if (active_popup != this.id) {
			hide_popup();
			active_popup = this.id;
			show_popup(this.id);
		} else { hide_popup(); }
		return false;
	});


	$("div.modal input").focus(function(){ focusLabel(this)  });
	$("div.modal select").focus(function(){ focusLabel(this)  });

	$("div.modal input").blur(function(){ unFocusLabel(this)  });
	$("div.modal select").blur(function(){ unFocusLabel(this)  });
    $("button#delete_printers").click(function(){
        var printers_id='';
        $("table#printers td.check>input.group:checked").each(function(){
            if (printers_id!='') printers_id += ',';
            printers_id += $(this).attr('printer_id');
        })
        delete_printers(printers_id);
        console.log(printers_id);
    });

    // Выравниваем модальное окно по центру
	$(window).resize( function() { if (active_modal) { valign_to_center(active_modal+' .modal')}});
	
	// Кнопка открытия модального окна
	$(".modal_button").click(function(){
		show_modal(this.id);
		return false;
	});

	// Кнопка закрытия модального окна
	$(".modal_close").click(function(){
		close_this_modal();
		return false;
	});//*/

    $("form[name='edit_printer'] input[required=required]").keyup(function(){
        validateForm('edit_printer');
    });
    $("form[name='edit_printer'] select[required=required]").change(function(){
        validateForm('edit_printer');
    });
    $("form[name='edit_printer'] fieldset.multiselect input").change(function(){
        validateForm('edit_printer');
    });

    //	Добавляем автозавершение к списку моделей принтеров

	//	Добавляем мультименю к списку картриджей
    $('.multiselect').multiselect();

	//Закрываем модальное окно при входе в систему
	//$('.overlay').visiblity('visible');

	//Закрываем верхнее модальное окно по клику по оверлею
	$('.overlay').click( function(e) {
		if (isActiveModal(e)) close_this_modal()
	});


	//	Закрыть верхнее модальное окно при нажатии ESC
	$('body').on('keydown', function(e) {
		if (e.keyCode===KEY_ESC) {
			if (active_modal) {
				close_this_modal()
			} else {
				hide_popup(POPUP_SPD)
			}
		}
	});
	check_all();
});


function block_group_buttons() {
	var cb_checked = 0;
	$('input.group').each(function(){
		if (this.checked) {	cb_checked++ }
	});
	
	if (cb_checked>0) {
		$('button.group').removeClass('blocked');
		if (cb_checked<$('input.group').length) {
			$('input.check_all').removeAttr('checked');
		} else {
			$('input.check_all').attr('checked', 'checked');
		}
	} else {
		$('button.group').addClass('blocked');
	}
	
	
}

function show_modal(target) {
    var tmp = 0;
    hide_popup(POPUP_SPD);
	active_modal	=	'div#'+target+'_window';
	$(active_modal).show();
    //valign_to_center(active_modal+' .modal');
}

function valign_to_center(target) {
	var object	= $(target);
	object.css('top', ($(window).height() - object.outerHeight())*MODAL_POS);
}

function close_this_modal() {
	$(active_modal).hide();
	active_modal	=	'';
}

function show_popup(target) {
	var	button			= $('#'+target);
	var	action			= $('#popup_' + target);
	var	temp_html		= action.html();
	
	if (action.children('div.arrow').length<1) {
		action.html("<div class='arrow_border'></div><div class='arrow'></div>" + temp_html);// + "<hr><div class='close'><a href='#' onclick='javascript:void(0)'>close</a></div>");
	}
	var arrow			= $('#popup_' + target + ' > div.arrow');
	var arrow_border	= $('#popup_' + target + ' > div.arrow_border');

	var btnWidth	= button.outerWidth();
	var btnHeight	= button.outerHeight();
	var arrHeight	= arrow.outerHeight();
	var actWidth	= action.outerWidth();
	var arrLeft		= (actWidth-arrow.outerWidth())*ARROW_POS-1;
	var arrTop		= -arrow.outerWidth()+1	;
	var actLeft		= button.offset().left+ (btnWidth-actWidth)*ARROW_POS;
	var actTop		= button.offset().top +  btnHeight + arrHeight/2-2;
	action.css({left: actLeft, top: actTop});
	arrow.css({left: arrLeft, top: arrTop});
	arrow_border.css({left: arrLeft, top: arrTop-1});
	action.show(POPUP_SPD);
}

function isActiveModal(e){
    return ('div#'+e.target.id===active_modal);
}

/*		Hide all popup		*/
function hide_popup() {
	$('.popup_menu').hide(POPUP_SPD);
	active_popup='';
}

/*		Select_All/Deselect All		*/
function check_all() {
	if ($('input.check_all').attr('checked')) {
		$('input.group').attr('checked', 'checked');
	} else {
		$('input.group').removeAttr('checked');
	}
	block_group_buttons();
}

function showMsg(msgclass, text){
var msg = $('div#messages');
    msg.removeClass();
    msg.addClass(msgclass);
    msg.html("<div id='messages_close' onclick='hideMsg()'>x</div>"+text);
    msg.show(200);
    setTimeout("hideMsg()", text.length*25+1500);
//    console.log(text.length*15+2000);
}

function hideMsg(){
var msg = $('div#messages');
    msg.hide(250);
}

function get_printer(id) {
    $.ajax({
        url: '../common/get_printer.php',
        data: "printer_id="+id,
        dataType: 'text',
        type: 'POST',
        success: function(data) { load_printer(id, data.split('|')) }
    });
}

function delete_printers(id) {
    $.ajax({
        url: '../common/delete_printer.php',
        data: "p_id="+id,
        dataType: 'text',
        type: 'POST',
        success: function(data) {
            var msg         = data.split('|')[0];
            var msg_type    = data.split('|')[1];
            console.log(msg, msg_type);
            if (msg_type=='success') close_this_modal();
            showMsg(msg_type, msg);
        }
    });
}

function get_printer(id) {
    $.ajax({
        url: '../common/get_printer.php',
        data: "printer_id="+id,
        dataType: 'text',
        type: 'POST',
        success: function(data) { load_printer(id, data.split('|')) }
    });
}

function load_printer(id, params) {
    $('#edit_printer_id').val(id);
    $('#edit_printer_name').val(params[0]);
    $('#edit_printer_model').val(params[1]);
    $('#edit_printer_area').val(parseInt(params[2]));

    if (params!='') {
        var supply = params[3].split(',');

        $('#edit_printer_supply input:checkbox').each(function(){
            obj = $(this);
            if (findInArray(supply,obj.val())>-1)
                obj.attr('checked','checked');
            else
                obj.removeAttr('checked')
        })
    } else {
        $('#edit_printer_supply input:checkbox').each(function(){
            $(this).removeAttr('checked')
        })
    }

    $('#edit_printer_comment').val(params[4]);
    $('#edit_printer_supply').multiselect();
    validateForm('edit_printer');
    show_modal('edit_printer');
}

function get_supply(){
    //lala
}

function get_areas() {
    //lala
}

function isBlocked(button) {
    //if button.
}

jQuery.fn.multiselect = function() {
    $(this).each(function() {
        var checkboxes = $(this).find("input:checkbox");
        checkboxes.each(function() {
            var checkbox = $(this);
            highlightCheckbox(checkbox);

            checkbox.click(function() {
                highlightCheckbox(checkbox);
            });
        });
    });
};

function highlightCheckbox(checkbox){
    if (checkbox.attr("checked"))
        checkbox.parent().addClass("multiselect-on");
    else
        checkbox.parent().removeClass("multiselect-on");
}

function validateForm(form) {
    changeEPHeader();
    var formValid = true;
    var MsIsSelected = false;

    $("form[name="+form+"] input[required=required]").each(function() {
        if ($(this).val()=='') {
            $(this).removeClass('valid');
            formValid=false;
        } else {
            $(this).addClass('valid');
        }
    });

    $("form[name="+form+"] select[required=required]").each(function() {
        if ($(this).val()==-1) {
            $(this).removeClass('valid');
            formValid=false;
        } else {
            $(this).addClass('valid');
        }
    });

    if (formValid) {
        $('button.save').removeClass('blocked')
    } else {
        $('button.save').addClass('blocked')
    }

    $("form[name="+form+"] fieldset.multiselect input:checkbox").each(function(){
        if ($(this).attr('checked')) {
            MsIsSelected = true;
        }
    });

    if (MsIsSelected) {
        $("form[name="+form+"] fieldset.multiselect").addClass('valid')
    } else {
        $("form[name="+form+"] fieldset.multiselect").removeClass('valid')
    }

}

function savePrinter(){
    if (!$('button.save').hasClass('blocked')) {
        var pId     = $('#edit_printer_id').val();
        var pName   = $('#edit_printer_name').val();
        var pModel  = $('#edit_printer_model').val();
        var pArea   = $('#edit_printer_area').val();
        var pComment= $('#edit_printer_comment').val();

        var pSupply = '';

            $('#edit_printer_supply input:checkbox:checked').each(function(){
                if (pSupply!='') pSupply += ',';
                pSupply += $(this).val();
            });

        //console.log("p_id="+pId+"&p_name="+pName+"&p_model="+pModel+"&p_area="+pArea+"&p_comment="+pComment+"&p_supply="+pSupply);

         $.ajax({
            url: '../common/save_printer.php',
            data: "p_id="+pId+"&p_name="+pName+"&p_model="+pModel+"&p_area="+pArea+"&p_comment="+pComment+"&p_supply="+pSupply,
            dataType: 'text',
            type: 'POST',
            success: function(data) {
            var msg         = data.split('|')[0];
            var msg_type    = data.split('|')[1];
                console.log(msg, msg_type);
                if (msg_type=='success') close_this_modal();
                showMsg(msg_type, msg);
            }
        });//*/
    }
}

function focusLabel(input){
    $(input).parent('label').addClass('focus');
    $(input).closest('fieldset').addClass('focus');
}

function unFocusLabel(input){
    $(input).parent('label').removeClass('focus');
    $(input).closest('fieldset').removeClass('focus');
}

// создаем пустой массив и проверяем поддерживается ли indexOf
function findInArray(array, value) {
    for(var i=0; i<array.length; i++) {
        if (array[i] == value) return i;
    }
    return -1;
}

function changeEPHeader() {
    if ($('#edit_printer_id').val()==='New')
        $('div.modal>h3').html('New printer')
    else {
        var printerName = $('#edit_printer_name').val();
        $('div.modal>h3').html('Edit printer "'+printerName+'"');
    };
}