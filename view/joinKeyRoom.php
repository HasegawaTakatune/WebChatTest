<?php require_once('../model/dbAction.php');?>
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
    <script type="text/javascript" src="../js/joinKeyRoom.js"></script>
    <title>Join Key Room</title>
</head>

<body class="bg-secondary">
    <div id="alert"></div>
    <div class="container">

        <div class="d-flex align-items-center p-3 my-3 text-white bg-dark rounded shadow-sm">
            <h1>Join Key Room <small>SkayWay chat sample</small></h1>
        </div>

        <div class="panel-default border rownded overflow-hidden flex-md-row mb-4 shadow-sm text-white bg-dark">

            <form action="../view/room.php" method="POST" class="p-5 rounded" id="submit-sign">

                <h1 class="h3 mb-3 fw-normal" id="form-title">Room key</h1>

                <div class="form-group">
                    <label class="control-label" for="input_name">Name</label>
                    <input class="form-control" id="input_name" name="room-name" type="text" placeholder="Name" require disabled>
                </div>

                <div class="form-group">
                    <label class="control-label" for="input_key">key</label>
                    <input class="form-control" id="input_key" type="text" placeholder="key">
                </div>
                <input id="action" type="hidden" value="<?=JOIN_KEY_ROOM?>">
                <input class="btn btn-primary my-2" type="button" value="Submit" id="submit">
            </form>
        </div>
    </div>
</body>

</html>