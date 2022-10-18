<!DOCTYPE html>
<html>
<head>
<link rel = "stylesheet" href = "uedit.css">
<meta name="viewport" content="width=device-width">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ユーザー登録</title>
</head>
<body>
<?php
$na = $_POST['name']; $ema = $_POST['email']; $pas  = $_POST['pass'];$id = $_POST['id'];
$con = mysqli_connect('localhost','root','','FAMIs');
if(!$id || !$na || !$ema || !$pas){
    if(!$na){
        echo "「ユーザーネーム」";
    }
    if(!$ema){
        echo "「メールアドレス」";
    }
    if(!$id){
        echo "「ユーザーID」";
    }
    if(!$pas){
        echo "「パスワード」";
    }
    exit ("が設定されていません。再度入力し直してください。<br><button style='text-align:center;' onclick='history.back()'>戻る</button>");

}
if(!$na){exit("名前が入力されていません");}

if (!$con) {exit('データベースに接続できませんでした。');}

$result = mysqli_select_db($con,'FAMIs');
if (!$result) {exit('データベースを選択できませんでした。');}

$result = mysqli_query($con,"SELECT * FROM tbl_user");
if (!$result) {exit('文字コードを指定できませんでした。');}

$coun = mysqli_query($con,"SELECT COUNT(*) FROM tbl_user;");
$result = mysqli_query($con,"INSERT INTO tbl_user(uid,uname, email, upass) VALUES('$id','$na', '$ema', '$pas')");
if (!$result) {exit('データを登録できませんでした。');}

$con = mysqli_close($con);
?>
<p>登録が完了しました。<br /><a href="login.html">戻る</a></p>
</body>
</html>