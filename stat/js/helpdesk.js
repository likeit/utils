function genFilter() {
    var result = {},
        filters = ['status','area','type','category','contractor','performers', 'rate'],
        filters_count = filters.length;

    if ($('input[type=checkbox]:checked').length>0) {
        for (var i=0;i<filters_count;i++) {
            var params=[],
                checked_boxes = $('[data-' + filters[i] + ']:checked');
            checked_boxes.each(function(k){
                params[k] = $(this).attr('data-'+filters[i])
            });

            if (params.length>0)
               result[filters[i]] = params.join(',');
        }
        result = JSON.stringify(result).replace(' ','');
    } else result = "{}";

    return result;
}

function applyFilter() {
    window.location.href = '/helpdesk/?filter=' + genFilter();
}

function loadFilter() {
    var gets = parseGetParams().filter;
    if (typeof gets!="undefined") {
        var filter = JSON.parse(decodeURI(gets));
        for (var props_name in filter) {
            if (filter.hasOwnProperty(props_name)) {
                var props_arr = filter[props_name].split(','),
                    cut_block = $('.cut_block.' + props_name);

//                cut_block.removeClass('cutted');
                cut_block.addClass('filtered');
                cut_block.find('.count').text("(" + props_arr.length + " / " + cut_block.find('input').length + ")");
                for (var i = 0; i < props_arr.length; i++) {
                    var checkbox = $('[data-' + props_name + '="' + props_arr[i] + '"]');
                    checkbox.attr('checked','checked');
                    checkbox.parent().addClass('checked');
                }
            }
        }
    }
}

function resetFilter() {
    var filters = ['status','area','type','category','contractor','performers', 'rate'];

    for (var i=0; i<filters.length; i++) {
        $('[data-' + filters[i] + ']:checked').each(function(){
            $(this).removeAttr('checked');
        });
    }
}

function saveFilter() {
    var filter = genFilter(),
        name,
        global;

    name = prompt("Введите название");
    if (name==null) return;
    if (name=="") {
        alert('Слишком короткое имя');
    return;
    }

    if (name.length>20) {
        alert('Слишком длинное имя');
        return
    }
    if (confirm("Сделать фильтр видимым для вех пользователей?"))
        global = 1;
    else
        global = 0;

    $.ajax({
        url: '/helpdesk/ajax.php',
        data: {
            action: "saveNewFilter",
            name:       name,
            filter:   filter,
            global:   global
        },
        dataType: "text json",
        type: 'POST',
        success: function(result) {
            if (result.success) {
                updateFilter();
                showMsg('success',result.msg);
            } else {
                showMsg('error',result.msg);
            }
        }
    });
}

function updateFilter() {
    $.ajax({
        url: '/helpdesk/ajax.php',
        data: {
            action: "updateFilters"
        },
        dataType: "text json",
        type: 'POST',
        success: function(result) {
            if (result.success) {
                $('.filters_block').html(result.filters_block)
            }
        }
    });
}


function deleteFilter(filter_id) {
    if (confirm('Вы действительно хотите удалить этот фильтр?'))
        $.ajax({
            url: '/helpdesk/ajax.php',
            data: {
                action:     "deleteFilter",
                filter_id:  filter_id
            },
            dataType: "text json",
            type: 'POST',
            success: function(result) {
                updateFilter();
                showMsg('success',result.msg)
            }
        });
}

function getTicketInfo(ticket_id, event) {
    $.ajax({
            url: '/helpdesk/ajax.php',
            data: {
                action: "getTicketInfo",
                ticket_id: ticket_id
            },
            dataType: "text json",
            type: 'POST',
            success: function(result) {
                showTicketInfo(ticket_id, result.ticket_info, event);
//                echo(result);
            }
        }
    );
}

function showTicketInfo(id, info, event) {
    var info_block = $(info);

    $('.ticket_info').remove();

    if (info_block) {
        var row   = $('tr[data-id=' + id + ']');
//        if (!row.hasClass('selected')) {
            $('body').append(info_block);

            var row_top = row.offset().top,
                row_bottom = row_top + row.outerHeight(),
                info_top = row_top,
                info_width = info_block.outerWidth(),
                info_height = info_block.outerHeight(),
                col_title    = row.find('.title a'),
                table        = $('.tickets.list'),
                border_left  = col_title.offset().left,// + col_title.outerWidth(),
                border_right = table.offset().left + table.outerWidth() - info_width,
                target_left  = event.clientX- (info_width *.5),
                info_left    = Math.max(border_left,Math.min(border_right,target_left));

            if (row_bottom + info_height + 10 < window.innerHeight + window.pageYOffset) {
//                echo(row_bottom + info_height + 10 + ' < ' + (window.innerHeight + window.pageYOffset) );
                info_top += row.outerHeight() + 5;
            } else {
//                echo(row_bottom + info_height + 10 + ' > ' + (window.innerHeight + window.pageYOffset) );
                info_top -= info_block.outerHeight() + 5;
            }

//            row.addClass('selected');

            info_block.css({
                top: info_top + "px",
                left: info_left + "px",
                display: "block"
            })
        }
//    }
}

function loadPerformers(){
    var performers = [];
    $('input[data-performer]:checked').each(function(i){
        performers[i] = $(this).attr('data-performer');
    });
    $('input[name=performers]').val(performers.join(','));

}

function addComment() {
    $("#new_comment_block").show();
    $("#add_comment").hide();
}

function cancelAddComment(){
    $("#new_comment_block").hide();
    $("#new_comment_text").val('');
    $("#add_comment").show();
}

function saveComment(hide_autocomments) {
    var ticket_id = $('#ticket_id').val(),
        text = $('#new_comment_text').val();

    $.ajax({
            url: '/helpdesk/ajax.php',
            data: {
                action: "saveNewComment",
                ticket_id: ticket_id,
                text: text
            },
            dataType: "text json",
            type: 'POST',
            success: function(result) {
                if (result.success) {
                    showMsg('success',result.msg);
                    reloadComments(ticket_id, hide_autocomments);
                } else {
                    showMsg('error',result.msg);
                }
            }
        }
    )
}

function reloadComments(ticket_id, hide_autocomments) {
    ticket_id = ticket_id || $('#ticket_id').val();

    $.ajax({
            url: '/helpdesk/ajax.php',
            data: {
                action: "reloadComments",
                ticket_id: ticket_id,
                hide_autocomments: hide_autocomments
            },
            dataType: "text json",
            type: 'POST',
            success: function(result) {
                if (result.success) {
                    $('#comments_block').html(result.comments_block)
                }
            }
        }
    );
}

function rateTicket(ticket, rating) {
    var img, img_src;
    $.ajax({
        url: '/helpdesk/ajax.php',
        data: {
            action: "rateTicket",
            ticket: ticket,
            rating: rating
        },
        dataType: "text json",
        type: 'POST',
        success: function(result) {
            if (result.success) {
                showMsg('success',result.msg);
                $('.ticket_edit_rating img').each(function(index){
                    img = $(this);
                    img_src = img.attr("src")
                    if (rating>index) {
                        img.attr("src", img_src.replace(/0/g,"1"));
                    } else {
                        img.attr("src", img_src.replace(/1/g,"0"));
                    }
                    console.log(index);
                })
            } else showMsg('error',result.msg)
        }
    });
}

function changeTicketStatus(ticket_id, new_status) {
    var img, img_src;
    $.ajax({
        url: '/helpdesk/ajax.php',
        data: {
            action: "changeTicketStatus",
            ticket: ticket_id,
            status: new_status
        },
        dataType: "text json",
        type: 'POST',
        success: function(result) {
            if (result.success) {
                showMsg('success',result.msg);
                img = $('#ticket-status_' + ticket_id + '>img');
                img.attr("src", img.attr("src").replace(/[0-9]/g, new_status));
            } else showMsg('error',result.msg)
        }
    });
}

function setDefaultFilter(filter_id) {
    $.ajax({
        url: '/helpdesk/ajax.php',
        data: {
            action: "setDefaultFilter",
            filter_id: filter_id
        },
        dataType: "text json",
        type: 'POST',
        success: function(result) {
            if (result.success) {
                showMsg('success',result.msg);
                updateFilter();
            } else showMsg('error',result.msg)
        }
    });
}

function compare_weights(a,b){
    return b.weight - a.weight;
}

function updateTags() {
    var tags = [],
        html = '',
        tags_block = $('#popup_tags .tag.active'),
        input_tags = $("#input-tags"),
        tags_string = '';

    tags_block.each(function(){
        var this_tag = $(this);
        tags.push({
            name: this_tag.text(),
            id: this_tag.attr("data-id"),
            weight: parseFloat(this_tag.attr("data-weight"))
        });
    });

    tags = tags.sort(compare_weights);

    for ( var i=0; i < tags.length ; i ++ ) {
        var tag = tags[i];
        html += "<a class='tag active weight_" + Math.round(tag.weight*5) + "' data-weight='" + tag.weight + "'>" + tag.name + "</a>";
        tags_string += ((tags_string.length > 0) ? ",": "") + tag.id;
    }

    if (html.length == 0) html = "<a class=\"tag active\">выбрать метки</a>";
    $('#tags').html(html);
    input_tags.val(tags_string);
}

function addTag() {
    var name = "", weight_text = "" ;

//    while (name = prompt("Введите название метки") == "" )
//        if (name == null) return;

//    prompt(12345,123);
    while (weight === "") {
        weight = parseFloat(prompt("Введите вес метки от 0 до 1)"))
        echo(weight);
        if (!( 0 < weight < 1 )) weight = "";
        if (weight == null) return;
    }

//        name = prompt("Введите вес метки");
}

function changeArea(area) {
    var button = $("#change-area"),
        input  = $("#input-area");

    $(".i-change-area").each(function(){
        var i_this = $(this);

        if (i_this.find('a').attr("data-area") == area) {
            i_this.addClass("current");
            button.text(i_this.find('a').text());
            input.val(area);
        } else {
            i_this.removeClass("current");
        }

    });
}

// Изменить в форме, не сохранять
function changeStatus(status) {
    var button = $("#change-status"),
        input  = $("#input-status"),
        img_path = "/stat/img/helpdesk/status_{{status}}.png".replace("{{status}}",status);

    $(".i-change-status").each(function(){
        var i_this = $(this);

        if (i_this.find('a').attr("data-status") == status) {
            i_this.addClass("current");
            button.find("img").attr("src",img_path);
            input.val(status);
        } else {
            i_this.removeClass("current");
        }
    });
}

function clearDeadline() {
    $('#input-deadline').val('не указан');
    $('.clear-deadline').addClass('hidden')
}