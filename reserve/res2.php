<!DOCTYPE html>
<html lang="ja">

<?php
session_start();
echo $_COOKIE['PHPSESSID'] . "<br>";
$conn = new mysqli("localhost", "root", "", "FAMIs"); //MySQLサーバへ接続
$conn->set_charset('utf8'); //データベースとの通信をUTF8で行う。
$sql = "INSERT FROM tbl_user";
$sql1 = "SELECT MAX(resn) AS max FROM tbl_res WHERE resn < 999"; //即時予約の番号の最大値を取得

if ($conn->connect_error) {
    die($conn->connect_error);
}

?>

<head>
    <title>FAMIs</title>
    <link rel="stylesheet" href="login.css">
    <meta http-equiv="Content-TYPE" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width">
</head>

<body>

    予約が完了いたしました。<br>
    <h2>注文内容</h2><br>
    <?php
    $howp = $_POST['howp']; //人数取得
    echo $howp . "<br>";
    date_default_timezone_set('Asia/Tokyo'); //基準時刻を日本に設定
    echo date('Y-m-d H:i') . " "; //現在日付時間を表示
    ?>
    予約番号
    <button onclick="location.href='top.php'">TOPに戻る
</body>

</html>