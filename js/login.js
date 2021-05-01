const SIGNIN = "Sign in";
const SIGNUP = "Sign up";

$(function () {
    $('[name="radio_sign"]:radio').change(function () {
        var type = $(this).val();
        if (type == 1) {
            $('#tab-title').text(SIGNIN);
            $('#form-title').text(SIGNIN);
            $('#page-title').replaceWith('<h1 id="page-title">Sign in <small>SkayWay chat sample</small></h1>');
        } else {
            $('#tab-title').text(SIGNUP);
            $('#form-title').text(SIGNUP);
            $('#page-title').replaceWith('<h1 id="page-title">Sign up <small>SkayWay chat sample</small></h1>');
        }
    });

    $('#submit').click(function () {
        var type = $('#radio_sign').val();

        $.ajax({
            url: (type == 1) ? "../model/authUser.php" : "../model/instUser.php",
            type: "POST",
            dataType: JSON,
            data: {
                'name': $('#input_name').val(),
                'password': $('#input_password').val()
            },
        })
            .done(function (data) {
                if (data[0].result)
                    window.location.href = '../view/showRoom.php';
                else {
                    // $('#alert').replaceWith('<div class="alert alert-danger">Auth failure.</div>');
                    $('#alert').text("A");
                }
            })
            .fail(function (data) {
                // $('#alert').replaceWith('<div class="alert alert-danger">Connection failure.</div>');
                $('#alert').text("B");
            })
    });
});