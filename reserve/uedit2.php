<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ユーザー登録</title>
</head>
<body>
<?php

$con = mysqli_connect('localhost', '','FAMIs');
// データベースサーバに接続$conに維持
if (!$con) {
  exit('データベースに接続できませんでした。');
}

$result = mysqli_select_db($con,'FAMIs');
//データベースに接続
if (!$result) {
  exit('データベースを選択できませんでした。');
}

$result = mysqli_query($con,"SELECT * FROM tbl_user");
//クエリの実行
if (!$result) {
  exit('文字コードを指定できませんでした。');
}

$name   = $_POST['uname'];
$email = $_POST['email'];
$pass  = $_POST['upass'];

$result = mysqli_query($con,"INSERT INTO address(no, name, tel) VALUES('$name', '$email', '$pass')");
if (!$result) {
  exit('データを登録できませんでした。');
}

$con = mysqli_close($con);
//データベースとの接続解除
if (!$con) {
  exit('データベースとの接続を閉じられませんでした。');
}

?>
<p>登録が完了しました。<br /><a href="index.html">戻る</a></p>
</body>
</html>