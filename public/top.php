<?php

require_once "../classes/UserLogic.php";

session_start();


$err = [];

if(!$email = filter_input(INPUT_POST, "email")){
    $err["email"] = "メールアドレスを記入してください。";
}
$password = filter_input(INPUT_POST, "password");

if(!$password = filter_input(INPUT_POST, "password")
){
    $err["password"] = "パスワードを記入してください";  
}


if(count($err) > 0 ) {
   
$_SESSION = $err;
 header("Locarion: login.php");
 return;
}

$result = UserLogic::login($email, $password);

if (!$result) {
    header("Location: login.php");
    return;
}
echo "ログイン成功です"
?>
<?php
// エラー表示なし
ini_set('display_errors', 0);

// エラー表示あり
ini_set('display_errors', 1);
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザ登録完了画面</title>
</head>
<body>
<?php if (count($err) > 0) : ?>
 <?php foreach($err as $e) : ?>
   <p><?php echo $e ?></p>
   <?php endforeach ?>
<?php else : ?>
    <p>ユーザー登録完了しました</p>
 <?php endif ?>
    <a href="./login.php">戻る</a>
</body>
</html>
