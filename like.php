<?php
    require_once("dbconnect.php");

    $feed_id = $_POST["feed_id"];
    $user_id = $_POST["user_id"];

    if (isset($_POST['is_liked'])) {
        $sql = "INSERT INTO `likes` (`user_id`, `feed_id`) VALUES (?, ?);";
    }else{
        $sql = "DELETE FROM `likes` WHERE `user_id`=? AND `feed_id`=?";
    }

    // if (isset($_POST['is_unliked'])) {
    //     $sql = "DELETE FROM `likes` WHERE `user_id`=? AND `feed_id`=?";
    // }else{
    //     $sql = "INSERT INTO `likes` (`user_id`, `feed_id`) VALUES (?, ?);";

    // }

    // if ($is_liked == 'true') {
    //     $sql = "INSERT INTO `likes` (`user_id`, `feed_id`) VALUES (?, ?);";
    // }else{
    //     $sql = "DELETE FROM `likes` WHERE `user_id`=? AND `feed_id`=?";
    // }

    $data = [$user_id, $feed_id];
    $stmt = $dbh->prepare($sql);
    $res = $stmt->execute($data);

    echo json_encode($res);



 ?>