<?php
    session_start();
    // SESSION変数の破棄
    $_SSESION = [];


    // サーバー内の$_SESSION変数のクリア
    session_destroy();


    // signin.phpへの移動
    header("Location: signin.php");
    exit();

?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <title></title>
  <meta charset="utf-8">
</head>
<body>

</body>
</html>