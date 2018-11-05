<?php
    session_start();
    require('../functions.php');

    // 毎回必ず処理したいプログラム
    // バリデーション格納用の配列を用意
    $validations =  array();

    $name="";
    $email="";
    $password="";

    V($_POST,'$_POST');


    // ユーザーが送信ボタンを押したとき

    if(!empty($_POST)){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        // バリデーション
        // ユーザー名の空チェック
        if($name == ''){
            // echo 'ユーザー名を入力してください。';
            $validations['name'] = 'blank';
        }

        if($email == ''){
            $validations['email'] = 'blank';
        }

        $c=strlen($password);
        if($password == ''){
            $validations['password'] = 'blank';
        }elseif ($c<4 || 16<$c) {
            $validations['password'] = 'length';
        }

        // 画像の選択
        $file_name = $_FILES['img_name']['name'];
        v($file_name, '$file_name');
        if($file_name==''){
            $validations['img_name'] = 'blank';
        }

        V($validations,'$validations');

        // もしバリデーションに引っかからなければ
        if(empty($validations)) {
            // 画像アップデート処理
            v($_FILES, '$_FILES');
            // 選択した画像データ
            $tmp_file = $_FILES['img_name']['tmp_name'];
            // 登録先と保存名
            $file_name = date('YmdHis') .$_FILES['img_name']['name'];
            $destination = '../user_profile_img/'.$file_name;

            // move_uploaded_file(送りたいファイルデータ, 送信先)
            move_uploaded_file($tmp_file, $destination);

            $_SESSION['46_LearnSNS']['name'] = $name;
            $_SESSION['46_LearnSNS']['email'] = $email;
            $_SESSION['46_LearnSNS']['password'] = $password;
            $_SESSION['46_LearnSNS']['file_name'] = $file_name;
            header('Location: check.php');
            exit();
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
  <h1>ユーザー名</h1>
  <form method="POST" action="" enctype="multipart/form-data">
  <!-- enctype="multipart/form-data" ファイルを送信することを許可するタグ -->

    <div>
      ユーザー名<br>
      <input type="text" name="name" value="<?php echo $name; ?>">
      <?php if (isset($validations['name']) && $validations['name'] == 'blank') :?>
      <span class="error_msg">ユーザー名を入力してください。</span>
      <?php endif; ?>
    </div>

    <div>
      メールアドレス<br>
      <input type="email" name="email" value="<?php echo $email; ?>">
      <?php if (isset($validations['email']) && $validations['email'] == 'blank') :?>
      <span class="error_msg">メールアドレスを入力してください。</span>
      <?php endif; ?>
    </div>

    <div>
      パスワード<br>
      <input type="password" name="password" value="<?php echo $password; ?>">
      <?php if (isset($validations['password']) && $validations['password'] == 'blank') :?>
      <span class="error_msg">パスワードを入力してください。</span>
      <?php endif; ?>
      <?php if (isset($validations['password']) && $validations['password'] == 'length') :?>
      <span class="error_msg">パスワードは4 - 16文字で入力してください。</span>
      <?php endif; ?>
    </div>

    <div>
      プロフィール画像<br>
      <input type="file" name="img_name" accept="image/*">
      <?php if (isset($validations['img_name']) && $validations['img_name'] == 'blank') :?>
      <span class="error_msg">画像を選択してください。</span>
      <?php endif; ?>
    </div>

    <input type="submit" value="確認">

  </form>
</body>
</html>