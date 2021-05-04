const SIGNIN = "Sign in";
const SIGNUP = "Sign up";

$(function () {

    $('[name="radio_sign"]:radio').change(function () {

        var type = $(this).val();
        if (type == 1) {
            $('#tab-title').text(SIGNIN);
            $('#form-title').text(SIGNIN);
            $('#page-title').replaceWith('<h1 id="page-title">Sign in <small>SkayWay chat sample</small></h1>');
            document.getElementById('action').value = 1;
        } else {
            $('#tab-title').text(SIGNUP);
            $('#form-title').text(SIGNUP);
            $('#page-title').replaceWith('<h1 id="page-title">Sign up <small>SkayWay chat sample</small></h1>');
            document.getElementById('action').value = 2;
        }
    });

    $('#submit').click(function () {
        $.ajax({
            type: "POST",
            url: "../model/dbAction.php",
            dataType: "json",
            data: {
                action: $('#action').val(),
                name: $('#input_name').val(),
                password: $('#input_password').val()
            },

            success: function (data) {
                console.log(data);
                if (data['result']){
                    $('#submit-sign').submit();
                } else {
                    $('#alert').replaceWith('<div class="alert alert-danger" id="alert" role="alert"> ' + data['message'] + ' </div>');
                }
            },

            error: function(data){
                $('#alert').replaceWith('<div class="alert alert-danger" id="alert" role="alert">System Error</div>');
                console.log(data);
            }
        })
    });
});