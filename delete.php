<?php
    require('functions.php');
    require('dbconnect.php');

    // 削除したいFeedのIDを取得
    V($_GET,'$_GET');

    $feed_id = $_GET['feed_id'];
    // Delete文の作成
    $sql = "DELETE FROM `feeds` WHERE `id`=?";
    $stmt = $dbh->prepare($sql);
    $data = array($feed_id);

    // Delete文実行
    $stmt->execute($data);


    // タイムライン一覧にもどる
    header("Location: timeline.php");
    exit();


?>