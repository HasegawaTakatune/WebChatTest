<!DOCTYPE html>
<html lang="ja">

<head>
    <meta http-equiv="content-type" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="../js/login.js"></script>
    
    <title>Show room</title>
</head>

<body>
<div class="page-header">
    <h1 id="page-title">Sign in <small>SkayWay chat sample</small></h1>
  </div>

  <div class="container room-views">
      <div class="find">
        <button class="btn btn-primary my-2" id="find-room">find</button>
        <div class="wrapper-find-room">
          <div class="find-room-contents">
            <table>
              <tr><th>ID</th><th>Name</th><th>NofP</th></tr>
              <tr>  </tr>
            </table>
          </div>
        </div>
      </div>
      <div class="create"></div>
      <div class="keys"></div>
  </div>
</body>

</html>