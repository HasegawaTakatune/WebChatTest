<?php
  require_once('../model/config.php');

  session_start();
  $user = isset($_POST['name']) ? $_POST['name'] : '';
  $_SESSION['name'] = $user;
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta http-equiv="content-type" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6"
        crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="../js/showRoom.js"></script>
    <link rel="stylesheet" href="../css/showRoom.css">

    <title>Show room</title>
</head>

<body class="bg-secondary">
    <div id="alert"></div>

    <div class="page-header">
        <h1 id="page-title">Room controller <small>SkayWay chat sample</small></h1>
    </div>

    <div class="container room-views">

        <div class="room-find panel-default border rownded overflow-hidden flex-md-row mb-4 shadow-sm text-white bg-dark">
            <h1 class="h3 mb-3 fw-normal">Room list</h1>

            <!-- <form action="" method="POST" class="p-5 rounded"> -->

                <input class="btn btn-primary my-2" type="button" value="find" id="find-room">
                <input type="hidden" name="action" id="action" value="<?=SLCT_ROOM?>">
                <div class="wrapper-find-room">
                    <div class="find-room-contents">
                        <table id="room_table">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th></th>
                            </tr>
                            <tr>
                                <form action="../view/room.php" method="POST">
                                    <td>000001</td>
                                    <td>Sample1</td>
                                    <td>public</td>
                                    <td><input class="btn btn-primary my-2" type="button" value="Join" id="join-public-room1"></td>
                                    <input type="hidden" name="room-name" value="Sample1">
                                </form>
                            </tr>
                            <tr>
                                <td>000002</td>
                                <td>Sample2</td>
                                <td>public</td>
                                <td><input class="btn btn-primary my-2" type="button" value="Join" id="join-public-room2"></td>
                            </tr>
                            <tr>
                                <form action="../view/auth_room.php" method="POST">
                                    <td>000003</td>
                                    <td>Sample3</td>
                                    <td>key</td>
                                    <td><input class="btn btn-primary my-2" type="button" value="Join" id="join-public-room3"></td>
                                    <input type="hidden" name="room-name" value="Sample3">
                                </form>
                            </tr>
                            <tr>
                                <td>000004</td>
                                <td>Sample4</td>
                                <td>key</td>
                                <td><input class="btn btn-primary my-2" type="button" value="Join" id="join-public-room4"></td>
                            </tr>
                        </table>
                    </div>
                </div>

            <!-- </form> -->
        </div>


        <div class="room-create panel-default border rownded overflow-hidden flex-md-row mb-4 shadow-sm text-white bg-dark">
            <h1 class="h3 mb-3 fw-normal">Create room</h1>
            <form action="" method="POST" class="p-5 rounded" id="submit-create-room">

                <div class="control-label">Room type</div>

                <div class="radio-inline">
                    <label for="radio-public-room"><input class="form-check-input" type="radio" name="radio-type" id="radio-public-room" value="1" checked>Public</label>
                    <label for="radio-key-room"><input class="form-check-input" type="radio" name="radio-type" id="radio-key-room" value="2">Key</label>
                    <label for="radio-private-room"><input class="form-check-input" type="radio" name="radio-type" id="radio-private-room" value="3">Private</label>
                </div>

                <div class="form-group">
                    <label class="control-label" for="input-name">Room Name</label>
                    <input class="form-control" id="input-name" type="text" placeholder="Room name" require>
                </div>

                <div class="form-group">
                    <label class="control-label" for="input-key">Key</label>
                    <input class="form-control" id="input-key" type="text" placeholder="Room key word" disabled require>
                </div>

                <input class="btn btn-primary my-2" type="button" value="Create" id="create-room">

            </form>
        </div>

        <div class="room-keys panel-default border rownded overflow-hidden flex-md-row mb-4 shadow-sm text-white bg-dark">
            <h1 class="h3 mb-3 fw-normal">Join room</h1>
            <form action="" method="POST" class="p-5 rounded" id="submit-join-private-room">

                <div class="form-group">
                    <label class="control-label" for="input-room-name">Room name</label>
                    <input class="form-control" id="input-room-name" id="room-name" type="text" placeholder="Room name" require>
                </div>

                <div class="form-group">
                    <label class="control-label" for="input-key">Key</label>
                    <input class="form-control" id="input-key" type="text" placeholder="Key" require>
                </div>

                <input class="btn btn-primary my-2" type="button" value="Join" id="join-private-room">

            </form>
        </div>

    </div>

</body>

</html>