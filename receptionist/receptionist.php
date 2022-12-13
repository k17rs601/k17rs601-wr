<!DOCTYPE html>
<link rel="stylesheet" href="receptionist.css">
<html lang="ja">

<head>
    <link rel="stylesheet" href="register.css">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>ユーザー登録</title>
</head>

<body>
    <?php
    date_default_timezone_set('Asia/Tokyo');
    $datetime = date('Y-m-d H:i');
    $recenumber = $_POST["recenumber"];
    if ($recenumber > 18) {
        exit("入力した人数が多過ぎます.
        19名を超える際は店員に申し付け下さい。<br>
        <a href='top.php'>TOPに戻る</a>");
    }
    $con = new mysqli("localhost", "root", "", "FARVAS"); //MySQLサーバへ接続
    $con->set_charset('utf8'); //データベースとの通信をUTF8で行う。

    ?>
    <a href="top.php">TOPに戻る</a>

</body>

</html>