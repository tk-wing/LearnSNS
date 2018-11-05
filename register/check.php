<?php
    session_start();
    require('../functions.php');
    require('../dbconnect.php');

    // $_SSESIONの中に46_LearnSNSが定義されてなければ
    if (!isset($_SESSION['46_LearnSNS'])) {
        header('Location: singup.php');
    }

    v($_POST, '$_POST');


    $name = $_SESSION['46_LearnSNS']['name'];
    $email = $_SESSION['46_LearnSNS']['email'];
    $password = $_SESSION['46_LearnSNS']['password'];
    $file_name = $_SESSION['46_LearnSNS']['file_name'];

    // POST送信されたら
    if (!empty($_POST)) {

        $hash_password = password_hash($password, PASSWORD_DEFAULT);
        // DB登録処理
        // NOW()はSQL文の関数
        $sql = 'INSERT INTO `users` SET `name`=?, `email`=?, `password`=?, `img_name`=?,`created`=NOW()';
        $stmt = $dbh->prepare($sql);
        $data = array($name, $email, $hash_password, $file_name);
        $stmt->execute($data);

        // SESSIONに入っているデータを削除する。
        unset($_SESSION['46_LearnSNS']);

        header('Location: thanks.php');
        // 処理を終了させる
        exit();
    }



?>


<!DOCTYPE html>
<html land="ja">
<head>
  <title></title>
  <meta charset="utf-8">
</head>

<body>
  <div>
    ユーザー名： <?php echo h($name); ?>
  </div>

  <div>
    メールアドレス： <?php echo h($email); ?>
  </div>

  <div>
    パスワード： ●●●●●●●
  </div>

  <div>
    プロフィール画像：
    <img src="../user_profile_img/<?php echo h($file_name) ?>" width="100">
  </div>

  <form method="POST" action="">
    <input type="hidden" name="hoge" value="fuga">
    <input type="submit" value="アカウント作成">
  </form>

</body>

</html>