<?php
    session_start();
    require('functions.php');
    require('dbconnect.php');

    V($_GET,'$_GET');

    $feed_id = $_GET['feed_id'];

    $sql = "SELECT `f`.*, `u`.`name`, `u`.`img_name` AS `profile_img` FROM `feeds` AS `f` INNER JOIN `users` AS `u` ON `f`.`user_id` = `u`.`id` WHERE `f`.`id` = ?";
    $stmt = $dbh->prepare($sql);
    $data = array($feed_id);
    $stmt->execute($data);

    $signin_user = $stmt->fetch(PDO::FETCH_ASSOC);

    v($signin_user,'$signin_user');

    if (!empty($_POST)) {
        $sql = "UPDATE `feeds` SET `feed` = ? WHERE `feeds`.`id` = ?";
        $stmt = $dbh->prepare($sql);
        $data = array($_POST['feed'],$feed_id);
        $stmt->execute($data);

        header("Location: timeline.php");
        exit();
    }

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>Learn SNS</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body style="margin-top: 60px;">
    <div class="container">
        <div class="row">
            <!-- ここにコンテンツ -->
            <div class="col-xs-4 col-xs-offset-4">
                <form class="form-group" method="post">
                    <img src="user_profile_img/<?php echo $signin_user['profile_img']  ?>" width="60">
                    <?php echo $signin_user['name'] ?><br>
                    <?php echo$signin_user['created'] ?><br>
                    <textarea name="feed" class="form-control"><?php echo $signin_user['feed'] ?></textarea>
                    <input type="submit" value="更新" class="btn btn-warning btn-xs">
                </form>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery-3.1.1.js"></script>
    <script src="assets/js/jquery-migrate-1.4.1.js"></script>
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
