function wdOnClick(wdId) {
    //alert('I\'m here.Enter. wdId :' + wdId) ;
    $.ajax({
        url: 'index.php?r=site%2Fwork-direct-get',
        data: {wdid: wdId},
        type: 'POST',
        success: function (res) {
            //alert('I\'m here. success. wdId :' + wdId) ;
            var rr = JSON.parse(res);
            var title = rr['title'];
            var content = rr['content'];
            $('#wd-modal-title').empty();
            $('#wd-modal-title').append(title);
            $('#wd-modal-insert').empty();
            $('#wd-modal-insert').append(content);

//            console.log(res);
        },
        error: function () {
            alert('Error!');
        }
    });
}
function enterTargetControl(isGuest) {
    isGuest = (isGuest === undefined ) ? false : isGuest;
    var el = $('#topmenu-enter');
    var cl  = $('#topmenu-enter')[0].className ;
    isGuest = (cl === 'enable') ;
    var a = el.children('a')[0];
    a.dataset.target = (isGuest) ? '#enter-form' : '#';
// для кнопки registration тоже самое
    el = $('#topmenu-registration');
    a = el.children('a')[0];
    a.dataset.target = (isGuest) ? '#registration-form' : '#';

}

function logoutOnClick(isGuest,guestName) {
    //isGuest = (isGuest === undefined ) ? false : isGuest;
    //if (isGuest) {
    //    return ;
    //}
    $.ajax({
        url: 'index.php?r=site%2Flogout',
        data: '',
        type: 'POST',
        success: function (res) {
            //alert('I\'m here. success. wdId :' + wdId) ;
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
// переопределяем доступ ***
//            console.log(res);
        },
        //error: function () {
        //    alert('Error!');
        //}

        error: function (event, XMLHttpRequest, ajaxOptions, thrownError) {
            var responseText = event.responseText; // html - page


        }
    });

}


function loginOnClick() {
    //alert('loginOnForm - is here') ;
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
    $('#login-form [name="form-messages"]').empty() ;
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
            //alert('I\'m here. success. wdId :' + wdId) ;
            var rr = JSON.parse(res);
            var success = rr['success'];
            var message = rr['message'];
            if (rr['success'] === true) {
                $('#topmenu-logout').removeAttr('hidden') ;
                $('#topmenu-logout')[0].className = 'enable';
                $('#topmenu-enter').attr('hidden','hidden') ;
                $('#topmenu-registration').attr('hidden','hidden') ;
                $('#topmenu-forum')[0].className = 'enable';
                //$('#topmenu-enter')[0].className = 'disabled';
                //$('#topmenu-registration')[0].className = 'disabled';
                $('#topmenu-profile')[0].className = 'disable';
                $('#topmenu-office')[0].className = 'disable';
                $('#topmenu-username').text(userName);

                profileOnClick(1) ;



                $('#modal-exit').click();      // закрываем окно login-form
            } else {

                $('#login-form [name="form-messages"]').empty() ;
                for (var rule in message) {
                    var messageText = message[rule];
                    for (var i = 0; i < messageText.length; i++) {
                        $('#login-form [name="form-messages"]').append(messageText[i] + '<br>');
                    }
                }
            }
// переопределяем доступ ***
//            console.log(res);
        },
        //error: function () {
        //    alert('Error!');
        //}

        error: function (event, XMLHttpRequest, ajaxOptions, thrownError) {
            var responseText = event.responseText; // html - page


        }
    });
}
$('#userregistration-enterpassword_repeat').on('blur',function() {
    $('#userregistration-enterpassword').blur() ;
}) ;
function registrationOnClick() {
    //alert('loginOnForm - is here') ;
// проверяем автономный контроль

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
    $('#registration-form [name="form-messages"]').empty() ;
    $.ajax({
        url: 'index.php?r=user%2Fregistration',
        data: data,
        type: 'POST',
        success: function (res) {
            //alert('I\'m here. success. wdId :' + wdId) ;
            var rr = JSON.parse(res);
            var success = rr['success'];
            var message = rr['message'];
            if (rr['successUser'] === true) {
                $('#topmenu-logout').removeAttr('hidden') ;
                $('#topmenu-enter').attr('hidden','hidden') ;
                $('#topmenu-registration').attr('hidden','hidden') ;
                $('#topmenu-forum')[0].className = 'enable';

                $('#topmenu-forum')[0].className = 'enable';
                $('#topmenu-profile')[0].className = 'enable';
                $('#topmenu-office')[0].className = 'enable';
                $('#topmenu-username').text(userName);

                //$('#modal-exit').click();      // закрываем окно login-form
                $('#userregistration-username').attr('readonly','readonly');
                $('#userregistration-enterpassword').attr('readonly','readonly');
                $('#userregistration-enterpassword_repeat').attr('readonly','readonly');

                $('#registration-form [name="form-messages"]').append('Пользователь занесён в базу.<br>');
            }
            if ('successProfile') {
                imgFilePath = $('#avatar-img').attr('src');
                if (imgFilePath.length > 0) {
                    $('#topmenu-avatar').attr('src', imgFilePath);
                }
            }


            if (!success) {

                for (var rule in message) {
                    var messageText = message[rule];
                    for (var i = 0; i < messageText.length; i++) {
                        $('#registration-form [name="form-messages"]').append(messageText[i] + '<br>');
                    }
                }
            }
        },
        error: function (event, XMLHttpRequest, ajaxOptions, thrownError) {
            var responseText = event.responseText; // html - page


        }
    });

}

function profileOnClick(restorePrevious) {
    //alert('loginOnForm - is here') ;
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
            //alert('I\'m here. success. wdId :' + wdId) ;
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
 *
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


