<?php require_once('../model/config.php'); ?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta http-equiv="content-type" charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6"
        crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript" src="../js/login.js"></script>
    <title id="tab-title">Sign in</title>
</head>

<body class="bg-secondary">
    <div id="alert"></div>
    <div class="container">

        <div class="d-flex align-items-center p-3 my-3 text-white bg-dark rounded shadow-sm">
            <h1 id="page-title">Sign in <small>SkayWay chat sample</small></h1>
        </div>

        <div class="panel-default border rownded overflow-hidden flex-md-row mb-4 shadow-sm text-white bg-dark">

            <form action="../view/showRoom.php" method="POST" class="p-5 rounded" id="send-sign">

                <h1 class="h3 mb-3 fw-normal" id="form-title">Sign in</h1>

                <div class="radio-inline">
                    <label for="radio-sign-in"><input class="form-check-input" type="radio" name="radio_sign" id="radio-sign-in" value="1" checked>Sign in</label>
                    <label for="radio-sign-up"><input class="form-check-input" type="radio" name="radio_sign" id="radio-sign-up" value="2">Sign up</label>
                </div>

                <div class="form-group">
                    <label class="control-label" for="input_name">Name</label>
                    <input class="form-control" id="input_name" name="input_name" type="text" placeholder="Name" require>
                </div>

                <div class="form-group">
                    <label class="control-label" for="input_password">Password</label>
                    <input class="form-control" id="input_password" type="password" placeholder="Password" require>
                </div>
                <input id="action" type="hidden" name="action" value="<?=AUTH_USER?>">
                <input class="btn btn-primary my-2" type="button" value="Send" id="try-sign">
            </form>
        </div>
    </div>
</body>

</html>