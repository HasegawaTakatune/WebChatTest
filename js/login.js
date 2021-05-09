const SIGNIN = "Sign in";
const SIGNUP = "Sign up";

$(function () {

    $('[name="radio_sign"]:radio').change(function () {
        var type = $(this).val();
        if (type == 1) {
            $('#tab-title').text(SIGNIN);
            $('#form-title').text(SIGNIN);
            $('#page-title').replaceWith('<h1 id="page-title">Sign in <small>SkayWay chat sample</small></h1>');
            document.getElementById('#action').value = 1;
        } else {
            $('#tab-title').text(SIGNUP);
            $('#form-title').text(SIGNUP);
            $('#page-title').replaceWith('<h1 id="page-title">Sign up <small>SkayWay chat sample</small></h1>');
            document.getElementById('#action').value = 2;
        }
    });

    $('#try-sign').click(function () {
        $.ajax({
            type: "POST",
            url: "../model/dbAction.php",
            dataType: "json",
            data: {
                action: $('#action').val(),
                name: $('#input_name').val(),
                password: $('#input_password').val()
            },
        }).done(function (data) {
            console.log(data);
            if (data['result']) document.querySelector('#send-sign').submit();
            else $('#alert').replaceWith('<div class="alert alert-danger" id="alert" role="alert"> ' + data['message'] + ' </div>');

        }).fail(function (msg, XMLHttpRequest, textStatus, errorThrown) {
            $('#alert').replaceWith('<div class="alert alert-danger" id="alert" role="alert"> ' + msg + ' </div>');
            console.log(XMLHttpRequest);
            console.log(textStatus);
            console.log(errorThrown);
        })
    });
});