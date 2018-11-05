<?php
    session_start();
    require('functions.php');
    require('dbconnect.php');

    v($_POST, '$_POST');

    $validations=[];

    // POST送信されたら
    if(!empty($_POST)){
        $email = $_POST['email'];
        $password = $_POST['password'];

        if($email!='' && $password!=''){
            $sql='SELECT * FROM `users` WHERE `email`=?';
            $stmt = $dbh->prepare($sql);
            $data = array($email);
            $stmt->execute($data);
            // object->arrayに変換
            $record = $stmt->fetch(PDO::FETCH_ASSOC);
            v($record, '$record');
            if ($record == false){
                $validations['signin']='failed';
            }else{
                // パスワードの照合
                $verify =password_verify($password,$record['password']);
                if($verify == true){
                    // サインイン成功
                    $_SESSION['id'] = $record['id'];
                    header('Location: timeline.php');
                    exit();
                }else{
                    // パスワードミス
                    $validations['signin'] ='failed';
                }
            }

        }else{
            $validations['signin']='blank';
        }
    }
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
  <h1>サインイン</h1>
  <form method="POST" action="">
    <div>
      メールアドレス<br>
      <input type="email" name="email" value="">
      <?php if (isset($validations['signin']) && $validations['signin']=='blank'): ?>
        <span class="error_msg">メールアドレスとパスワードは正しく入力してください。</span>
      <?php endif ?>
      <?php if (isset($validations['signin']) && $validations['signin']=='failed'): ?>
        <span class="error_msg">サインインに失敗しました。</span>
      <?php endif ?>
    </div>

    <div>
      パスワード<br>
      <input type="password" name="password" value="">
    </div>

    <input type="submit" value="サインイン">

  </form>


</body>
</html>