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
};
function enterTargetControl(isGuest) {
    isGuest = (isGuest === undefined ) ? false : isGuest ;
    var el = $('#topmenu-enter') ;
    var a = el.children('a')[0] ;
    a.dataset.target = (isGuest) ? '#enter-form' : '#' ;
} ;
function loginOnClick() {
    //alert('loginOnForm - is here') ;
// проверяем автономный контроль
    var err =false ;
    var arr = $('#login-form .help-block') ;
    for (var i = 0 ; i < arr.length; i++) {
        var item = arr[i] ;
        if ((item.textContent).length > 0 ) {
            err = true ;
            break ;
        }
    }
    if (err) {
        return ;
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
                $('#modal-exit').click() ;      // закрываем окно login-form
            } else {

                $('#enterform-message').empty() ;
                for (var rule in message) {
                    var messageText = message[rule] ;
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


