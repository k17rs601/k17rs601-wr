<!DOCTYPE html>
<link rel="stylesheet" href="receptionist.css">
<html lang="ja">

<?php

date_default_timezone_set('Asia/Tokyo');
$datetime = date('Y-m-d H:i');
$date = date('Y-m-d');
session_start();
$recenumber = $_POST["recenumber"];


if ($recenumber > 18) {
    exit("入力した人数が多過ぎます.
        19名を超える際は店員に申し付け下さい。<br>
        <a href='top.php'>TOPに戻る</a>");
}
if (!$recenumber) {
    exit("0名は無効です。人数を入力し直してください。<br>
        <a href='receptionist.html'>戻る</a>");
}
$con = new mysqli("localhost", "root", "", "FARVAS"); //MySQLサーバへ接続
$con->set_charset('utf8'); //データベースとの通信をUTF8で行う。
$sql = "SELECT res_number FROM `tel_res` WHERE DATE(res_datetime) = '$date' AND res_number <= 999 ORDER BY res_number DESC";

$rs = $con->query($sql);
$row = $rs->fetch_assoc();

if ($row) { //予約番号を作成
    $res_number = $row["res_number"] + 1;
} else {
    $res_number = 100;
}

if ($recenumber <= 6) { //必要なテーブル数の計算
    $user_table_number = 1;
} else if ($recenumber <= 12) {
    $user_table_number = 2;
} else if ($recenumber <= 18) {
    $user_table_number = 3;
}

$sql_wait = "SELECT COUNT(resid) FROM `tel_res` WHERE receptionist > 0 AND DATE(res_datetime) = '$date' AND guide = 0 AND hold = 0 AND res_number != $res_number";
$rs = $con->query($sql_wait);
$row = $rs->fetch_assoc();
$wait_num = $row["COUNT(resid)"];
$sql_zaseki = "SELECT COUNT(zaseki_number) FROM `tel_zaseki` WHERE zaseki_state = 0";
$rs = $con->query($sql_zaseki);
$row = $rs->fetch_assoc();
$zaseki_count = $row["COUNT(zaseki_number)"];




?>

<head>
    <?php
    if ($wait_num > 0) {
        echo ' <meta http-equiv="refresh" content="10; URL=top.php">';
    } else if ($zaseki_count > $user_table_number) {
        echo ' <meta http-equiv="refresh" content="10; URL=select_table.php">';
    }

    ?>
    <link rel="stylesheet" href="register.css">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>ユーザー登録</title>
</head>

<style>
    h4 {
        font-size: 200%;
    }

    h3 {
        font-size: 200%;
    }

    h2 {
        font-size: 500%;
    }

    .all {
        width: 100%;
        text-align: center;
    }
</style>

<body>
    <?php



    $sql1 = "INSERT INTO `tel_res`(res_number,people_number,table_number,receptionist,reserve) VALUES ($res_number,$recenumber,$user_table_number,3,1)";
    $sql11 = "UPDATE `tel_zaseki` SET guide_number = $res_number ,guide_datetime = '$date' WHERE guide_number = null";
    $con->query($sql1);
    //データベースに問い合わせ、残りの空き席数を検索
    $_SESSION["res_number"] = $res_number;
    $_SESSION["res_table"] =  $user_table_number;
    echo "<div class ='all'>";
    if ($wait_num > 0) {
        echo "<h4>受付が完了しました。</h4>";
        echo "<h3>現在案内可能なお席がございません。下記の番号でお待ち下さい。</h3>";
        echo "<h3>案内番号</h3> <h2>$res_number 番</h2> ";
    } else if ($zaseki_count <= $user_table_number) { //空席が案内テーブル数より少ない場合の処理
        echo "<h4>受付が完了しました。</h4>";
        echo "<h3>現在案内可能なお席がございません。下記の番号でお待ち下さい。</h3>";
        echo "<h3>案内番号</h3> <h2>$res_number 番</h2> ";
    } else if ($zaseki_count > $user_table_number) {
        echo "<h4>受付が完了しました。</h4>";
        echo "<h3>空席が複数存在するので座席選択画面に移ります。</h3>";
        echo '<button onclick="location.href=' . "'select_table.php'" . '">座席選択画面へ</button>';
        //echo '<button onclick="location.href="select_table.php>座席選択画面へ</button>';
        echo "</div>";
        exit();
    }
    //　
    session_destroy();
    ?>
    <button onclick="location.href='top.php'">TOPに戻る</button>
    </div>
</body>

</html>