<!DOCTYPE html>
<link rel="stylesheet" href="receptionist.css">
<html lang="ja">


<head>
    <link rel="stylesheet" href="register.css">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="refresh" content="20; URL=top.php">
</head>

<?php
session_start();
$res_number = $_SESSION["res_number"];
$res_table = $_SESSION["res_table"];
$zaseki_number = $_POST["zaseki_number"];
date_default_timezone_set('Asia/Tokyo');
$datetime = date('Y-m-d H:i');
$con = new mysqli("localhost", "root", "", "FARVAS");
$con->set_charset('utf8');

$sql = "UPDATE `tel_zaseki` SET zaseki_state = 1, guide_datetime = '$datetime' , guide_number = $res_number WHERE zaseki_number = $zaseki_number";
$rs = $con->query($sql);

$sql = "UPDATE `tel_res` SET receptionist = 0 , reserve = 0 , guide = 1 WHERE res_number = $res_number";
$rs = $con->query($sql);
?>

<style>
    .main {
        width: 100%;
        text-align: center;

    }

    h3 {
        font-size: 620%;
    }
</style>

<body>
    <div class="main">
        <h2>座席の選択が完了いたしました。</h2>
        <h1>座席表を確認しながら下記の番号にお進みください。</h1>
        <?php
        echo "<h3>$zaseki_number</h3> "
        ?>
        <button onclick="location.href='top.php'">TOPに戻る</button>
    </div>
</body>