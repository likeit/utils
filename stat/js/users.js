function translite(str){
    var arr={
        'а':'a', 'б':'b', 'в':'v', 'г':'g', 'д':'d', 'е':'e', 'ж':'g', 'з':'z', 'и':'i', 'й':'y', 'к':'k', 'л':'l',
        'м':'m', 'н':'n', 'о':'o', 'п':'p', 'р':'r', 'с':'s', 'т':'t', 'у':'u', 'ф':'f', 'ы':'i', 'э':'e', 'А':'A',
        'Б':'B', 'В':'V', 'Г':'G', 'Д':'D', 'Е':'E', 'Ж':'G', 'З':'Z', 'И':'I', 'Й':'Y', 'К':'K', 'Л':'L', 'М':'M',
        'Н':'N', 'О':'O', 'П':'P', 'Р':'R', 'С':'S', 'Т':'T', 'У':'U', 'Ф':'F', 'Ы':'I', 'Э':'E', 'ё':'e', 'х':'h',
        'ц':'ts', 'ч':'ch', 'ш':'sh', 'щ':'sch', 'ъ':'', 'ь':'', 'ю':'u', 'я':'ya', 'Ё':'E', 'Х':'H', 'Ц':'TS',
        'Ч':'CH', 'Ш':'SH', 'Щ':'SCH', 'Ъ':'', 'Ь':'',	'Ю':'U', 'Я':'YA'};
    var replacer=function(a){return arr[a]};
    return str.replace(/[А-яёЁ]/g,replacer)
}

function genLogin(lastname, firstname){
    return (translite(firstname)[0] + translite(lastname)).toLowerCase();
}

function genLoginAE(lastname, firstname, middlename) {
    return (firstname[0]+middlename[0]+lastname).replace(/[ё]/g,"е").toUpperCase()
}

function genEmail(login) {
    return login + '@autoexpres.ru';
}

function rand(min, max) {
    return Math.round(min+Math.random()*(max-min));
}

function genPass(length, digits) {
    var d = '0123456789';
    var v = 'aeiouy';
    var c = 'bcdfghjklmnpqrstvwxz';
    var pass = '';

    if (digits==undefined) digits=0;

    for (var i=0;i<length;i++) {
        if (i<(length-digits)) {
            if (i%2==0) {
                pass += c[rand(0, c.length-1)];
                if (i==0) pass = pass.toUpperCase();
            } else {
                pass += v[rand(0, v.length-1)]
            }
        } else {
            pass += d[rand(0, d.length-1)]
        }
    }

    return pass;
}

function getTel(area, dept){
    $.ajax({
        url: '/users/ajax.php',
        data: {
            action: "getTel",
            area:   area,
            dept:   dept
        },
        dataType: "text json",
        type: 'POST',
        success: function(result) { genTel(result) }
    });
}

function genTel(data) {
    if (data.success) $('#user_phone').val(data.tel)
    else showMessage($('.msg'),'error', data.msg)
}

function getPosts(dept){
    $.ajax({
        url: '/users/ajax.php',
        data: {
            action: "getSiblingPosts",
            dept:   dept
        },
        dataType: "text json",
        type: 'POST',
        success: function(result) {
            var page = "<option value='0'>-- Не указано --</option>\n";
            if (dept>0)
                forEach(result.posts, function(id, name) {
                    page += "<option value='" + id + "'>" + name + "</option>\n"
                });
            $('#user_post').html(page);
        }
    });
}

function uploadPhoto(){
    var file = document.getElementById('photo_file').files[0];
    var reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = loadPhoto;
    reader.onloadend = console.log('Загружен');
}

function loadPhoto(event) {
    var user_id  = parseGetParams()['uid'];
    var photo    = event.target.result;
    var fileName = document.getElementById('photo_file').files[0].name;
    var fileExt  = getFileExt(fileName);
    $.ajax({
            url: '/users/ajax.php',
            data: {
                action: "upload_foto",
                user_id: user_id,
                file_ext: fileExt,
                photo: photo
            },
            dataType: "text json",
            type: 'POST',
            success: function(result) {
//                        console.log(result)
                        if (result.success) {
                            $('#user-photo').attr('src',photo)
                            if (!$('div').is('#user-photo-delete')) {
                                var x_button = "<div id='user-photo-delete'><a title='Удалить'><img src='/stat/img/small_close.gif' alt='x'/></a></div>";
                                $(x_button).insertAfter('#user-photo');
                            }
                            $('#add_photo_button').text('Заменить');
                            $('#user-photo-delete').click(function(){
                                deletePhoto();
                            });
                        }
            }
    }
    );
}

function deletePhoto() {
    if (confirm('Вы уверены. что хотите удалить это фото?')) {
        var user_id  = parseGetParams()['uid'];
        $.ajax({
                url: '/users/ajax.php',
                data: {
                    action: "delete_foto",
                    user_id: user_id
                },
                dataType: "text json",
                type: 'POST',
                success:function(result) {
                    if (result.success) {
                        $('#user-photo-delete').remove();
                        $('#user-photo').attr('src', './photos/no_photo.jpg');
                        $('#add_photo_button').text('Загрузить');
                        console.log('Успешно удалено!')
                    }
                }
            }
        );
    }
}

function genUserPass() {
    $('#user_pass').val(genPass(8,2));
}

function genUserLoginAE() {
    $('#user_login_ae').val(genLoginAE($('#user_lastname').val(),$('#user_firstname').val(),$('#user_middlename').val()));
}

function genUserLogin() {
    $('#user_login').val(genLogin($('#user_lastname').val(),$('#user_firstname').val()));
}

function genUserEmail() {
    $('#user_email').val(genEmail($('#user_login').val()));
}

function genUserTel() {
    var area = $('#user_area').val();
    var dept = $('#user_dept').val();
    getTel(area, dept);
}

