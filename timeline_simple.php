<?php
    session_start();
    require('functions.php');
    require('dbconnect.php');

    $validations=[];

    // v($_SESSION['id'],'$_SESSION["id"]');


    $sql='SELECT * FROM `users` WHERE `id`=?';
    $stmt = $dbh->prepare($sql);
    $data = array($_SESSION['id']);
    $stmt->execute($data);

    $signin_user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!empty($_POST)) {
        V($_POST, '$_POST');
        $feed= $_POST['feed'];

        if ($feed=='') {
            $validations['feed']='blank';
        }else{
        $sql = 'INSERT INTO `feeds` SET `feed`=?, `user_id`=?, `created`=NOW()';
        $stmt = $dbh->prepare($sql);
        $data = array($feed, $_SESSION['id']);
        $stmt->execute($data);

        header('Location: timeline_simple.php.php');
        exit();
        }
    }

    // V($signin_user,'$signin_user');



?>



<!DOCTYPE html>
<html lang="ja">
<head>
  <title></title>
  <meta charset="utf-8">
  <style>
    .error_msg{
      color: red;
      font-size: 12px;
    }
  </style>
</head>
<body>

  ユーザー情報 [<img src="user_profile_img/<?php echo $signin_user['img_name'] ?>" width="100">
  <?php echo $signin_user['name']; ?>]
  <a href="signout.php">サインアウト</a>
  <form method="POST" action="">
    <textarea rows="5" name="feed"></textarea>
    <input type="submit" value="投稿">
    <?php if (isset($validations['feed']) && $validations['feed']=='blank'): ?>
   <span class="error_msg">投稿データを入力してください。</span>
    <?php endif ?>
  </form>


</body>
</html>