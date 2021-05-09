<!DOCTYPE html>
<html lang="ja">
<?php
    $room_name = isset($_POST['room-name']) ? $_POST['room-name'] : null;
    ?>

<head>
    <meta http-equiv="content-type" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6"
        crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="../js/videoChatRoom.js"></script>
    <link rel="stylesheet" href="../css/videoChatRoom.css">

    <title>Video Chat Room</title>
</head>

<body>
    <div id="alert"></div>
    <div class="container">

        <div class="d-flex align-items-center p-3 my-3 text-white bg-dark rounded shadow-sm">
            <h1 id="page-title">Video Chat Room <small>SkayWay chat sample</small></h1>
            <h2><?=$room_name?></h2>
            <input type="hidden" id="js-room-id" value="<?=$room_name?>">
        </div>

        <div class="video-massage panel-default border rownded overflow-hidden flex-md-row mb-4 shadow-sm text-white bg-dark">
            <form action="" class="p-5 rounded">
                <pre class="messages" id="js-messages"></pre>
                <input class="form-control" type="text" id="js-local-text" placeholder="message...">
                <input class="btn btn-primary my-2" type="button" value="Submit" id="js-send-trigger">
            </form>
        </div>

        <div class="video-mine panel-default border rownded overflow-hidden flex-md-row mb-4 shadow-sm text-white bg-dark">
            <video id="js-local-stream"></video>
            <input type="button" id="js-leave-trigger" value="Leave">
        </div>

        <div class="video-chat remote-streams panel-default border rownded overflow-hidden flex-md-row mb-4 shadow-sm text-white bg-dark" id="js-remote-streams"> </div>

    </div>
    <p class="meta" id="js-meta"></p>
    <script src="//cdn.webrtc.ecl.ntt.com/skyway-4.4.1.js"></script>
    <script src="../_shared/key.js"></script>
    <script src="../js/videoChatRoom.js"></script>
</body>

</html>