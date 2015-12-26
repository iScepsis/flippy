function authorization(){
    $('.message').fadeOut(300);

    var login = $('input[name="login"]').val(),
        password = $('input[name="password"]').val(),
        url = 'admintools/auth_user/';

    $.post(url,
            {login: login,
             password: password},
             function(data){
                 if (data == 1) {
                     window.location('http://google.ru');
                 } else {
                     $('.message').fadeIn(300);
                 }
             },
             "text");
}