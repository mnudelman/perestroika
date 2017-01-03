/**
 * описание направления работ.
 * контент получается из контроллера site/workDirectGet
 * вывод в модальное окно
 * @param wdId - ид направления работ
 */
function wdOnClick(wdId) {
    var titleBlock = $('#wd-description [name="modal-title"]') ;
    var contentBlock = $('#wd-description [name="modal-content"]') ;

    $.ajax({
        url: 'index.php?r=site%2Fwork-direct-get',
        data: {wdid: wdId},
        type: 'POST',
        success: function (res) {
            var rr = JSON.parse(res);
            var title = rr['title'];
            var content = rr['content'];
            titleBlock.empty();
            titleBlock.append(title);
            contentBlock.empty();
            contentBlock.append(content);
        },
        error: function () {
            alert('Error!');
        }
    });
}
/**
 * определяет доступность пунктов главного меню,
 * открывает/зарывает возможность вывода форм :
 * подключения(login), регистрации(registration), редактир профиля(profile)
 * критерием является роль пользователя : гость(guest) | пользователь(user)
 * вызывается по onclick перед вызовом формы
 * определяется по состоянию эл-та списка - пункта меню "войти" (login)
 * если className = "enable" - значит пользователь-гость
 * @param isGuest
 */
function enterTargetControl(isGuest) {
    isGuest = (isGuest === undefined ) ? false : isGuest;
    var el = $('#topmenu-enter');
    var cl  = el[0].className ;
    isGuest = (cl === 'enable') ;
    var a = el.children('a')[0];
    a.dataset.target = (isGuest) ? '#enter-form' : '#';
// для кнопки registration тоже самое
    el = $('#topmenu-registration');
    a = el.children('a')[0];
    a.dataset.target = (isGuest) ? '#registration-form' : '#';
// для формы регистрации, попутно, открыть возможность редактирования
    if (isGuest) {   // очиститть поля от пред использования
        $('#userregistration-username').removeAttr('readonly');
        $('#userregistration-enterpassword').removeAttr('readonly');
        $('#userregistration-enterpassword_repeat').removeAttr('readonly');
        $('#registration-form [name="form-messages-success"]').empty() ;
        $('#registration-form [name="form-messages-error"]').empty() ;
    }
}

/**
 * отключить текущего пользователя от сайта
 * после этого сайт открыт для нового подключения/регистрации
 * * @param isGuest
 * @param guestName - имя пользователя - гость
 */
function logoutOnClick(isGuest,guestName) {
    $.ajax({
        url: 'index.php?r=site%2Flogout',
        data: '',
        type: 'POST',
        success: function (res) {
            var rr = JSON.parse(res);
            var success = rr['success'];
            var message = rr['message'];
            if (rr['success'] === true) {
                $('#topmenu-logout').attr('hidden','hidden') ;
                $('#topmenu-enter').removeAttr('hidden') ;
                $('#topmenu-registration').removeAttr('hidden') ;
                $('#topmenu-forum')[0].className = 'disabled';
                $('#topmenu-enter')[0].className = 'enable';
                $('#topmenu-registration')[0].className = 'enable';
                $('#topmenu-profile')[0].className = 'disabled';
                $('#topmenu-office')[0].className = 'disabled';
                $('#topmenu-username').text(guestName);
                $('#topmenu-avatar').attr('src', 'images/avatars/people.png');
            } else {
                    var a = 1 ;
                }
        },
        error: function (event, XMLHttpRequest, ajaxOptions, thrownError) {
            var responseText = event.responseText; // html - page
        }
    });
}

/**
 * отправить данные для login
 */
function loginOnClick() {
// проверяем автономный контроль
    var err = false;
    var arr = $('#login-form .help-block');
    for (var i = 0; i < arr.length; i++) {
        var item = arr[i];
        if ((item.textContent).length > 0) {
            err = true;
            break;
        }
    }
    if (err) {
        return;
    }

    var userName = $('#loginform-username').val();
    var password = $('#loginform-password').val();
    var data = {
        "LoginForm": {
            "username": userName,
            "password": password
        }
    };
    $('#login-form [name="form-messages-success"]').empty() ;
    $('#login-form [name="form-messages-error"]').empty() ;
    $.ajax({
        url: 'index.php?r=site%2Flogin',
        data: {
            LoginForm: {
                username: userName,
                password: password
            }
        },
        type: 'POST',
        success: function (res) {
            var rr = JSON.parse(res);
            var success = rr['success'];
            var message = rr['message'];
            if (rr['success'] === true) {
                $('#topmenu-logout').removeAttr('hidden') ;
                $('#topmenu-logout')[0].className = 'enable';
                $('#topmenu-enter').attr('hidden','hidden') ;
                $('#topmenu-registration').attr('hidden','hidden') ;
                $('#topmenu-forum')[0].className = 'enable';
                $('#topmenu-profile')[0].className = 'disable';
                $('#topmenu-office')[0].className = 'disable';
                $('#topmenu-username').text(userName);
                var avatar = rr['avatar'] ;
                if (avatar.length > 0) {
                    var avatarPath = 'images/avatars/' + avatar ;
                    $('#topmenu-avatar').attr('src', avatarPath);
                }
                $('#enter-form').modal('hide') ;     // закрыть форму
            } else {

                for (var rule in message) {
                    var messageText = message[rule];
                    for (var i = 0; i < messageText.length; i++) {
                        $('#login-form [name="form-messages-error"]').append(messageText[i] + '<br>');
                    }
                }
            }
        },
        error: function (event, XMLHttpRequest, ajaxOptions, thrownError) {
            var responseText = event.responseText; // html - page
        }
    });
}
/**
 * при регистрации требуется "возврат" в поле password для
 * проверки совпадения с полем "повторного ввода пароля"
 * если этого не делать остаётся сообщение о несовпадении полей
 */
$('#userregistration-enterpassword_repeat').on('blur',function() {
    $('#userregistration-enterpassword').blur() ;
}) ;
/**
 * отправить данные регистрации
 * данные непосредственно регистрации (username, password) и профиля (email,...)
 * проверяются отдельно.
 * Возможна ситуация, когда регистрация прошла, а вданных профиля есть ошибки,
 * в этом случае пола username, password блокируются от последующих изменеий(readonly)
 */
function registrationOnClick() {
// собщения автономного контроля
    var err = false;
    var arr = $('#registration-form .help-block');
    for (var i = 0; i < arr.length; i++) {
        var item = arr[i];
        if ((item.textContent).length > 0) {
            err = true;
            break;
        }
    }
    if (err) {
        return;
    }

    var userName = $('#userregistration-username').val();
    var password = $('#userregistration-enterpassword').val();
    var password_repeat = $('#userregistration-enterpassword_repeat').val();
    var email = $('#userprofile-email').val();
    var site = $('#userprofile-site').val();
    var tel =  $('#userprofile-tel').val();
    var company = $('#userprofile-company').val();
    var info = $('#userprofile-info').val();

    imgFile = '' ;
    var imgFilePath = $('#avatar-img').attr('src');
    if (imgFilePath.length > 0) {
        var aa =  imgFilePath.split('/') ;
        var imgFile = aa[aa.length - 1] ;
    }

    var data = {
        "UserRegistration": {
            "username": userName,
            "enterPassword": password,
            'enterPassword_repeat' : password_repeat
        },
        "UserProfile" : {
            "email" : email,
            "site" : site,
            "tel" : tel,
            "company" : company ,
            "info" : info,
            "avatar" : imgFile
        }
    };
    $('#registration-form [name="form-messages-success"]').empty() ;
    $('#registration-form [name="form-messages-error"]').empty() ;
    $.ajax({
        url: 'index.php?r=user%2Fregistration',
        data: data,
        type: 'POST',
        success: function (res) {
            //alert('I\'m here. success. wdId :' + wdId) ;
            var rr = JSON.parse(res);
            var success = rr['success'];
            var message = rr['message'];
            if (rr['successUser'] === true) {               // регистрация выполнена
                $('#topmenu-logout').removeAttr('hidden') ;
                $('#topmenu-logout')[0].className = 'enable';
                $('#topmenu-enter').attr('hidden','hidden') ;
                $('#topmenu-registration').attr('hidden','hidden') ;
                $('#topmenu-forum')[0].className = 'enable';

                $('#topmenu-forum')[0].className = 'enable';
                $('#topmenu-profile')[0].className = 'enable';
                $('#topmenu-office')[0].className = 'enable';
                $('#topmenu-username').text(userName);

                $('#userregistration-username').attr('readonly','readonly');
                $('#userregistration-enterpassword').attr('readonly','readonly');
                $('#userregistration-enterpassword_repeat').attr('readonly','readonly');

                $('#registration-form [name="form-messages-success"]').
                    append(rr['messageRegistration'] + '<br>');
            }else {
                $('#registration-form [name="form-messages-error"]').
                    append(rr['messageRegistration'] + '<br>');
            }
            if (rr['successProfile']) {                     // данные профиля сохранены
                imgFilePath = $('#avatar-img').attr('src');
                if (imgFilePath.length > 0) {
                    $('#topmenu-avatar').attr('src', imgFilePath);
                }
                $('#registration-form [name="form-messages-success"]').
                    append(rr['messageProfile'] + '<br>');

            }else {
                $('#registration-form [name="form-messages-error"]').
                    append(rr['messageProfile'] + '<br>');

            }


            if (!success) {

                for (var rule in message) {
                    var messageText = message[rule];
                    for (var i = 0; i < messageText.length; i++) {
                        $('#registration-form [name="form-messages-error"]').append(messageText[i] + '<br>');
                    }
                }
            }
        },
        error: function (event, XMLHttpRequest, ajaxOptions, thrownError) {
            var responseText = event.responseText; // html - page


        }
    });

}
/**
 * отправить данные редактирования профиля
 * @param restorePrevious - восстанвить последние сохранённые значения профиля
 */
function profileOnClick(restorePrevious) {
// проверяем автономный контроль
    restorePrevious = (restorePrevious === undefined ) ? false : restorePrevious ;
    if (!restorePrevious) {
        var err = false;
        var arr = $('#profile-form .help-block');
        for (var i = 0; i < arr.length; i++) {
            var item = arr[i];
            if ((item.textContent).length > 0) {
                err = true;
                break;
            }
        }
        if (err) {
            return;
        }

    }
    var email = $('#profile-form [name="UserProfile[email]"]').val() ;
    var site = $('#profile-form [name="UserProfile[site]"]').val() ;
    var tel =  $('#profile-form [name="UserProfile[tel]"]').val() ;
    var company = $('#profile-form [name="UserProfile[company]"]').val() ;
    var info = $('#profile-form [name="UserProfile[info]"]').val() ;

    imgFile = '' ;
    var imgFilePath = $('#profile-avatar-img').attr('src');
    if (imgFilePath.length > 0) {
        var aa =  imgFilePath.split('/') ;
        var imgFile = aa[aa.length - 1] ;
    }
    var opcod = (restorePrevious) ? 'get' : 'save' ;
    var data = {
        opcod : opcod,
         "UserProfile" : {
            "email" : email,
            "site" : site,
            "tel" : tel,
            "company" : company ,
            "info" : info,
            "avatar" : imgFile
        }
    };
    $('#profile-form [name="form-messages"]').empty();
    $.ajax({
        url: 'index.php?r=user%2Fprofile',
        data: data,
        type: 'POST',
        success: function (res) {
            var rr = JSON.parse(res);
            opcod = rr['opcod'] ;
            if (opcod === 'get') {
                var attr = rr['oldAttributes'] ;
                $('#profile-form [name="UserProfile[email]"]').val(attr['email']) ;
                $('#profile-form [name="UserProfile[site]"]').val(attr['site']) ;
                $('#profile-form [name="UserProfile[tel]"]').val(attr['tel']) ;
                $('#profile-form [name="UserProfile[company]"]').val(attr['company']) ;
                $('#profile-form [name="UserProfile[info]"]').val(attr['info']) ;
                imgFile = attr['avatar'] ;
                $('#profile-avatar-img').attr('src','images/avatars/' + imgFile) ;
            }
            var success = rr['success'];
            var message = rr['message'];
            if (rr['success'] === true) {
                if (opcod !== 'get') {
                    $('#topmenu-avatar').attr('src', imgFilePath);
                    $('#profile-form [name="form-messages"]').empty();
                    $('#profile-form [name="form-messages"]').append('<strong>-----oK!------</strong>');
                }
            } else {

                $('#profile-form [name="form-messages"]').empty();
                for (var rule in message) {
                    var messageText = message[rule];
                    for (var i = 0; i < messageText.length; i++) {
                        $('#profile-form [name="form-messages"]').append(messageText[i] + '<br>');
                    }
                }
            }
        },
        error: function (event, XMLHttpRequest, ajaxOptions, thrownError) {
            var responseText = event.responseText; // html - page


        }
    });

}
/**
 * загрузить изображение на сайт
 * @param uploadFormId - форма для загрузки изображения
 * @param urlUpload    - контроллер, обрабатывающий запрос на файл-изображение
 * @param avatarImgId  - ид элемента-изображения на странице
 */
function uploadOnClick(uploadFormId,urlUpload ,avatarImgId) {
    var imgFile = $('#'+uploadFormId+' [type="file"').val() ;
    if (imgFile.length == 0) {               // файл не выбран
        return ;
    }
    var formData = new FormData($('#' + uploadFormId)[0]);
    //url: 'index.php?r=site%2Fupload',
    $.ajax({
        url: urlUpload,
        type: 'POST',
        // Form data
        data: formData,
        //beforeSend: beforeSendHandler, // its a function which you have to define
        success: function(response) {
            var rr =JSON.parse(response) ;
            var newImg = rr['uploadedPath'] ;
            $('#' + avatarImgId).attr('src',newImg) ;

            console.log(response);
        },
        error: function (event, XMLHttpRequest, ajaxOptions, thrownError) {
            var responseText = event.responseText; // html - page
        },

        //Options to tell jQuery not to process data or worry about content-type.
        cache: false,
        contentType: false,
        processData: false
    });
}


