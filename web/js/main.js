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
    var a = el.children('a')[0];
    a.dataset.target = (isGuest) ? '#enter-form' : '#';
// для кнопки registration тоже самое
    el = $('#topmenu-registration');
    a = el.children('a')[0];
    a.dataset.target = (isGuest) ? '#registration-form' : '#';

};
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
                $('#topmenu-forum')[0].className = 'enable';
                $('#topmenu-enter')[0].className = 'disabled';
                $('#topmenu-registration')[0].className = 'disabled';
                $('#topmenu-profile')[0].className = 'enable';
                $('#topmenu-office')[0].className = 'enable';
                $('#topmenu-username').text(userName);
                $('#modal-exit').click();      // закрываем окно login-form
            } else {

                $('#enterform-message').empty();
                for (var rule in message) {
                    var messageText = message[rule];
                    for (var i = 0; i < messageText.length; i++) {
                        $('#enterform-message').append(messageText[i] + '<br>');
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
            "info" : info
        }
    };
    $.ajax({
        url: 'index.php?r=user%2Fregistration',
        data: data,
        type: 'POST',
        success: function (res) {
            //alert('I\'m here. success. wdId :' + wdId) ;
            var rr = JSON.parse(res);
            var success = rr['success'];
            var message = rr['message'];
            if (rr['success'] === true) {
                $('#topmenu-forum')[0].className = 'enable';
                $('#topmenu-enter')[0].className = 'disabled';
                $('#topmenu-registration')[0].className = 'disabled';
                $('#topmenu-profile')[0].className = 'enable';
                $('#topmenu-office')[0].className = 'enable';
                $('#topmenu-username').text(userName);
                //$('#modal-exit').click();      // закрываем окно login-form
                $('#userregistration-message').empty();
                $('#userregistration-message').append('<strong>-----oK!------</strong>');
            } else {

                $('#userregistration-message').empty();
                for (var rule in message) {
                    var messageText = message[rule];
                    for (var i = 0; i < messageText.length; i++) {
                        $('#userregistration-message').append(messageText[i] + '<br>');
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
function uploadOnClick() {
    var imgFile = $('#uploadform-imagefile').val() ;
    if (imgFile.length == 0) {               // файл не выбран
        return ;
    }
    //var fData = new FormData($('#upload-form')[0]) ;
    //console.log(fData) ;
    //var file_data = $('#uploadform-imagefile').prop('files')[0];
    //var form_data = new FormData();
    //form_data.append('file', file_data);
    //var csrf = $('#upload-form [name="_csrf"]') ;
    //var csrfValue = csrf[0].value ;
    //var data = {
    //    "_csrf" : csrfValue,
    //    "formData" : form_data ,
    //    "UploadForm" : {
    //        "imageFile" : ""
    //    }
    //} ;
    //$.ajax({
    //    url: 'index.php?r=site%2Fupload',
    //    data: data ,
    //    dataType: 'text',  // what to expect back from the PHP script, if anything
    //    cache: false,
    //    contentType: false,
    //    processData: false,
    //    type: 'POST',
    //    success: function(php_script_response){
    //        alert(php_script_response); // display response from the PHP script, if any
    //    }
    //});

    var formData = new FormData($('#upload-form')[0]);
    console.log(formData);
    $.ajax({
        url: 'index.php?r=site%2Fupload',
        type: 'POST',

        // Form data
        data: formData,

        //beforeSend: beforeSendHandler, // its a function which you have to define

        success: function(response) {
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








    //$.ajax({
    //    url: 'upload.php', // point to server-side PHP script
    //    dataType: 'text',  // what to expect back from the PHP script, if anything
    //    cache: false,
    //    contentType: false,
    //    processData: false,
    //    data: form_data,
    //    type: 'post',
    //    success: function(php_script_response){
    //        alert(php_script_response); // display response from the PHP script, if any
    //    }
    //});
}
function uploadOnClick____() {
    var imgFile = $('#uploadform-imagefile').val() ;
    if (imgFile.length == 0) {               // файл не выбран
        return ;
    }
    var formData = new FormData($('form')[0]);
    console.log(formData);
    //var form = $('.wpc_contact').serialize();
    //var FormData = new FormData($(form)[1]);

    //var form = $('#upload-form').serialize();
    //var FormData = new FormData($(form)[1]);
    //console.log(formData);
    //$.ajax({
    //    url: "some_php_file.php",  //Server script to process data
    //    type: 'POST',
    //
    //    // Form data
    //    data: formData,
    //
    //    beforeSend: beforeSendHandler, // its a function which you have to define
    //
    //    success: function(response) {
    //        console.log(response);
    //    },
    //
    //    error: function(){
    //        alert('ERROR at PHP side!!');
    //    },
    //
    //
    //    //Options to tell jQuery not to process data or worry about content-type.
    //    cache: false,
    //    contentType: false,
    //    processData: false
    //});

    var csrf = $('#upload-form [name="_csrf"]') ;
    var csrfValue = csrf[0].value ;
    var data = {
        "_csrf" : csrfValue,
        "formData" : formData ,
        "UploadForm" : {
            "imageFile" : ""
        }
    } ;
    $.ajax({
        url: 'index.php?r=site%2Fupload',
        data: data ,
        type: 'POST',
        success: function (res) {
            //alert('I\'m here. success. wdId :' + wdId) ;
            var rr = JSON.parse(res);
            var success = rr['success'];
            var message = rr['message'];
            if (rr['success'] === true) {
            } else {
                $('#userregistration-message').empty();
                for (var rule in message) {
                    var messageText = message[rule];
                    for (var i = 0; i < messageText.length; i++) {
                        $('#userregistration-message').append(messageText[i] + '<br>');
                    }
                }
            }
        },
        error: function (event, XMLHttpRequest, ajaxOptions, thrownError) {
            var responseText = event.responseText; // html - page


        }
    });
}


