var POPUP_SPD       = 0,
    ARROW_POS		= 0.5,
    active_popup	= '',
    MSG_TIME        = 4000, //how long show messages
    CUT_SLIDE_TIME  = 50,
    start = [];


$(document).ready(function(){
    $.datepicker.regional['ru'] = {
        closeText: 'Закрыть',
        duration: 100,
        prevText: '&#x3C;Пред',
        nextText: 'След&#x3E;',
        currentText: 'Сегодня',
        monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь', 'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
        monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн','Июл','Авг','Сен','Окт','Ноя','Дек'],
        dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
        dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
        dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
        weekHeader: 'Нед',
        dateFormat: 'dd.mm.yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: '',
        showOtherMonths: true,
        selectOtherMonths: true,
        animate: 100
    };

//    $(".clipbutton").zclip({
//        path:'http://utils.avto-sale.local/lib/zclip/zclip.swf',
//        copy: function(){
//            return "ololo"
//        }
//    });


    $.datepicker.setDefaults($.datepicker.regional['ru']);

    $('.calendar').datepicker();

    if (typeof ($(".edit_description").autosize) != "undefined")
        $(".edit_description").autosize();

    if (typeof ($("#new_comment_text").autosize) != "undefined")
        $("#new_comment_text").autosize();


    $(".birthday-mask").inputmask("99.99.9999");
    $(".phone-mask").inputmask("999[9]");
    $(".skud-mask").inputmask("[9][9][9][9][9][9][9]");

    $('html').click(function(e){
        hideExtra(e)
    });

    $("#input-deadline").change(function(){
        $('.clear-deadline').removeClass('hidden')
    });

    $('#help_button').click(function(){
        $('#help_baloon').toggleClass('hidden');
    });

    $('.button_show_autocomments').click(function(){
        var cut_block = $(this).parent();
        cut_block.toggleClass('show_autocomments');

        setTimeout(function(){
            if (cut_block.hasClass('cutted'))
                cutClick(cut_block);
        }, 200);
    });

    $('.users.list tr').click(function(e){
        if (!$(this).hasClass('selected')) {
            var user_id = $(this).attr('data-id');
            getUserInfo(user_id, e);
        } else hideExtra(e);
    });

    $('.user-flag').click(function(){
        var flags = [];
        $('.user-flag:checked').each(function(){
            flags.push($(this).val());
        });
        $('#input-flags').val(flags.join(","));
    });

    $('#update-tags').click(function(){
        updateTags()
    });

    $('#add-tag').click(function(){
        addTag();
    });

    $('a.ticket_creator').click(function(e){
        var user_id = $(this).attr('data-id');
        getUserInfo(user_id, e);
    });

    $('.ticket_changer').click(function(e){
        var user_id = $(this).attr('data-id');
        getUserInfo(user_id, e);
    });

    $('.user__online').click(function(e){
        var user_id = $(this).attr('data-id');
        getUserInfo(user_id, e);
    });

    $('.button_show_timeline').click(function(e){
        $(this).parent().toggleClass("active");
        if ($(this).parent().hasClass("active")) {
            $('.list tr').each(function(){
                $(this).wrap('<div class="timeline"></div>');
            })
        } else {
            $('.list .timeline').remove();
        }
    });

    $('.tickets.list tr').click(function(e){
        if (e.target.tagName != "A") {
            var row = $(this),
                ticket_id = row.attr('data-id');
                row.addClass('showed_info');

            if (row.hasClass('showed_info'))
                getTicketInfo(ticket_id, e);
        }
    });

    $('form *').keydown(function(e){
        jumpOnEnter(e);
    });

    $('.filter_checkbox').change(function(){
        var this_checkbox       = $(this),
            label               = this_checkbox.parent(),
            params_block        = this_checkbox.parents('.params_block'),
            checked_checkboxes  = params_block.find('.filter_checkbox:checked');

        if (checked_checkboxes.length > 0) {
            params_block.addClass('filtered');
            params_block.find('.count').text("(" + checked_checkboxes.length + " / " + params_block.find('input').length + ")");
        } else {
            params_block.removeClass('filtered');
            params_block.find('.count').text("");
        }

        if (this_checkbox.attr("checked")=="checked")
            label.addClass('checked');
        else
            label.removeClass('checked');

    });

    $('#add_photo_button').click(function(){
        $('#photo_file').click();
    });

    $('#photo_file').change(function(){
        if(this.files.length >0)
            uploadPhoto();
    });

    $('#user-photo-delete').click(function(){
        deletePhoto();
    });

    $('#popup_tags .tag').click(function(){
        $(this).toggleClass("active");
        updateTags();
    });

    $(".popup_button").click(function(e){
		if (active_popup != this.id) {
			hideExtra(e);
			active_popup = this.id;
			show_popup(this.id);
		} else { hidePopupMenus() }
		return false;
	});

    $('.cutter').on("click",function(){
        cutClick($(this).parent('.cut_block'));
    });

    $('input[data-performer]').change(function(){
        loadPerformers();
    });

    $('input.check_all').change(function(){ check_all()});
    $('input.group').change(function(){ checkbox_change() });

    $("#filter_by_status").click(function(){
        var items = [];

        if (!$(this).hasClass('blocked')) {
            $('input.group').each(function(){
                if (this.checked)
                    items[items.length] = this.getAttribute('data-id');
            });
            if (items.length>0) $('input#status_id').val(items.join(','));
            document.form.submit();
        }
    });

    $('#button_filters_settings').click(function(){
        $('.filter').toggleClass('edit_mode');
    });

    $('#save_ticket').click(function(){
        if (!$(this).hasClass("disabled")) {
            $(this).addClass("disabled");
            document.forms['ticket_edit'].submit()
        }
    });

    $('#save_ticket_and_back').click(function(){
        $('#ticket_edit').attr('action', $('#ticket_edit').attr('action') + '&back=1');
        document.forms['ticket_edit'].submit()
    });

    $("#user_dept").change(function(){
        getPosts($(this).val());
    });

    $(".msg").on("click",function(){
        hideMessage($(this));
    });

    var start_messages = $('div.msg');
    setTimeout(function(){ hideMessage(start_messages) },MSG_TIME);

    if (typeof(loadPerformers) != "undefined") loadPerformers();
    if (typeof(loadFilter)     != "undefined") loadFilter();

    getBurningCounts(true);
});

function cutClick(cut_block) {
    if (cut_block.hasClass('cutted'))
        cut_block.find('.cut').slideDown(CUT_SLIDE_TIME);
    else
        cut_block.find('.cut').slideUp(CUT_SLIDE_TIME);

    setTimeout(function(){
        cut_block.toggleClass('cutted');
    },CUT_SLIDE_TIME + 5);
}

function show_popup(target) {
	var	button			= $('#' + target),
		popup			= $('#popup_' + target);

	if (popup.children('.arrow').length<1) {
		popup.prepend("<div class='arrow_border'></div><div class='arrow'></div>");
	}

    //echo
	var arrow			= $('#popup_' + target + ' > div.arrow'),
	    arrow_border	= $('#popup_' + target + ' > div.arrow_border'),

	    buttonX = button.offset().left,
	    buttonY = button.offset().top,
        buttonW	= button.outerWidth(),
        buttonH = button.outerHeight(),

        popupW	= popup.outerWidth(),

        arrowH	= parseInt(arrow.css("border-bottom-width"))*2,
        arrowW	= parseInt(arrow.css("border-left-width"))*2,
        arrowX	= (popupW-arrowW) * ARROW_POS - 1,
        arrowY	= -arrowH + 1,

	    popupX	= buttonX + (buttonW - popupW) * ARROW_POS;

//    echo(arrowY);
    if (popupX<20) {
        popupX = 20;
        arrowX = buttonX+(buttonW-arrowH)/2-popupX;
    }

	var popupY	= buttonY  +  buttonH + arrowH / 2 - 3;

	popup.css({left: popupX, top: popupY});
	arrow.css({left: arrowX, top: arrowY + "px"});
	arrow_border.css({left: arrowX, top: (arrowY-1) + "px" });
	popup.show(POPUP_SPD);
}

function hideMessages(messages) {
    messages.slideUp(100,'swing');
}

function hideMessage(message) {
    if (message.length > 0) {
        message.fadeOut(100);
        setTimeout(function(){
            message.remove();
        },300)
    }
}

function showMessage(msgBox, msgClass, text) {
    hideMessages($('.msg'));
    msgBox.removeClass();
    msgBox.addClass('msg');
    msgBox.addClass(msgClass);
    msgBox.html(text);
    msgBox.slideDown(100);
    setTimeout("hideMessages($('div.msg'))", MSG_TIME);
}

function showMsg(msgClass, msgText) {
    var rand = (Math.random()*10000000).toFixed();
    var msg = $("<div class='msg " + msgClass + "' id='msg_" + rand + "'>" + msgText + "</div>");
    $('.top-panel').prepend(msg);
    msg.fadeIn(300);
    setTimeout("hideMessage($('#msg_" + rand + "'))", MSG_TIME);
}

function hidePopupMenus() {
	$('.popup_menu').hide(POPUP_SPD);
	active_popup='';
}

function hidePopupWindows(){
    $('.popup_window').remove();
    $('.selected').removeClass('selected');
}

function submitOnEnter (event, form) {
	if (event.keyCode == 13) document[form].submit();
}

function forEach(data, callback){
    for(var key in data){
        if(data.hasOwnProperty(key)){
            callback(key, data[key]);
        }
    }
}

function check_all() {
    if ($('input.check_all').attr('checked'))
        $('input.group').attr('checked', 'checked');
    else
        $('input.group').removeAttr('checked');
    checkbox_change();
}

function checkbox_change() {
    var cb_checked = 0;
    $('input.group').each(function(){
        if (this.checked) {	cb_checked++ }
    });

    if (cb_checked>0) {
        $('a.group').removeClass('blocked');
        if (cb_checked<$('input.group').length)
            $('input.check_all').removeAttr('checked');
        else
            $('input.check_all').attr('checked', 'checked');
    } else
        $('a.group').addClass('blocked');
}

function parseGetParams() {
    var $_GET = {};
    var __GET = window.location.search.substring(1).split("&");
    for(var i=0; i<__GET.length; i++) {
        var getVar = __GET[i].split("=");
        $_GET[getVar[0]] = typeof(getVar[1])=="undefined" ? "" : getVar[1];
    }
    return $_GET;
}

function getFileExt(filename) {
    return filename.substr(filename.lastIndexOf("."))
}

function hideExtra(e) {
    var target = $(e.target);
    if ((target.hasClass('sensitive')) || (!target.parents('.unsensitive').length>0)) {
        hidePopupMenus();
        hidePopupWindows();
    }
}

function jumpOnEnter(e) {
    if (e.keyCode == 13) {
        e.keyCode = 9;
        var tab = $.Event("keypress", { keyCode: 9 }),
            control = $(e.target);

//        console.log(tab);
//        control.trigger( tab );
//            tabIndex = control.attr('tabIndex');
//        if (tabIndex>0) {
//            $('[tabIndex=' + (tabIndex + 1) + ']').focus();
//        }
    }
}

function echo(text) {
    console.log(text);
}

function getUserInfo(user_id, event) {
    $.ajax({
            url: '/users/ajax.php',
            data: {
                action: "getUserInfo",
                user_id: user_id
            },
            dataType: "text json",
            type: 'POST',
            success: function(result) {
                showUserInfo(user_id, result.user_info, event);
            }
        }
    );
}

function showUserInfo(id, info, event) {
    var info_block = $(info);

    if (info_block) {
        var row   = $(event.currentTarget);
        if (!row.hasClass('selected')) {
            $('body').append(info_block);

            var coordinates = calcCoordinatesForTooltip(row, info_block);

            row.addClass('selected');

            info_block.css({
                top:  coordinates[0] + "px",
                left: coordinates[1] + "px",
                display: "block"
            })
        }
    }
}

function calcCoordinatesForTooltip(parent_block, info_block) {
    if (parent_block[0].tagName=='TR') {

        var top = parent_block.offset().top,
            info_top = top,
            info_width = info_block.outerWidth(),
            info_height = info_block.outerHeight(),
            col_fio      = $('.user-fio'),
            wrapper        = $('.users.list'),
            border_left  = col_fio.offset().left + col_fio.outerWidth(),
            border_right = wrapper.offset().left + wrapper.outerWidth() - info_width,
            target_left  = event.clientX - (info_width *.3),
            info_left    = Math.max(border_left,Math.min(border_right,target_left));

        if (top < info_height + 10) {
            info_top += parent_block.outerHeight();
        } else
            info_top -= info_block.offset().left();
    } else {
        if (parent_block[0].tagName=='A') {
            var info_top = parent_block.offset().top + parent_block.outerHeight() + 2,
                info_left = parent_block.offset().left + (parent_block.outerWidth() - (info_block.outerWidth()))/2;
        }
    }

    return [info_top,info_left];
}

function gettime() {
    var date, result, ms;

    date = new Date();
    ms = date.getMilliseconds();
    result = ms - tmp;
    tmp = ms;

    return result;
}

function getBurningCounts(repeat){
    $.ajax({
            url: '/ajax.php',
            data: {
                action: "getBurningCounts"
            },
            dataType: "text json",
            type: 'POST',
            success: function(result) {
                updateBurningCounts(result, repeat);
            }
        }
    );
}

function updateBurningCounts(counts, repeat) {
    var sections = $('.section'),
        section_name,
        section,
        notify_number,
        html;

    sections.each(function(){
        section = $(this);
        section_name = section.attr("data-section_name");
        notify_number = section.find('.notify_number');
        if (typeof counts != "undefined" && counts[section_name] > 0) {
                html = "<span class='notify_number'>" + counts[section_name] + "</span>";
                if (notify_number.length > 0) {
                    notify_number.text(counts[section_name]);
                } else section.prepend(html);
        } else notify_number.remove();
    });

    if (repeat) setTimeout("getBurningCounts(true)", 5000);
}
