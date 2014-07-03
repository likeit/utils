/**
 * Created with JetBrains PhpStorm.
 * User: vkalinichev
 * Date: 07.04.13
 * Time: 21:48
 */

function replace(id){
    $.ajax({
        url: '/supply/replace.php',
        data: "id={{id}}".replace("{{id}}",id),
        dataType: 'text',
        type: 'POST',
        success: function(msg) { refreshPage(msg.split(',')) }
    })
}

function refreshPage(msg) {
    window.location.href = window.location.origin + window.location.pathname + "?msg_class=" + msg[0] + "&msg=" + msg[1];
}
